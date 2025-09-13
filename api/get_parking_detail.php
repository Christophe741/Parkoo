<?php
require_once '../db/config.php';
header('Content-Type: application/json; charset=utf-8');

$parkingId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$parkingId) {
  http_response_code(400);
  echo json_encode(['success' => false, 'message' => 'Paramètre id manquant ou invalide'], JSON_UNESCAPED_UNICODE);
  exit;
}

try {

  $sql = "SELECT p.id, p.owner_id, p.address, p.city, p.postal_code,
                 p.price_per_hour, p.is_covered, p.is_accessible, p.has_ev_charging,
                 p.description, p.is_available,
                 u.photo,
                 CONCAT(
                   UPPER(LEFT(u.firstname,1)),
                   LOWER(SUBSTRING(u.firstname,2)),
                   ' ',
                   UPPER(LEFT(u.name,1)), '.'
                 ) AS display_name
        FROM parkings p
        JOIN users u ON u.id = p.owner_id
        WHERE p.id = ?
        LIMIT 1";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$parkingId]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Parking introuvable'], JSON_UNESCAPED_UNICODE);
    exit;
  }

  $parking = [
    'id'              => $row['id'],
    'owner_id'        => $row['owner_id'],
    'address'         => $row['address'],
    'city'            => $row['city'],
    'postal_code'     => $row['postal_code'],
    'price_per_hour'  => (float)$row['price_per_hour'],
    'is_covered'      => $row['is_covered'] === 1,
    'is_accessible'   => $row['is_accessible'] === 1,
    'has_ev_charging' => $row['has_ev_charging'] === 1,
    'description'     => $row['description'],
    'is_available'    => $row['is_available'] === 1,
    'photo'           => $row['photo'],
    'display_name'    => $row['display_name'],
  ];

  $reviewsCol = $mongoDb->selectCollection('reviews');
  $cursor = $reviewsCol->find(
    ['reviewed_user_id' => $parking['owner_id']],
    ['sort' => ['created_at' => -1]]
  );

  $reviews = [];
  foreach ($cursor as $doc) {
    $reviewerStmt = $pdo->prepare("SELECT firstname, name FROM users WHERE id = ? LIMIT 1");
    $reviewerStmt->execute([$doc['reviewer_id']]);
    $reviewer = $reviewerStmt->fetch(PDO::FETCH_ASSOC);
    $reviewer_name = $reviewer
      ? (strtoupper(substr($reviewer['firstname'],0,1)) . strtolower(substr($reviewer['firstname'],1)) . ' ' . strtoupper(substr($reviewer['name'],0,1)) . '.')
      : '';

    $reviews[] = [
      'reviewer_name'     => $reviewer_name,
      'rating'            => $doc['rating'],
      'comment'           => $doc['comment'] ?? '',
      'created_at'        => $doc['created_at'] ?? '',
    ];
  }

  $count = count($reviews);
  $avg   = $count ? round(array_sum(array_column($reviews, 'rating')) / $count, 1) : null;

  echo json_encode([
    'success' => true,
    'parking' => $parking,
    'reviews' => $reviews,
    'reviews_summary' => ['count' => $count, 'average' => $avg],
  ], JSON_UNESCAPED_UNICODE);

} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(['success' => false, 'message' => 'Erreur serveur'], JSON_UNESCAPED_UNICODE);
}

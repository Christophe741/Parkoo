<?php
require_once '../db/config.php';
header('Content-Type: application/json');

if ($id) {
    $stmt = $pdo->prepare("SELECT parkings.city, parkings.description, parkings.price_per_hour,
                                  parkings.description, parkings.is_covered, parkings.is_accessible,
                                  parkings.has_ev_charging, users.photo,
                                  CONCAT(UPPER(LEFT(users.firstname, 1)), LOWER(SUBSTRING(users.firstname, 2)), ' ', UPPER(LEFT(users.name, 1)), '.') AS display_name
                           FROM parkings
                           JOIN users ON parkings.owner_id = users.id
                           WHERE parkings.id = ? ");
    $stmt->execute(["$id"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 echo json_encode(['success' => true, 'parkings' => $results]);
} else {
    echo json_encode(['success' => false, 'message' => 'Parametres manquants']);
}
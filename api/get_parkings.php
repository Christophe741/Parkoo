<?php
require_once '../db/config.php';

header('Content-Type: application/json');

$city = trim($_GET['city'] ?? '');

if ($city) {
    $stmt = $pdo->prepare("SELECT parkings.city, parkings.description, parkings.price_per_hour,
                                  parkings.description, users.photo,
                                  CONCAT(UPPER(LEFT(users.firstname, 1)), LOWER(SUBSTRING(users.firstname, 2)), ' ', UPPER(LEFT(users.name, 1)), '.') AS display_name
                           FROM parkings
                           JOIN users ON parkings.owner_id = users.id
                           WHERE city = ? ");
    $stmt->execute(["$city"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
 echo json_encode(['success' => true, 'parkings' => $results]);
} else {
    echo json_encode(['success' => false, 'message' => 'Parametres manquants']);
}
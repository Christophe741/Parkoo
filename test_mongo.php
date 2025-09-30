<?php
require_once __DIR__ . '/../vendor/autoload.php';

$mongoHost   = getenv('MONGO_HOST') ?: 'srv-captain--mongodb';
$mongoDbName = getenv('MONGO_DB') ?: 'parkoo';

$mongoUri = "mongodb://{$mongoHost}:27017/{$mongoDbName}";

try {
    $client   = new MongoDB\Client($mongoUri);
    $database = $client->selectDatabase($mongoDbName);

    echo "<h3>Connexion Mongo OK ✅</h3>";

    echo "<p>Collections dans la base <strong>{$mongoDbName}</strong> :</p><ul>";
    foreach ($database->listCollections() as $col) {
        echo "<li>" . $col->getName() . "</li>";
    }
    echo "</ul>";

    $col = $database->selectCollection('reviews');
    $doc = $col->findOne();
    if ($doc) {
        echo "<p>Premier document dans reviews :</p><pre>";
        var_dump($doc);
        echo "</pre>";
    } else {
        echo "<p>Aucun document trouvé dans reviews.</p>";
    }

} catch (Throwable $e) {
    echo "<h3>❌ Erreur Mongo</h3>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}

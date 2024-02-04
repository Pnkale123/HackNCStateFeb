<?php
// Connect to MongoDB
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->selectDatabase('syllabusReader');
$collection = $database->selectCollection('searchQueries');

// Retrieve data from MongoDB
$cursor = $collection->find();
foreach ($cursor as $document) {
    echo "Search Query: " . $document['searchQuery'] . "<br>";
    echo "Timestamp: " . $document['timestamp']->toDateTime()->format('Y-m-d H:i:s') . "<br>";
    echo "<hr>";
}
?>

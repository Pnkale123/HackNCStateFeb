<?php
$searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';

// File upload handling
$uploadDir = 'uploads/';
$uploadedFile = null;

if (isset($_FILES['syllabusFile'])) {
    $uploadedFile = $uploadDir . basename($_FILES['syllabusFile']['name']);
}

if (move_uploaded_file($_FILES['syllabusFile']['tmp_name'], $uploadedFile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Upload failed.\n";
    exit;  
}

// Connect to MongoDB
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = 'syllabusReader';
$collectionName = 'searchQueries';

// Select the database and collection
$database = $mongoClient->$database;
$collection = $database->$collectionName;

// Insert form data into MongoDB
$document = [
    'searchQuery' => $searchQuery,
    'timestamp' => new MongoDB\BSON\UTCDateTime(),
    'file' => $uploadedFile  // Store file path in the database
];

try {
    $collection->insertOne($document);
    echo "Document inserted successfully";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

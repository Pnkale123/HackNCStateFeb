<?php
require 'vendor/autoload.php';

$searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';

// File upload handling
$uploadDir = 'uploads/';
$uploadedFile = null;

// Check if the syllabusFile key exists in the $_FILES array
if (isset($_FILES['syllabusFile'])) {
    $uploadedFile = $uploadDir . basename($_FILES['syllabusFile']['name']);

    // Print details about the uploaded file
    var_dump($_FILES);

    // Check if the file was successfully moved
    if (move_uploaded_file($_FILES['syllabusFile']['tmp_name'], $uploadedFile)) {
        echo "File is valid, and was successfully uploaded.\n";
    } else {
        echo "Upload failed.\n";
        exit;  
    }
}

// Connect to MongoDB
try {
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Failed to connect to MongoDB: " . $e->getMessage();
    exit;
}

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
    
    // Redirect to success.html using JavaScript
    echo '<script>window.location.href = "success.html";</script>';
    exit;
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Error inserting document: " . $e->getMessage();
    exit;
}
?>

<?php
require 'vendor/autoload.php';

$searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';

$uploadDir = 'uploads/';
$uploadedFile = null;

if (isset($_FILES['syllabusFile'])) {
    $uploadedFile = $uploadDir . basename($_FILES['syllabusFile']['name']);

    if (move_uploaded_file($_FILES['syllabusFile']['tmp_name'], $uploadedFile)) {
        try {
            $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Failed to connect to MongoDB: " . $e->getMessage();
            exit;
        }

        $database = 'syllabusReader';
        $collectionName = 'searchQueries';

        $database = $mongoClient->$database;
        $collection = $database->$collectionName;

        $document = [
            'searchQuery' => $searchQuery,
            'timestamp' => new MongoDB\BSON\UTCDateTime(),
            'file' => $uploadedFile
        ];

        try {
            $collection->insertOne($document);
            header('Location: http://localhost:5000/upload');
            exit;
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error inserting document: " . $e->getMessage();
            exit;
        }
    } else {
        echo "Upload failed.\n";
        exit;  
    }
}
?>

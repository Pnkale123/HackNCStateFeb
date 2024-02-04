<?php
// Your PHP code here
$searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';
$highlightedResults = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. ";
$highlightedResults .= "<span class='highlight'>$searchQuery</span> Nullam nec urna quis velit tincidunt";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Work+Sans&display=swap');
    </style>
    <title>Syllabus Reader - Results</title>
</head>
<body>
    <div class="container">
        <h1>Syllabus Reader - Results</h1>

        <?php echo "<p>$highlightedResults</p>"; ?>
        
        <p><a href="index.html">&lt;&lt; Back to Search</a></p>
    </div>
    <div class="footer-bar">
        <p>&copy; 2024 Syllabus Reader | <a style="color:white" href="#">Terms and Conditions</a></p>
    </div>
</body>
</html>

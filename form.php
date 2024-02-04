<?php
        $searchQuery = isset($_POST['searchQuery']) ? $_POST['searchQuery'] : '';
        $highlightedResults = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. ";
        $highlightedResults .= "<span class='highlight'>$searchQuery</span> Nullam nec urna quis velit tincidunt";
        echo "<p>$highlightedResults</p>";
?>
        
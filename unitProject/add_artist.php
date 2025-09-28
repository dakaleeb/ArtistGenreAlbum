<?php
$ArtistName = filter_input(INPUT_POST, 'ArtistName');

if ($ArtistName == null || $ArtistName == false) {
    $error = "Invalid artist name. Please try again.";
    include('error.php');
} else {
    require_once('database.php');

    $query = 'INSERT INTO artists (ArtistName)
              VALUES (:ArtistName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':ArtistName', $ArtistName);
    $statement->execute();
    $statement->closeCursor();

    // Display the List page
    include('index.php');
}
?>
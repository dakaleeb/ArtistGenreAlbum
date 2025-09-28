<?php
$Artist_id = filter_input(INPUT_POST, 'Artist_id', FILTER_VALIDATE_INT);
$Genre_id = filter_input(INPUT_POST, 'Genre_id', FILTER_VALIDATE_INT);
$AlbumRating = filter_input(INPUT_POST, 'AlbumRating', FILTER_VALIDATE_INT);
$AlbumName = filter_input(INPUT_POST, 'AlbumName');
$AlbumDescription = filter_input(INPUT_POST, 'AlbumDescription');

// Validate inputs
if ($Artist_id == null || $Artist_id == false ||$Genre_id == null ||$Genre_id == false ||
        $AlbumDescription == null || $AlbumName == null || $AlbumRating == null || $AlbumRating == false) {
    $error = "Invalid Album data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');
 
    $query = 'INSERT INTO album
                 (AlbumDescription, AlbumName, AlbumRating, ArtistID, GenreID )
              VALUES
                 (:AlbumDescription, :AlbumName, :AlbumRating, :Artist_id, :Genre_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':Artist_id', $Artist_id);
    $statement->bindValue(':Genre_id', $Genre_id);
    $statement->bindValue(':AlbumDescription', $AlbumDescription);
    $statement->bindValue(':AlbumName', $AlbumName);
    $statement->bindValue(':AlbumRating', $AlbumRating);
    $statement->execute();
    $statement->closeCursor();

    // Display the List page
    include('index.php');
}
?>
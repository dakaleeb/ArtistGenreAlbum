<?php
require_once('database.php');


$Album_id = filter_input(INPUT_POST, 'Album_id', FILTER_VALIDATE_INT);
$Genre_id = filter_input(INPUT_POST, 'Genre_id', FILTER_VALIDATE_INT);
$Artist_id = filter_input(INPUT_POST, 'Artist_id', FILTER_VALIDATE_INT);


if ($Album_id != false && $Genre_id != false && $Artist_id != false) {
    $query = 'DELETE FROM album
              WHERE AlbumID = :Album_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':Album_id', $Album_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}


include('index.php');
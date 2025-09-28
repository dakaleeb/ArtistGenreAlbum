<?php
require_once('database.php');


$Artist_id = filter_input(INPUT_POST, 'Artist_id', FILTER_VALIDATE_INT);

if ($Artist_id != false) {
    $query = 'DELETE FROM artist
              WHERE ArtistID = :Artist_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':Artist_id', $Artist_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

include('index.php');
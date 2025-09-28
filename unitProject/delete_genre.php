<?php
require_once('database.php');


$Genre_id = filter_input(INPUT_POST, 'Genre_id', FILTER_VALIDATE_INT);

if ($Genre_id != false) {
    $query = 'DELETE FROM genre
              WHERE GenreID = :Genre_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':Genre_id', $Genre_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}


include('index.php');
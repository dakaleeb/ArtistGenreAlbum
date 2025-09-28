<?php
$GenreName = filter_input(INPUT_POST, 'GenreName');

if ($GenreName == null || $GenreName == false || trim($GenreName) === '') {
    $error = "Invalid genre name. Please try again.";
    include('error.php');
} else {
    require_once('database.php');

    $query = 'INSERT INTO genre (GenreName)
              VALUES (:GenreName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':GenreName', $GenreName);
    $statement->execute();
    $statement->closeCursor();

    // Display the List page
    include('index.php');
}
?>
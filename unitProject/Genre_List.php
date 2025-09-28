<?php
require_once('database.php');

if (!isset($Genre_id)) {
    $Genre_id = filter_input(INPUT_GET, 'Genre_id', 
            FILTER_VALIDATE_INT);
    if ($Genre_id == NULL || $Genre_id == FALSE) {
        $Genre_id = 1;
    }
}

// Get all categories
$query = 'SELECT * FROM genre
                       ORDER BY GenreID';
$statement = $db->prepare($query);
$statement->execute();
$Genres = $statement->fetchAll();
//$GenreName = $Genre['GenreName'];
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Great Music List</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>
<header><h1>Great Music</h1></header>
<main>
    <h1>Genre List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
         <?php foreach ($Genres as $Genre) : ?>
        <tr>
            <td><?php echo $Genre['GenreName']; ?></td>
            <td><form action="delete_genre.php" method="post">
                    <input type="hidden" name="Genre_id"
                           value="<?php echo $Genre['GenreID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
        </tr>
        <?php endforeach; ?>
    
    </table>
    
    <h2>Add Genre</h2>
     <form action="add_genre.php" method="post"
              id="Genre_list_form">
    <label>Name:</label>
    <input type="text" name="GenreName"><br>
    <input type="submit" value="Add"><br>
         </form>
    
    
    <br>
    <p><a href="index.php">Album List</a></p>

    </main>

    <footer>
        <p>Thanks for looking</p>
    </footer>
</body>
</html>
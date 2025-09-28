<?php
require_once('database.php');

if (!isset($Artist_id)) {
    $Artist_id = filter_input(INPUT_GET, 'Artist_id', 
            FILTER_VALIDATE_INT);
    if ($Artist_id == NULL || $Artist_id == FALSE) {
        $Artist_id = 1;
    }
}

// Get all categories
$query = 'SELECT * FROM artists
                       ORDER BY ArtistID';
$statement = $db->prepare($query);
$statement->execute();
$Artists = $statement->fetchAll();
//$ArtistName = $Artist['ArtistName'];
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
    <h1>Artist List</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
         <?php foreach ($Artists as $Artist) : ?>
        <tr>
            <td><?php echo $Artist['ArtistName']; ?></td>
            <td><form action="delete_artist.php" method="post">
                    <input type="hidden" name="Genre_id"
                           value="<?php echo $Artist['ArtistID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
        </tr>
        <?php endforeach; ?>
    
    </table>
    
    <h2>Add Artist</h2>
     <form action="add_Artist.php" method="post"
              id="Artist_list_form">
    <label>Name:</label>
    <input type="text" name="ArtistName"><br>
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
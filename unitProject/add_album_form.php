<?php
require('database.php');
$query = 'SELECT *
          FROM artists
          ORDER BY ArtistID';
$statement = $db->prepare($query);
$statement->execute();
$Artists = $statement->fetchAll();
$statement->closeCursor();

$query1 = 'SELECT *
          FROM genre
          ORDER BY GenreID';
$statement1 = $db->prepare($query1);
$statement1->execute();
$Genres = $statement1->fetchAll();
$statement1->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Great Music List</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Great Music</h1></header>

    <main>
        <h1>Add Album</h1>
        <form action="add_album.php" method="post"
              id="add_album_form">

            <label>Artist:</label>
            <select name="Artist_id">
            <?php foreach ($Artists as $Artist) : ?>
                <option value="<?php echo $Artist['ArtistID']; ?>">
                    <?php echo $Artist['ArtistName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>Genre:</label>
            <select name="Genre_id">
            <?php foreach ($Genres as $Genre) : ?>
                <option value="<?php echo $Genre['GenreID']; ?>">
                    <?php echo $Genre['GenreName']; ?>
                </option>
            <?php endforeach; ?>
            </select><br>

            <label>Album Description:</label>
            <input type="text" name="AlbumDescription"><br>

            <label>Album Name:</label>
            <input type="text" name="AlbumName"><br>

            <label>Album Rating:</label>
            <input type="text" name="AlbumRating"><br>

            <label>&nbsp;</label>
            <input type="submit" value="Add Album"><br>
        </form>
        <p><a href="index.php">View Album List</a></p>
    </main>

    <footer>
        <p>Thanks for looking</p>
    </footer>
</body>
</html>
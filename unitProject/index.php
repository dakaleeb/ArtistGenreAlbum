<?php
require_once('database.php');

// Get genre ID
if (!isset($Genre_id)) {
    $Genre_id = filter_input(INPUT_GET, 'Genre_id', 
            FILTER_VALIDATE_INT);
    if ($Genre_id == NULL || $Genre_id == FALSE) {
        $Genre_id = 1;
    }
}
// Get artist ID
if (!isset($Artist_id)) {
    $Artist_id = filter_input(INPUT_GET, 'Artist_id', 
            FILTER_VALIDATE_INT);
    if ($Artist_id == NULL || $Artist_id == FALSE) {
        $Artist_id = 1;
    }
}
// Get name for selected Genre
$queryGenre = 'SELECT * FROM genre
                  WHERE GenreID = :Genre_id';
$statement1 = $db->prepare($queryGenre);
$statement1->bindValue(':Genre_id', $Genre_id);
$statement1->execute();
$Genre = $statement1->fetch();
$Genre_name = $Genre['GenreName'];
$statement1->closeCursor();
// Get name for selected Artist
$queryArtist = 'SELECT * FROM artists
                  WHERE ArtistID = :Artist_id';
$statement2 = $db->prepare($queryArtist);
$statement2->bindValue(':Artist_id', $Artist_id);
$statement2->execute();
$Artist = $statement2->fetch();
$Artist_name = $Artist['ArtistName'];
$statement2->closeCursor();

// Get all genres
$query = 'SELECT * FROM genre
                       ORDER BY GenreID';
$statement = $db->prepare($query);
$statement->execute();
$Genres = $statement->fetchAll();
$statement->closeCursor();

// Get all Artists
$queryArtists = 'SELECT * FROM artists
                       ORDER BY ArtistID';
$statement5 = $db->prepare($queryArtists);
$statement5->execute();
$Artists = $statement5->fetchAll();
$statement5->closeCursor();


// Check if "show all" is requested
$show_all = filter_input(INPUT_GET, 'show_all', FILTER_VALIDATE_INT);

// Get albums with JOIN to include artist and genre names

if ($show_all === 1) {
    // Show all albums from all artists
    $queryAlbum = '
        SELECT album.*, artists.ArtistName, genre.GenreName
        FROM album
        JOIN artists ON album.ArtistID = artists.ArtistID
        JOIN genre ON album.GenreID = genre.GenreID
        ORDER BY album.AlbumID';
    $statement3 = $db->prepare($queryAlbum);
} else {
    // Show albums by selected artist only
    $queryAlbum = '
        SELECT album.*, artists.ArtistName, genre.GenreName
        FROM album
        JOIN artists ON album.ArtistID = artists.ArtistID
        JOIN genre ON album.GenreID = genre.GenreID
        WHERE album.ArtistID = :Artist_id
        ORDER BY album.AlbumID';
    $statement3 = $db->prepare($queryAlbum);
    $statement3->bindValue(':Artist_id', $Artist_id);
}
$statement3->execute();
$Albums = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>Great Music List</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<header><h1>Great Music</h1></header>
<main>
    <h1>Album List</h1>

    <!--<aside>
        display a list of genres
        <h2>Genres</h2>
        <nav>
        <ul>
            <?php /*foreach ($Genres as $Genre) : ?>
            <li><a href=".?Genre_id=<?php echo $Genre['GenreID']; ?>">
                    <?php echo $Genre['GenreName']; ?>
                </a>
            </li>
            <?php endforeach; */?>
        </ul>
        </nav>          
    </aside> -->

    <aside>
        <!-- display a list of artists -->
         <h2>List Of Artists</h2>
        <h2><a href=".?show_all=1">All Artists</a></h2>
        <nav>
        <ul>
            <?php foreach ($Artists as $Artist) : ?>
            <li><a href=".?Artist_id=<?php echo $Artist['ArtistID']; ?>">
                    <?php echo $Artist['ArtistName']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>          
    </aside>

    <section>
        <table>
            <tr>
                <th>Artist_Name</th>
                <th>Genre_Name</th>
                <th>Album_Name</th>
                <th>Album_Description</th>
                <th>Album_Rating</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($Albums as $Album) : ?>
            <tr>
                <td><?php echo $Album['ArtistName']; ?></td>
                <td><?php echo $Album['GenreName']; ?></td>
                <td><?php echo $Album['AlbumName']; ?></td>
                <td><?php echo $Album['AlbumDescription']; ?></td>
                <td><?php echo $Album['AlbumRating']; ?></td>
                <td><form action="delete_album.php" method="post">
                    <input type="hidden" name="Album_id"
                           value="<?php echo $Album['AlbumID']; ?>">
                    <input type="hidden" name="Genre_id"
                           value="<?php echo $Album['GenreID']; ?>">
                    <input type="hidden" name="Artist_id"
                           value="<?php echo $Album['ArtistID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="add_album_form.php">Add Album</a></p>
        <p><a href="Genre_List.php">List Genres</a></p>    
        <p><a href="Artist_List.php">List Artists</a></p>     
    </section>
</main>
<footer>
    <p>Thanks for looking</p>
</footer>
</body>
</html>
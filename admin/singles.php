<?php include 'defines.php';
$connection = mysqli_connect($sever, $user, $pass, $database); ?>
<h2>Singles</h2>
<div>
    <?php if (isset($_GET['action'])) : ?>
        <a href="index.php?dashboard=singles">
            << Go Back</a>
            <?php else : ?>
                <a href="index.php?dashboard=singles&action=add">Add New Singles</a>
            <?php endif; ?>
</div>
<section>
    <?php

    // $_SERVER['REQUEST_METHOD'] == 'POST'

    if (isset($_GET['action'])) :
        if ($_GET['action'] == "add") {
            echo '<h3>Add a single</h3>';
        } elseif ($_GET['action'] == "edit") {
            echo '<h3>Edit single</h3>';
        } elseif ($_GET['action'] == "delete") {
            echo '<h3>Delte single</h3>';
        }

        // if post: execute query, if not give form to entery
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 'POST execute query:';
            $title = mysqli_real_escape_string($connection, $_POST['title']);
            $artist = mysqli_real_escape_string($connection, $_POST['artist']);
            $composer = mysqli_real_escape_string($connection, $_POST['composer']);
            $lyrics = mysqli_real_escape_string($connection, $_POST['lyrics']);
            $feat = mysqli_real_escape_string($connection, $_POST['feat']);
            $releasedate = mysqli_real_escape_string($connection, $_POST['releasedate']);
            $details = mysqli_real_escape_string($connection, $_POST['details']);
            $genre = mysqli_real_escape_string($connection, $_POST['genre']);
            // upload assets
            $audio;
            $img;
            $video;
            $audiodir  =  dirname(dirname(__FILE__)) . '/assets/singles/';
            $imgdir  =  dirname(dirname(__FILE__)) . '/assets/images/';
            $videodir  =  dirname(dirname(__FILE__)) . '/assets/video/';
            // upload audio
            if (isset($_FILES['audio'])) {
                $myFile = $_FILES['audio'];
                $audiofilename = $audiodir . basename($myFile['name']);
                move_uploaded_file($myFile["tmp_name"], $audiofilename);
            }
            // upload image
            if (isset($_FILES['image'])) {
                $myFile = $_FILES['image'];
                $imagefilename = $imgdir . basename($myFile['name']);
                move_uploaded_file($myFile["tmp_name"], $imagefilename);
            }
            // upload video
            if (isset($_FILES['video'])) {
                $myFile = $_FILES['video'];
                $videofilename = $videodir . basename($myFile['name']);
                move_uploaded_file($myFile["tmp_name"], $videofilename);
            }


            if ($_GET['action'] == "add") {
                $query = "INSERT INTO `singles`(`title`, `artist`, `composer`, `lyrics`, `feat`, `releasedate`, `audiofilename`, `imagefilename`, `videofilename`, `details`, `genre`) VALUES ('$title','$artist','$composer','$lyrics','$feat','$releasedate','$audiofilename','$imagefilename','$videofilename','$details','$genre')";
                $sql = mysqli_query($connection, $query);
                echo '<small class="msg">The single will be release on ' . $releasedate . '!</small>';
            } elseif ($_GET['action'] == "edit") {
                $id = $_GET['id'];
                $query = "UPDATE `singles` SET `title`='$title',`artist`='$artist',`composer`='$composer',`lyrics`='$lyrics',`feat`='$feat',`releasedate`='$releasedate',`audiofilename`='$audiofilename',`imagefilename`='$imagefilename',`videofilename`='$videofilename',`details`='$details',`genre`='$genre' WHERE `id`= '$id'";
                $sql = mysqli_query($connection, $query);
                echo '<small class="msg">The changes have been saved!</small>';
            }
            echo '<a href="index.php?dashboard=singles">Single List</a>';
        } elseif ($_GET['action'] == "delete") {
            $id = $_GET['id'];
            $query = "DELETE FROM singles WHERE id='$id'";
            $sql = mysqli_query($connection, $query);
            echo '<small class="msg">The single has been deleted!</small>';
            echo '<a href="index.php?dashboard=singles">single List</a>';
        } else {
            [$id, $prefill_title, $prefill_artist, $prefill_composer, $prefill_lyrics, $prefill_feat, $prefill_releasedate, $prefill_audiofilename, $prefill_imagefilename, $prefill_videofilename, $prefill_details, $prefill_genre] = array('', '', '', '', '', '', '', '', '', '', '', 'uncategorized');

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            if ($_GET['action'] == "edit") {
                $id = $_GET['id'];
                $query = "SELECT * FROM `singles` WHERE id = $id";
                $sql = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($sql);
                [$id, $prefill_title, $prefill_artist, $prefill_composer, $prefill_lyrics, $prefill_feat, $prefill_releasedate, $prefill_audiofilename, $prefill_imagefilename, $prefill_videofilename, $prefill_details, $prefill_genre] = array($id, $row['title'], $row['artist'], $row['composer'], $row['lyrics'], $row['feat'], $row['releasedate'], $row['audiofilename'], $row['imagefilename'], $row['videofilename'], $row['details'], $row['genre']);
            }
            echo '<form action="index.php?dashboard=singles&action=' . $_GET['action'] . '&id=' . $id . '" method="post" enctype="multipart/form-data">';
    ?>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required value="<?php echo $prefill_title; ?>">
            <label for="artist">Artist</label>
            <input type="text" name="artist" id="artist" required value="<?php echo $prefill_artist; ?>">
            <label for="composer">Composer</label>
            <input type="text" name="composer" id="composer" value="<?php echo $prefill_composer; ?>">
            <label for="lyrics">Lyrics</label>
            <input type="text" name="lyrics" id="lyrics" value="<?php echo $prefill_lyrics; ?>">
            <label for="feat">feat</label>
            <input type="text" name="feat" id="feat" value="<?php echo $prefill_feat; ?>">
            <label for="releasetime">Release Date Time</label>
            <input type="datetime-local" name="releasedate" id="releasedate" required value="<?php echo $prefill_releasedate; ?>">
            <label for="audio">Audio File</label>
            <input type="file" id="audio" name="audio" accept=".mp3,.wav" required value="<?php echo $prefill_audiofilename; ?>">
            <label for="image">Image File</label>
            <input type="file" id="image" name="image" accept=".jpg" required value="<?php echo $prefill_imagefilename; ?>">
            <label for="video">Video File</label>
            <input type="file" id="video" name="video" accept=".mp4" value="<?php echo $prefill_videofilename; ?>">
            <label for="details">Description/Lyrics</label>
            <textarea name="details" id="details" cols="60" rows="30"><?php echo $prefill_details; ?></textarea>
            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre" value="<?php echo $prefill_genre; ?>">
            <input type="submit" value="Add">
            </form>
        <?php

        }
        ?>


    <?php else : ?>
        <!-- Post List -->
        <table>
            <tr>
                <th>Title</th>
                <th>Release Date</th>
                <th>Genre</th>
                <th>Edit/Delete</th>
            </tr>
            <hr>
            <?php
            $query = "SELECT `id`, `title`, `releasedate`, `genre` FROM `singles` ";
            $sql = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($sql)) {
                echo '<tr id= "' . $row['id'] . '">';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['releasedate'] . '</td>';
                echo '<td>' . $row['genre'] . '</td>';
                echo '<td><a href="index.php?dashboard=singles&action=edit&id=' . $row['id'] . '">Edit</a><a href="index.php?dashboard=singles&action=delete&id=' . $row['id'] . '">Delete</a></td>';
                echo '</tr>';
            }

            ?>
        </table>

        <hr>
    <?php endif; ?>
</section>
<!-- <form action="index.php?dashboard=singles" enctype="multipart/form-data" method="post">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" required>
    <label for="artist">Artist</label>
    <input type="text" name="artist" id="artist" required>
    <label for="composer">Composer</label>
    <input type="text" name="composer" id="composer">
    <label for="lyrics">Lyrics</label>
    <input type="text" name="lyrics" id="lyrics">
    <label for="feat">feat</label>
    <input type="text" name="feat" id="feat">
    <label for="releasetime">Release Date Time</label>
    <input type="datetime" name="releasetime" id="releasetime" required>
    <label for="audio">Audio File</label>
    <input type="file" id="audio" name="audio" accept=".mp3,.wav" required>
    <label for="image">Image File</label>
    <input type="file" id="image" name="image" accept=".jpg" required>
    <label for="video">Video File</label>
    <input type="file" id="video" name="video" accept=".mp4">
    <label for="details">Description/Lyrics</label>
    <textarea name="details" id="details" cols="60" rows="30"></textarea>
    <label for="genre">Genre</label>
    <input type="text" name="genre" id="genre">
    <input type="submit" value="Add">
</form> -->
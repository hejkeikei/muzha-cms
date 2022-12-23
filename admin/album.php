<h2>Album</h2>
<div>
    <?php if (isset($_GET['action'])) : ?>
        <a href="index.php?dashboard=album" class="text-btn">
            << Go Back</a>
            <?php else : ?>
                <a href="index.php?dashboard=album&action=add" class="btn btn-theme btn-md">Add New albums</a>
            <?php endif; ?>
</div>
<section>
    <?php

    // $_SERVER['REQUEST_METHOD'] == 'POST'

    if (isset($_GET['action'])) :
        if ($_GET['action'] == "add") {
            echo '<h3>Add an Album</h3>';
        } elseif ($_GET['action'] == "edit") {
            echo '<h3>Edit Album</h3>';
        } elseif ($_GET['action'] == "delete") {
            echo '<h3>Delte Album</h3>';
        }

        // if post: execute query, if not give form to entery
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 'POST execute query:';
            $title = mysqli_real_escape_string($connection, $_POST['title']);
            $artist = mysqli_real_escape_string($connection, $_POST['artist']);
            $releasedate = mysqli_real_escape_string($connection, $_POST['releasedate']);
            $detail = mysqli_real_escape_string($connection, $_POST['detail']);
            if (is_array($_POST['track'])) {
                $list = mysqli_real_escape_string($connection, implode(",", $_POST['track']));
            } else {
                $list = mysqli_real_escape_string($connection, $_POST['track']);
            }

            // upload assets
            $img;
            $imgdir  =  dirname(dirname(__FILE__)) . '/assets/images/';
            $videodir  =  dirname(dirname(__FILE__)) . '/assets/video/';

            // upload image
            if (isset($_FILES['imagefilename'])) {
                $myFile = $_FILES['imagefilename'];
                $temp = explode(".", $myFile["name"]);
                $rename = toAscii($title) . '_album.' . end($temp);
                $imagefilename = $imgdir . $rename;
                move_uploaded_file($myFile["tmp_name"], $imagefilename);
            } else {
                $imagefilename = '';
            }
            // upload video
            if (isset($_FILES['video'])) {
                $myFile = $_FILES['video'];
                $rename = toAscii($title) . '_albumvideo.' . end($temp);
                $videofilename = $videodir . $rename;
                move_uploaded_file($myFile["tmp_name"], $videofilename);
            } else {
                $videofilename = '';
            }


            if ($_GET['action'] == "add") {
                $query = "INSERT INTO `albums`(`title`, `singles`, `artist`, `releasedate`, `imagefilename`, `details`, `videofilename`) VALUES ('$title','$list','$artist','$releasedate','$imagefilename','$detail','$videofilename')";
                $sql = mysqli_query($connection, $query);
                echo '<small class="msg">The album will be release on ' . $releasedate . '!</small>';
            } elseif ($_GET['action'] == "edit") {
                $id = $_GET['id'];

                $query = "UPDATE `albums` SET `title`='$title',`singles`='$list',`artist`='$artist',`release`='$releasedate',`imagefilename`='$imagefilename',`detail`='$detail' WHERE `id`= '$id'";
                $sql = mysqli_query($connection, $query);
                echo '<small class="msg">The changes have been saved!</small>';
            }
            echo '<a href="index.php?dashboard=album" class="btn btn-primary">Album List</a>';
        } elseif ($_GET['action'] == "delete") {
            $id = $_GET['id'];
            $query = "DELETE FROM albums WHERE id='$id'";
            $sql = mysqli_query($connection, $query);
            echo '<small class="msg">The album has been deleted!</small>';
            echo '<a href="index.php?dashboard=album" class="btn btn-primary">Album List</a>';
        } else {
            [$id, $prefill_title, $prefill_list, $prefill_artist, $prefill_releasedate, $prefill_imagefilename, $prefill_details] = array('', '', '', '', '', '', '');

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            if ($_GET['action'] == "edit") {
                $id = $_GET['id'];
                $query = "SELECT * FROM `albums` WHERE id = $id";
                $sql = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($sql);
                [$id, $prefill_title, $prefill_list, $prefill_artist, $prefill_releasedate, $prefill_imagefilename, $prefill_details] = array($id, $row['title'], $row['singles'], $row['artist'], $row['release'], $row['imagefilename'], $row['detail']);
            }
            echo '<form action="index.php?dashboard=album&action=' . $_GET['action'] . '&id=' . $id . '" method="post" enctype="multipart/form-data">';
    ?>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required value="<?php echo $prefill_title; ?>">
            <label for="artist">Artist</label>
            <input type="text" name="artist" id="artist" required value="<?php echo $prefill_artist; ?>">
            <div class="row">
                <div id="tracklist">
                    <div class="track">
                        <label for="track[]">Track 1</label>
                        <select name="track[]" id="track_1" required>
                            <option value="" disabled selected>---Single---</option>
                            <?php
                            $query = "SELECT `id`, `title` FROM `singles`";
                            $sql = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_array($sql)) {
                                echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <button id="add"><i class="fa-solid fa-circle-plus"></i></button>
            </div>
            <label for="releasetime" required>Release Date Time</label>
            <input type="datetime-local" name="releasedate" id="releasedate" required value="<?php echo $prefill_releasedate; ?>">
            <label for="imagefilename">Album Cover</label>
            <input type="file" name="imagefilename" id="imagefilename" accept=".jpg">
            <label for="videofilename">Promote Video</label>
            <input type="file" name="videoefilename" id="videofilename" accept=".mp4">
            <label for="detail">detail</label>
            <textarea name="detail" id="detail" cols="30" rows="10"><?php echo $prefill_details; ?></textarea>
            <div class="row">
                <input type="submit" value="Add" class="btn btn-outlined btn-md">
                <div id="loading"></div>
            </div>
            </form>
        <?php

        }
        ?>


    <?php else : ?>
        <!-- Post List -->
        <table>
            <thead>
                <th>Title</th>
                <th>Release Date</th>
                <th>Edit/Delete</th>
            </thead>

            <?php
            $query = "SELECT `id`, `title`, `releasedate` FROM `albums` ";
            $sql = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($sql)) {
                echo '<tr id= "' . $row['id'] . '">';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['releasedate'] . '</td>';
                echo '<td><a href="index.php?dashboard=album&action=edit&id=' . $row['id'] . '" class="btn btn-sm btn-outlined">Edit</a><a href="index.php?dashboard=album&action=delete&id=' . $row['id'] . '" class="btn btn-sm text-btn btn-danger">Delete</a></td>';
                echo '</tr>';
            }

            ?>
        </table>


    <?php endif; ?>
</section>
<?php include 'defines.php';
$connection = mysqli_connect($sever, $user, $pass, $database); ?>
<h2>Resource</h2>
<div>
    <?php if (isset($_GET['action'])) : ?>
        <a href="index.php?dashboard=resource" class="text-btn">
            << Go Back</a>
            <?php else : ?>
                <a href="index.php?dashboard=resource&action=add" class="btn btn-theme btn-md">Add New Track</a>
            <?php endif; ?>
</div>
<section>
    <?php

    // $_SERVER['REQUEST_METHOD'] == 'POST'

    if (isset($_GET['action'])) :
        if ($_GET['action'] == "add") {
            echo '<h3>Add a Track</h3>';
        } elseif ($_GET['action'] == "delete") {
            echo '<h3>Delte Track</h3>';
        }

        // if post: execute query, if not give form to entery
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 'POST execute query:';
            $title = mysqli_real_escape_string($connection, $_POST['title']);
            // upload assets
            $midi;
            $instrumental;
            $mididir  =  dirname(dirname(__FILE__)) . '/assets/midi/';
            $instrumentaldir  =  dirname(dirname(__FILE__)) . '/assets/instrumental/';
            // upload midi
            if (isset($_FILES['midi'])) {
                $myFile = $_FILES['midi'];

                $midifilename = $mididir . basename($myFile['name']);

                move_uploaded_file($myFile["tmp_name"], $midifilename);
            }
            // upload instrumental
            if (isset($_FILES['instrumental'])) {
                $myFile = $_FILES['instrumental'];

                $instrumentalfilename = $instrumentaldir . basename($myFile['name']);

                move_uploaded_file($myFile["tmp_name"], $instrumentalfilename);
            }



            if ($_GET['action'] == "add") {
                $query = "INSERT INTO `resources`(`title`, `midi`, `instrumental`) VALUES ('$title','$midifilename','$instrumentalfilename')";
                $sql = mysqli_query($connection, $query);
                echo '<small class="msg">The track has been saved!</small>';
            }

            echo '<a href="index.php?dashboard=resource" class="btn btn-primary">Track List</a>';
        } elseif ($_GET['action'] == "delete") {
            $id = $_GET['id'];
            $query = "DELETE FROM resources WHERE id='$id'";
            $sql = mysqli_query($connection, $query);
            echo '<small class="msg">The track has been deleted!</small>';
            echo '<a href="index.php?dashboard=resource" class="btn btn-primary">Track List</a>';
        } else {
            $id = '';
            $prefill_title = '';
            $prefill_midi = '';
            $prefill_instrumental = '';

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            if ($_GET['action'] == "edit") {
                $id = $_GET['id'];
                $query = "SELECT * FROM `resources` WHERE id = $id";
                $sql = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($sql);
                $prefill_title = $row['title'];
                $prefill_midi = $row['midi'];
                $prefill_instrumental = $row['instrumental'];
            }
            echo '<form action="index.php?dashboard=resource&action=' . $_GET['action'] . '&id=' . $id . '" method="post" enctype="multipart/form-data">';
    ?>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required value="<?php echo $prefill_title; ?>">

            <label for="midi">MIDI File</label>
            <input type="file" id="midi" name="midi" accept=".mid" value="<?php echo $prefill_midi; ?>">
            <label for="instrumental">Instrumental File</label>
            <input type="file" id="instrumental" name="instrumental" accept=".mp3,.wav" required value="<?php echo $prefill_instrumental; ?>">

            <input type="submit" value="Add" class="btn btn-outlined btn-md">
            </form>
        <?php

        }
        ?>


    <?php else : ?>
        <!-- Post List -->
        <table>
            <thead>
                <th>Title</th>
                <th>MIDI</th>
                <th>Instrumental</th>
                <th>Delete</th>
            </thead>

            <?php
            $query = "SELECT * FROM `resources`";
            $sql = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($sql)) {
                $midifile = explode("/", $row['midi']);
                $instrumentalfile = explode("/", $row['instrumental']);

                echo '<tr id= "' . $row['id'] . '">';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td><a href="../assets/midi/' . $midifile[count($midifile) - 1] . '" download="' . $row['title'] . '-midi.mid" class="btn btn-sm btn-download btn-midi">Download</a></td>';
                echo '<td><a href="../assets/instrumental/' . $instrumentalfile[count($instrumentalfile) - 1] . '" download="' . $row['title'] . '-instrumental.mp3" class="btn btn-sm btn-download btn-instrumental">Download</a></td>';
                echo '<td><a href="index.php?dashboard=resource&action=delete&id=' . $row['id'] . '" class="btn btn-sm text-btn btn-danger">Delete</a></td>';
                echo '</tr>';
            }

            ?>
        </table>


    <?php endif; ?>
</section>
<section>
    <?php
    if (!isset($_GET['action'])) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['terms'])) {
            $filepath = dirname(dirname(__FILE__)) . '/assets/LICENSE.txt';
            $license = fopen($filepath, "w") or die("Unable to save license.");
            $txt = $_POST['terms'];
            fwrite($license, $txt);
            fclose($license);
        }

    ?>
        <h3>License</h3>
        <form action="" method="post">
            <label for="terms">Terms and Conditions</label>
            <textarea name="terms" id="terms" cols="60" rows="20">
            <?php
            $filepath = dirname(dirname(__FILE__)) . '/assets/LICENSE.txt';
            $license = fopen($filepath, "r") or die("Unable to open license.");
            echo fread($license, filesize($filepath));
            fclose($license);
            ?>
        </textarea>
            <input type="submit" value="Save" id="licenseSave" class="btn btn-outlined btn-md">
        </form>
    <?php } ?>
</section>
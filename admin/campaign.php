<h2>Campaign</h2>
<div>
    <?php if (isset($_GET['action'])) : ?>
        <a href="index.php?dashboard=campaign" class="text-btn">
            << Go Back</a>
            <?php else : ?>
                <a href="index.php?dashboard=campaign&action=add" class="btn btn-theme btn-md">Add a Campaign</a>
            <?php endif; ?>
</div>
<section>
    <?php

    // $_SERVER['REQUEST_METHOD'] == 'POST'

    if (isset($_GET['action'])) :
        if ($_GET['action'] == "add") {
            echo '<h3>Add a Campaign</h3>';
        } elseif ($_GET['action'] == "delete") {
            echo '<h3>Delte Campaign</h3>';
        }

        // if post: execute query, if not give form to entery
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imgdir  =  dirname(dirname(__FILE__)) . '/assets/images/';
            $videodir  =  dirname(dirname(__FILE__)) . '/assets/video/';
            // 'POST execute query:';
            $title = mysqli_real_escape_string($connection, $_POST['title']);
            $slogan = mysqli_real_escape_string($connection, $_POST['slogan']);
            $ytb = mysqli_real_escape_string($connection, $_POST['ytb']);
            $sales = mysqli_real_escape_string($connection, $_POST['sales']);

            // Hero image upload and rename
            if (isset($_FILES['hero'])) {
                $myFile = $_FILES['hero'];
                $temp = explode(".", $myFile["name"]);
                $rename = toAscii($title) . '_hero.' . end($temp);
                $herofilename = $imgdir . $rename;
                // echo $herofilename;
                move_uploaded_file($myFile["tmp_name"], $herofilename);
            } else {
                $herofilename = '';
                // echo "file hero is not set";
            }
            // if select single/album, don't take data from manual inputs
            if (isset($_POST['promote'])) {
                // echo 'select single';
                $arr = explode("-", $_POST['promote']);
                $type = mysqli_real_escape_string($connection, $arr[0]);
                $no = mysqli_real_escape_string($connection, $arr[1]);
                $promoteQuery = "SELECT * FROM $type WHERE id = $no";
                $promoteSQL = mysqli_query($connection, $promoteQuery);
                $promoteRow = mysqli_fetch_array($promoteSQL);
                // print_r($promoteRow);
                $releasedate = $promoteRow['releasedate'];
                $details = $promoteRow['details'];
                $video = $promoteRow['videofilename'];
                $background = $promoteRow['imagefilename'];
            } else {

                if (isset($_FILES['background'])) {
                    $myFile = $_FILES['background'];
                    $temp = explode(".", $myFile["name"]);
                    $rename = toAscii($title) . '_bg.' . end($temp);
                    $bgfilename = $imgdir . $rename;
                    move_uploaded_file($myFile["tmp_name"], $bgfilename);
                } else {
                    $background = '';
                }

                if (isset($_FILES['video'])) {
                    $myFile = $_FILES['video'];
                    $temp = explode(".", $myFile["name"]);
                    $rename = toAscii($title) . '-video.' . end($temp);
                    $video = $videodir . $rename;
                    move_uploaded_file($myFile["tmp_name"], $video);
                } else {
                    $video = '';
                }

                $releasedate = mysqli_real_escape_string($connection, $_POST['releasedate']);
                $details = mysqli_real_escape_string($connection, $_POST['details']);


                $background = $bgfilename;
            }
            if ($_GET['action'] == "add") {
                $query = "INSERT INTO `campaign`(`title`, `slogan`, `type`, `no`, `releasedate`, `details`, `video`, `ytb`, `background`, `sales`, `hero`, `setting`) VALUES ('$title','$slogan','$type','$no','$releasedate','$details','$video','$ytb','$background','$sales','$herofilename','$type')";
                $sql = mysqli_query($connection, $query);
                echo '<small class="msg">Your campaign has been created!</small>';
                // echo '<a href="index.php?dashboard=post">Post List</a>';
            }

            echo '<a href="index.php?dashboard=campaign" class="btn btn-primary">Campaign List</a>';
        } elseif ($_GET['action'] == "delete") {
            $id = $_GET['id'];
            $query = "DELETE FROM campaign WHERE id='$id'";
            $sql = mysqli_query($connection, $query);
            echo '<small class="msg">The campaign has been deleted!</small>';
            echo '<a href="index.php?dashboard=campaign" class="btn btn-primary">Campaign List</a>';
        } elseif ($_GET['action'] == "set") {
            $query = "SELECT `id`, `setting` FROM `campaign`";
            $sql = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($sql)) {

                $setFalseId = $row['id'];
                $setFalseQuery = "UPDATE `campaign` SET `setting`='0' WHERE `id`='$setFalseId'";
                $setFalsesql = mysqli_query($connection, $setFalseQuery);
            }
            $id = $_GET['id'];
            $updateQuery = "UPDATE `campaign` SET `setting`='1' WHERE `id`='$id'";
            $sql = mysqli_query($connection, $updateQuery);
            echo '<small class="msg">This campaign is online now!</small>';
            echo '<a href="index.php?dashboard=campaign" class="btn btn-primary">Campaign List</a>';
        } else {

            $id = '';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }


            echo '<form action="index.php?dashboard=campaign&action=' . $_GET['action'] . '&id=' . $id . '" method="post" enctype="multipart/form-data">';
    ?>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?php //echo $prefill_title; 
                                                                ?>" required>
            <label for="slogan">Slogan / Catchphrase</label>
            <input type="text" name="slogan" id="slogan" value="<?php //echo $prefill_slogan; 
                                                                ?>" required>
            <div class="row">
                <button class="btn btn-sm btn-theme" id="choose">Choose a Single</button>
                <span>or</span>
                <button class="btn btn-sm btn-outlined" id="manul">Set Manually</button>
            </div>
            <fieldset id="campaignSingle" class="hidden">
                <legend>Choose a Single/Album</legend>
                <select name="promote" id="promote">
                    <option value="" disabled selected>---Single---</option>
                    <?php
                    $query = "SELECT `id`, `title`, `artist`, `composer`, `lyrics`, `feat`, `releasedate`, `audiofilename`, `imagefilename`, `videofilename`, `details`, `genre` FROM `singles`";
                    $sql = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_array($sql)) {
                        echo '<option value="singles-' . $row['id'] . '">' . $row['title'] . '</option>';
                    }
                    ?>
                    <option value="" disabled>---Album---</option>
                    <?php
                    $query = "SELECT `id`, `title`, `singles`, `artist`, `releasedate`, `imagefilename`, `details` FROM `albums`";
                    $sql = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_array($sql)) {
                        echo '<option value="albums-' . $row['id'] . '">' . $row['title'] . '</option>';
                    }
                    ?>
                </select>
            </fieldset>
            <fieldset class="hidden" id="campaignManual">
                <legend>Set Manually</legend>
                <label for="date">Release Date</label>
                <input type="date" name="date" id="date" value="<?php //echo $prefill_releasedate; 
                                                                ?>">
                <label for="details">Description</label>
                <textarea name="details" id="details" cols="60" rows="20"></textarea>
                <label for="video">Video(File)</label>
                <input type="file" name="video" id="video" accept=".mp4,.mov">
                <label for="background">Main Visuals(Background)</label>
                <input type="file" name="background" id="background" accept=".jpg,.png">
            </fieldset>
            <label for="ytb">YouTube Link</label>
            <input type="text" name="ytb" id="ytb" value="<?php //echo $prefill_ytb; 
                                                            ?>">
            <label for="sales">Sale Link</label>
            <input type="text" name="sales" id="sales" value="<?php //echo $prefill_sales; 
                                                                ?>">
            <label for="hero">Extra Image (Foreground)</label>
            <input type="file" name="hero" id="hero" accept=".png">
            <div class="row">
                <input type="submit" value="Create Campaign" class="btn btn-outlined btn-md">
                <div id="loading"></div>
            </div>
        <?php
            echo '</form>';
        }
        ?>

    <?php else : ?>
        <!-- Post List -->
        <table>
            <thead>
                <th>Title</th>
                <th>Date</th>
                <th>Set</th>
                <th>Delete</th>
            </thead>
            <hr>
            <?php
            $query = "SELECT `id`,`title`, `releasedate`, `setting` FROM `campaign` ";
            $sql = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_array($sql)) {
                echo '<tr id= "' . $row['id'] . '">';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['releasedate'] . '</td>';
                if ($row['setting'] != true) {
                    echo '<td><a href="index.php?dashboard=campaign&action=set&id=' . $row['id'] . '" class="btn btn-sm btn-outlined">Set as current campaign</a></td>';
                } else {
                    echo '<td>Current campaign</td>';
                }
                echo '<td><a href="index.php?dashboard=campaign&action=delete&id=' . $row['id'] . '" class="btn btn-sm btn-outlined btn-danger">Delete</a></td>';
                echo '</tr>';
            }

            ?>
        </table>


        <hr>
    <?php endif; ?>

</section>
<!-- <form action="">
    <label for="title">Title</label>
    <input type="text" name="title" id="title">
    <label for="slogan">Slogan / Catchphrase</label>
    <input type="text" name="slogan" id="slogan">
    <div class="row">
        <button class="btn">Choose a Single</button>
        <button class="btn">Set Manually</button>
    </div>
    <fieldset>
        <legend>Choose a Single</legend>
        <select name="single" id="single">
            <option value=""></option>
        </select>
    </fieldset>
    <fieldset>
        <legend>Set Manually</legend>
        <label for="date">Release Date</label>
        <input type="date" name="date" id="date">
        <label for="details">Description</label>
        <textarea name="details" id="details" cols="60" rows="20"></textarea>
        <label for="video">Video(File)</label>
        <input type="file" name="video" id="video" accept=".mp4,.mov">
        <label for="ytb">YouTube Link</label>
        <input type="text" name="ytb" id="ytb">
        <label for="background">Main Visuals(Background)</label>
        <input type="file" name="background" id="background" accept=".jpg,.png">
    </fieldset>
    <label for="sales">Sale Link</label>
    <input type="text" name="sales" id="sales">
    <label for="hero">Extra Image (Foreground)</label>
    <input type="file" name="hero" id="hero" accept="">

    <input type="submit" value="Create Campaign">
</form> -->
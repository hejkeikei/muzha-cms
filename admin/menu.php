<h2>Menu</h2>
<?php
include 'defines.php';
$connection = mysqli_connect($sever, $user, $pass, $database);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $arr = ['single', 'album', 'post', 'resource', 'campaign'];
    $query = "SELECT count(*) FROM `menu`";
    // $sql = mysqli_query($connection, $query);
    $result = mysqli_query($connection, $query) or die("Error in query: $query. " . mysqli_error($connection));
    $row = mysqli_fetch_array($result);
    // print_r($row);
    if ($row['count(*)'] > 0) {
        $var = 'UPDATE';
        foreach ($arr as $option) {
            if (!isset($_POST[$option])) {
                $val = FALSE;
            } else {
                $val = TRUE;
            }
            $query = "UPDATE `menu` SET `option_value`='$val' WHERE `option_name`= '$option'";
            mysqli_query($connection, $query);
        }
    } else {
        $var = 'INSERT';
        foreach ($arr as $option) {
            // echo $_POST[$option] . " / ";
            if (!isset($_POST[$option])) {
                $val = FALSE;
            } else {
                $val = TRUE;
            }
            $query = "INSERT INTO `menu`(`option_name`, `option_value`) VALUES ('$option','$val')";
            mysqli_query($connection, $query);
        }
    }
    echo '<small class="msg">Your settings has been saved!</small>';
}
$bool = 'checked';
$query = "SELECT count(*) FROM `menu`";
// $sql = mysqli_query($connection, $query);
$result = mysqli_query($connection, $query) or die("Error in query: $query. " . mysqli_error($connection));
$row = mysqli_fetch_array($result);
// print_r($row);
if ($row['count(*)'] > 0) {
    $query = "SELECT `option_name`, `option_value` FROM `menu`";
    $sql = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($sql)) {
        if ($row['option_value'] == 1) {
            $bool = 'checked';
        } else {
            $bool = '';
        }
        $var = $row['option_name'];
        $$var = $bool;

        // echo $$var;
        // echo ' / ';
    }
}
?>
<form action="index.php?dashboard=menu&save=true" method="post">
    <div class="row">
        <label for="single">single</label>
        <input type="checkbox" name="single" id="single" <?php echo $single; ?>>
    </div>
    <div class="row">
        <label for="album">album</label>
        <input type="checkbox" name="album" id="album" <?php echo $album; ?>>
    </div>
    <div class="row">
        <label for="post">post</label>
        <input type="checkbox" name="post" id="post" <?php echo $post; ?>>
    </div>
    <div class="row">
        <label for="resource">resource</label>
        <input type="checkbox" name="resource" id="resource" <?php echo $resource; ?>>
    </div>
    <div class="row">
        <label for="campaign">campaign</label>
        <input type="checkbox" name="campaign" id="campaign" <?php echo $campaign; ?>>
    </div>
    <div class="row">
        <input type="submit" value="Save">
    </div>


</form>
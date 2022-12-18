<h2>Settings</h2>
<?php
$query = "SELECT * FROM settings";
include 'defines.php';
$connection = mysqli_connect($sever, $user, $pass, $database);
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$arr = ['artist', 'description', 'email', 'adminemail', 'sns1', 'sns2', 'sns3'];
if ($row) {
    $var = 'UPDATE';
    // input value prefill
    foreach ($arr as $value) {
        $select_query = "SELECT `option_name`, `option_value` FROM `settings` WHERE `option_name` = '$value'";
        $select_sql = mysqli_query($connection, $select_query);
        $select_row = mysqli_fetch_array($select_sql);
        $$value = $select_row['option_value'];
    }
} else {
    $var = 'INSERT';
    $artist = '';
    $description = '';
    $email = '';
    $adminemail = '';
    $sns1 = '';
    $sns2 = '';
    $sns3 = '';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET['action'];
    $arr = ['artist', 'description', 'email', 'adminemail', 'sns1', 'sns2', 'sns3'];
    foreach ($arr as $value) {
        $sanitize = mysqli_real_escape_string($connection, $_POST[$value]);
        if ($action == 'INSERT') {
            $query = "$action INTO settings (option_name, option_value) VALUES ('$value','$sanitize')";
        } else {
            $query = "UPDATE `settings` SET `option_value`='$sanitize' WHERE `option_name`= '$value'";
        }
        $sql = mysqli_query($connection, $query);
        if (!$sql) {
            die(mysqli_connect_error());
        }
    }
    echo '<small class="msg">Your settings has been saved!</small>';
}
// if ($_SERVER['REQUEST_METHOD'] != 'POST') :

?>
<form action="index.php?dashboard=settings&action=<?php echo $var; ?>" method="post">
    <label for="artist">Artist Name</label>
    <input type="text" name="artist" id="artist" value="<?php echo $artist; ?>">

    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"><?php echo $description; ?></textarea>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?php echo $email; ?>">

    <label for="adminemail">Admin Email</label>
    <input type="email" name="adminemail" id="adminemail" value="<?php echo $adminemail; ?>">

    <label for="sns1">Social Media(1)</label>
    <input type="text" name="sns1" id="sns1" value="<?php echo $sns1; ?>">

    <label for="sns2">Social Media(2)</label>
    <input type="text" name="sns2" id="sns2" value="<?php echo $sns2; ?>">

    <label for="sns3">Social Media(3)</label>
    <input type="text" name="sns3" id="sns3" value="<?php echo $sns3; ?>">


    <label for="password" class="btn-sm">Reset Admin Password</label>
    <input type="password" name="password" id="password" class="hidden">

    <input type="submit" value="Save">
</form>
<?php //else : 
?>

<?php //endif; 
?>
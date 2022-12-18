<h2>Connect to Database</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newHost = $_POST['host'];
    $newDb = $_POST['db'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    // echo $newHost . '<br>' . $newDb . '<br>' . $newUsername . '<br>' . $newPassword;
}
$myfile = fopen("defines.php", "w") or die("Unable to establish connection.");
$txt = '<?php $sever = "' . $newHost . '";
$database = "' . $newDb . '";
$user = "' . $newUsername . '";
$pass= "' . $newPassword . '";';
fwrite($myfile, $txt);
// $txt2 = "\r echo 'defines.php linked.';";
// fwrite($myfile, $txt2);
fclose($myfile);

<?php
include 'admin/defines.php';
$connection = mysqli_connect($sever, $user, $pass, $database);
if (!$connection) {
    header("Location: 404.php");
    die();
} else {
    $query = "SELECT * FROM settings";
    $sql = mysqli_query($connection, $query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>

</body>

</html>
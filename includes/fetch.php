<?php
$connection = mysqli_connect($sever, $user, $pass, $database);
$arr = [];
if (isset($_GET['id'])) {
    $trackid = $_GET['id'];
    $query = "SELECT `id`,`singles` FROM `albums` WHERE `id`=$trackid";
    $sql = mysqli_query($connection, $query);
    if ($sql) {
        $row = mysqli_fetch_array($sql);
        $id = $row['id'];
        $list = explode(",", $row['singles']);
        foreach ($list as $key) {
            $tracksquery = "SELECT `id`,`audiofilename`, `imagefilename` FROM `singles` WHERE `id`=$key";
            $trackssql = mysqli_query($connection, $tracksquery);
            $track = mysqli_fetch_array($trackssql);
            $pair = array("id" => $track['id'], "track" => $track['audiofilename'], "img" => $track['imagefilename'],);
            $arr[] = $pair;
        }
    }
}

$jsonString = json_encode($arr, JSON_PRETTY_PRINT);
$path = 'assets/player.json';
$fp = fopen($path, 'w');
fwrite($fp, $jsonString);
fclose($fp);

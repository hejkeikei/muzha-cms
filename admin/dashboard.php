<?php
include 'defines.php';
$connection = mysqli_connect($sever, $user, $pass, $database);
if (!$connection && $_SERVER['REQUEST_METHOD'] == 'POST') :
    // die(mysqli_connect_error());  
    include 'connect.php';
    echo 'connect.php linked.';
elseif (!$connection) :
?>
    <h2>Connect to Database</h2>
    <form action="index.php?connect=true" method="post">
        <label for="host">Server</label>
        <input type="text" name="host" id="host" value="localhost">

        <label for="db">Database name</label>
        <input type="text" name="db" id="db">

        <label for="username">User name</label>
        <input type="text" name="username" id="username">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Create Database">

    </form>
<?php else : ?>
    <h2>Main dashboard</h2>
<?php endif; ?>
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
    <form action="index.php?dashboard=connect" method="post">
        <label for="host">Server</label>
        <input type="text" name="host" id="host" value="localhost" required>

        <label for="db">Database name</label>
        <input type="text" name="db" id="db" required>

        <label for="username">Database User name</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Database Password</label>
        <input type="password" name="password" id="password" required>

        <h3>Create Admin Account</h3>

        <label for="admin">Admin Username</label>
        <input type="text" name="admin" id="admin" required>

        <label for="adminemail">Admin Email</label>
        <input type="email" name="adminemail" id="adminemail" required>

        <label for="adminpass">Admin Password</label>
        <input type="password" name="adminpass" id="adminpass" required>

        <label for="confirmpass">Confrim Admin Password</label>
        <input type="password" name="confirmpass" id="confirmpass" required>

        <input type="submit" value="Create Database Connection">

    </form>
<?php else : ?>
    <h2>Main dashboard</h2>
<?php endif; ?>
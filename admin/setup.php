<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muzha CMS | Set up</title>
    <link rel="stylesheet" href="style.css">
</head>

<body id="setup">
    <h1>Muzha</h1>

    <?php
    include 'defines.php';
    $connection = mysqli_connect($sever, $user, $pass, $database);
    if (!$connection && $_SERVER['REQUEST_METHOD'] == 'POST') :
        // die(mysqli_connect_error());  
        include 'connect.php';
    // echo 'connect.php linked.';
    elseif ($_GET['connect'] == true) :
        echo 'start building tables';
        include 'connect.php';
    ?>

    <?php else : ?>
        <h2>Connect to Database</h2>
        <form action="setup.php?connect=true" method="post">
            <div class="wrap">
                <h3>Database Info</h3>
                <label for="host">Server</label>
                <input type="text" name="host" id="host" value="localhost" required>

                <label for="db">Database name</label>
                <input type="text" name="db" id="db" required>

                <label for="username">Database User name</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Database Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="wrap">
                <h3>Create Admin Account</h3>

                <label for="admin">Admin Username</label>
                <input type="text" name="admin" id="admin" required>

                <label for="adminemail">Admin Email</label>
                <input type="email" name="adminemail" id="adminemail" required>

                <label for="adminpass">Admin Password</label>
                <input type="password" name="adminpass" id="adminpass" required>

                <label for="confirmpass">Confrim Admin Password</label>
                <input type="password" name="confirmpass" id="confirmpass" required><small class="danger hidden" id="notice"> <i class="fa-solid fa-circle-exclamation"></i> Please enter same password</small>
                <input type="submit" value="Connect" class="btn btn-primary">
            </div>


        </form>
    <?php endif; ?>

</body>
<script src="script.js"></script>

</html>
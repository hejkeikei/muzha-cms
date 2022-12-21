<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/e2110d24a9.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav>
            <h1>Dashboard</h1>
            <a href="login.php" class="btn btn-primary btn-md">Logout</a>
        </nav>
    </header>
    <aside>
        <h3>Panels</h3>
        <ul>
            <li><a href="index.php"><i class="fa-solid fa-house"></i>Home</a></li>
            <li><a href="index.php?dashboard=singles"><i class="fa-solid fa-music"></i>Single</a></li>
            <li><a href="index.php?dashboard=album"><i class="fa-solid fa-compact-disc"></i>Album</a></li>
            <li><a href="index.php?dashboard=post"><i class="fa-solid fa-newspaper"></i>Post</a></li>
            <li><a href="index.php?dashboard=resource"><i class="fa-solid fa-file-audio"></i>Resource</a></li>
            <li><a href="index.php?dashboard=campaign"><i class="fa-solid fa-bullhorn"></i>Campaign</a></li>
            <li><a href="index.php?dashboard=menu"><i class="fa-solid fa-bars"></i>Menu</a></li>
            <li><a href="index.php?dashboard=style"><i class="fa-solid fa-palette"></i>Style</a></li>
            <li><a href="index.php?dashboard=users"><i class="fa-solid fa-users"></i>Users</a></li>
            <li><a href="index.php?dashboard=settings"><i class="fa-solid fa-gear"></i>Settings</a></li>
        </ul>
    </aside>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['dashboard'])) {
        $dashboard = $_GET['dashboard'];
        echo "<main id=" . $dashboard . ">";
        // echo "$dashboard.php";
        include $dashboard . ".php";
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['dashboard'] == 'settings') {
        $dashboard = $_GET['dashboard'];
        echo "<main id=" . $dashboard . ">";
        // echo "settings.php";
        include "settings.php";
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['dashboard'])) {
        $dashboard = $_GET['dashboard'];
        echo "<main id=" . $dashboard . ">";
        // echo "$dashboard.php";
        include "$dashboard.php";
    } else {
        $dashboard = 'dashboard';
        echo "<main id=" . $dashboard . ">";
        // echo "else $dashboard";
        include $dashboard . ".php";
    }
    ?>

    </main>
    <footer>Muzha CMS</footer>
</body>

</html>
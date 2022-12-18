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
    <title>|Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <h1>|Dashboard</h1>
            <a href="admin/index.php?logout=true">Logout</a>
        </nav>
    </header>
    <aside>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?dashboard=single">Single</a></li>
            <li><a href="index.php?dashboard=album">Album</a></li>
            <li><a href="index.php?dashboard=post">Post</a></li>
            <li><a href="index.php?dashboard=resource">Resource</a></li>
            <li><a href="index.php?dashboard=campaign">Campaign</a></li>
            <li><a href="index.php?dashboard=menu">Menu</a></li>
            <li><a href="index.php?dashboard=settings">Settings</a></li>
        </ul>
    </aside>
    <main>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['dashboard'])) {
            $dashboard = $_GET['dashboard'];
            echo "$dashboard.php";
            include $dashboard . ".php";
        } else {
            $dashboard = 'dashboard';
            echo "else $dashboard";
            include $dashboard . ".php";
        }
        ?>

    </main>
    <footer>Muzha CMS</footer>
</body>

</html>
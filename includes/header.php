<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'admin/defines.php';
$conn = mysqli_connect($sever, $user, $pass, $database);
if (!$conn) {
    header("Location: 404.php");
    die();
} else {
    include 'includes/functions.php';
}

$cur_dir = explode('/', getcwd());
$root = $cur_dir[count($cur_dir) - 1];
$currentPage = trim($_SERVER['SCRIPT_NAME'], "/.php");
if ($currentPage == 'index') {
    $bodyclass = 'Home';
} else {
    $bodyclass = $currentPage;
}

$filename = 'css/' . $currentPage . '.css';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_info('artist'); ?> | <?php echo $bodyclass; ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo get_info('favicon'); ?>">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <script src="https://kit.fontawesome.com/e2110d24a9.js" crossorigin="anonymous"></script>
    <?php if (file_exists($filename)) {
        echo '<link rel="stylesheet" href="' . $filename . '">';
    }
    if ($bodyclass == 'single') {
        echo '<link rel="stylesheet" href="css/player.css">';
    }
    ?>
</head>

<body class="<?php echo $bodyclass; ?>">
    <div id="page-container">
        <div id="content-wrap">
            <header id="mainHeader" class="index-header">
                <h1><a href="index"><img src="<?php echo get_info('logo'); ?>" alt="<?php echo get_info('artist'); ?>" width="100"></a></h1>
                <nav id="menu">
                    <input type="checkbox" name="menuCheck" id="menuCheck">
                    <label for="menuCheck" id="toggle"><span></span></label>
                    <ul id="menulist">
                        <?php
                        $menunquery = "SELECT `option_name`, `option_value` FROM `menu`";
                        if ($menunsql = mysqli_query($conn, $menunquery)) {
                            while ($menurow = mysqli_fetch_array($menunsql)) {
                                if ($menurow['option_value']) {
                                    echo '<li><a href="' . $menurow['option_name'] . '">' .  ucfirst($menurow['option_name']) . '</a></li>';
                                }
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </header>
            <main id="<?php echo $bodyclass; ?>Main">
                <?php
                if ($currentPage != 'index') {
                    echo '<h2 class="page-heading">' . ucfirst($bodyclass) . '</h2>';
                }
                ?>
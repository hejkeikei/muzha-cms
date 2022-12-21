<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muzha - Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>

    </header>
    <aside>
        <h1>Login</h1>
    </aside>
    <main>
        <div class="wrap" id="mainWrap">
            <h2>Welcome!</h2>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                unset($_COOKIE['user_name']);
                setcookie("user_name", FALSE, time() - 6000);
                echo "<p class='msg'>Logged out successfully.</p>";
                header("Refresh:1");
                exit;
            }
            if (isset($_COOKIE['user_name'])) {
                echo "<h2>Welcome back, " . $_COOKIE['user_name'] . "</h2>";
                echo '<a href="index.php" class="bt">Go to dashboard</a>';
                echo "<style>form,#login_h2{display:none;}</style>";
            }
            ?>

            <form action="index.php?dashboard=dashboard" method="post">
                <fieldset>
                    <legend>User Name</legend>
                    <label for="user_name">
                        <input type="text" name="user_name" id="user_name" required value="<?php if (isset($_COOKIE['user_name'])) {
                                                                                                echo $_COOKIE['user_name'];
                                                                                            } ?>">
                    </label>
                </fieldset>
                <fieldset>
                    <legend>Password</legend>
                    <label for="password">
                        <input type="password" name="password" id="password" required>
                    </label>
                </fieldset>
                <input type="submit" value="Log In" class="btn">
            </form>
        </div>
    </main>
    <footer>Muzha CMS</footer>
</body>

</html>
<?php ob_end_flush(); ?>
<h2>Connect to Database</h2>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newHost = $_POST['host'];
    $newDb = $_POST['db'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    // echo $sever . '<br>' . $user . '<br>' . $pass . '<br>' . $database;
    // echo "get= " . $_GET['connect'];
    $myfile = fopen("defines.php", "w") or die("Unable to establish connection.");
    $txt = '<?php $sever = "' . $newHost . '";
    $database = "' . $newDb . '";
    $user = "' . $newUsername . '";
    $pass= "' . $newPassword . '";';
    fwrite($myfile, $txt);
    // $txt2 = "\r echo 'defines.php linked.';";
    // fwrite($myfile, $txt2);
    fclose($myfile);
    echo '<a href="index.php?dashboard=connect&connect=true">Establish Database</a>';
} else if ($_GET['connect'] == true) {
    include 'defines.php';
    // echo $sever . '<br>' . $user . '<br>' . $pass . '<br>' . $database;
    $connection = mysqli_connect($sever, $user, $pass, $database);
    if (!$connection) {
        die(mysqli_connect_error());
    }
    echo 'get connect = true';
    $sql = "CREATE TABLE settings(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        option_name VARCHAR(30) NULL,
        option_value TEXT NOT NULL
    )";
    if (mysqli_query($connection, $sql)) {
        // echo "Table 'settings' created successfully.";
    } else {
        // echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    }
    $sql2 = "CREATE TABLE singles(
         `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(50) NOT NULL , `artist` VARCHAR(30) NOT NULL , `composer` VARCHAR(30) NULL , `lyrics` VARCHAR(30) NULL , `feat` VARCHAR(30) NULL , `releasedate` DATETIME NOT NULL , `audiofilename` VARCHAR(50) NOT NULL , `imagefilename` VARCHAR(50) NOT NULL , `videofilename` VARCHAR(50) NULL , `details` TEXT NULL , `genre` VARCHAR(15) NULL DEFAULT 'uncategorized' , PRIMARY KEY (`id`)
    )";
    if (mysqli_query($connection, $sql2)) {
        // echo "Table 'singles' created successfully.";
    } else {
        // echo "ERROR: Could not able to execute $sql2. " . mysqli_error($connection);
    }

    $sql3 = "CREATE TABLE albums(
        `id` INT NOT NULL AUTO_INCREMENT , `singles` VARCHAR(200) NOT NULL , `release` DATE NOT NULL , `imagefilename` VARCHAR(30) NOT NULL , `detail` TEXT NOT NULL , PRIMARY KEY (`id`)
    )";
    if (mysqli_query($connection, $sql3)) {
        // echo "Table 'albums' created successfully.";
    } else {
        // echo "ERROR: Could not able to execute $sql3. " . mysqli_error($connection);
    }

    $sql4 = "CREATE TABLE posts(
        `id` INT NOT NULL AUTO_INCREMENT , `post` VARCHAR(50) NOT NULL , `postdate` DATE NOT NULL , `content` TEXT NOT NULL , PRIMARY KEY (`id`)
    )";
    if (mysqli_query($connection, $sql4)) {
        // echo "Table 'posts' created successfully.";
    } else {
        // echo "ERROR: Could not able to execute $sql4. " . mysqli_error($connection);
    }

    $sql5 = "CREATE TABLE campaign(
        `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(50) NOT NULL , `slogan` VARCHAR(50) NOT NULL , `type` VARCHAR(20) NOT NULL DEFAULT '0',`no` INT NOT NULL , `releasedate` DATE NOT NULL , `details` TEXT NOT NULL , `video` VARCHAR(100) NOT NULL , `ytb` TINYTEXT NOT NULL , `background` TINYTEXT NOT NULL , `sales` VARCHAR(100) NOT NULL , `hero` TINYTEXT NOT NULL , `setting` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id`)
    )";
    if (mysqli_query($connection, $sql5)) {
        // echo "Table 'campaign' created successfully.";
    } else {
        // echo "ERROR: Could not able to execute $sql5. " . mysqli_error($connection);
    }

    $sql6 = "CREATE TABLE resources(
        `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(30) NOT NULL , `midi` TINYTEXT NOT NULL , `instrumental` TINYTEXT NOT NULL , PRIMARY KEY (`id`)
    )";
    if (mysqli_query($connection, $sql6)) {
        // echo "Table 'resources' created successfully.";
    } else {
        // echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    }
    $sql7 = "CREATE TABLE menu(
        `option_name` VARCHAR(30) NOT NULL , `option_value` BOOLEAN NOT NULL DEFAULT TRUE , `id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`)
    )";
    if (mysqli_query($connection, $sql7)) {
        // echo "Table 'resources' created successfully.";
    } else {
        // echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    }
    $sql8 = "CREATE TABLE users(
        `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(30) NOT NULL , `email` VARCHAR(60) NOT NULL, `password` MEDIUMTEXT NOT NULL , `privilege` ENUM('owner','admin','editor') NOT NULL , PRIMARY KEY (`id`)
    )";
    if (mysqli_query($connection, $sql8)) {
        // echo "Table 'resources' created successfully.";
    } else {
        // echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    }
    echo '<p>Congrats! Your Database are all set!</p>';
    echo '<a href="index.php">back to main</a>';
} else {
    echo "get= " . $_GET['connect'];
    $myfile = fopen("defines.php", "w") or die("Unable to establish connection.");
    $txt = '<?php $sever = "' . $newHost . '";
    $database = "' . $newDb . '";
    $user = "' . $newUsername . '";
    $pass= "' . $newPassword . '";';
    fwrite($myfile, $txt);
    // $txt2 = "\r echo 'defines.php linked.';";
    // fwrite($myfile, $txt2);
    fclose($myfile);
}

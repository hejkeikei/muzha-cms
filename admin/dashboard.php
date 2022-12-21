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
    <div class="group">
        <h3>User</h3>
        <p id="user"><?php echo 'Admin'; ?></p>
    </div>
    <div class="group">
        <h3>Latest Post</h3>
        <p><?php
            $query = 'SELECT `title`,`content` FROM `posts` ORDER BY `id` DESC LIMIT 1';
            $sql = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($sql);
            echo '[' . $row['title'] . '] ' . $row['content'];
            ?></p>

    </div>
    <div class="group">
        <h3>Current Campaign</h3>
        <p><?php
            $query = "SELECT `id`, `title`, `setting` FROM `campaign` WHERE `setting`=1";
            $sql = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($sql);
            echo $row['title'];
            ?></p>
    </div>
    <div class="group">
        <h3>Latest Single</h3>
        <p><?php
            $query = 'SELECT `title`,`releasedate` FROM `singles` ORDER BY `id` DESC LIMIT 1';
            $sql = mysqli_query($connection, $query);
            $row = mysqli_fetch_array($sql);
            echo $row['title'];
            ?></p>
        <h4>Release Date</h4>
        <p><?php echo $row['releasedate']; ?></p>
    </div>
    <div class="group">
        <h3>Latest Album</h3>
        <p><?php
            $query = 'SELECT `title` FROM `album` ORDER BY `id` DESC LIMIT 1';
            $sql = mysqli_query($connection, $query);
            if ($row = mysqli_fetch_array($sql)) {
                echo $row['title'];
            } else {
                echo 'Add your first album';
            }

            ?></p>
    </div>
    <div class="group">
        <h3>Short Cut</h3>
        <div class="btn-group">
            <a href="index.php?dashboard=post&action=add" class="btn btn-md btn-theme">Add Post</a>
            <a href="index.php?dashboard=singles&action=add" class="btn btn-md btn-theme">Add New Singles</a>
        </div>
    </div>
<?php endif; ?>
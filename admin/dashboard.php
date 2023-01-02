<?php
// if (!$connection && $_SERVER['REQUEST_METHOD'] == 'POST') :
//     // die(mysqli_connect_error());  
//     include 'connect.php';
//     echo 'connect.php linked.';
// elseif (!$connection) :
?>
<!-- <h2>Connect to Database</h2>
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

    </form> -->
<?php //else : 
?>
<h2>Main dashboard</h2>
<div class="group" id="card_user">
    <h3>User</h3>
    <div class="row">
        <i class="fa-solid fa-circle-user" id="user_icon"></i>
        <p id="user"><?php echo $_COOKIE['username']; ?> <span> (<?php echo $_COOKIE['role']; ?>)</span></p>
    </div>
</div>
<div class="group" id="card_release">
    <div class="row">

        <div class="block">
            <h3>Singles</h3>
            <p class="stat">
                <?php
                $query = 'SELECT COUNT(`title`) FROM `singles`';
                $sql = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($sql);
                echo $row[0];
                ?>
            </p>
        </div>
        <div class="block">
            <h3>Albums</h3>
            <p class="stat">
                <?php
                $query = 'SELECT COUNT(`title`) FROM `albums`';
                $sql = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($sql);
                echo $row[0];
                ?>
            </p>
        </div>
    </div>
    <h3>Latest Single</h3>
    <?php
    $query = 'SELECT `title`,`releasedate` FROM `singles` ORDER BY `id` DESC LIMIT 3';
    $sql = mysqli_query($connection, $query);

    if ($sql && $row = mysqli_fetch_array($sql)) {
        while ($row = mysqli_fetch_array($sql)) {
            echo '<div class="col">';
            echo '<p>' . $row['title'] . '</p> <p class="date">release on ' . $row['releasedate'] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<div class="col">';
        echo 'Add your first single';
        echo '<a href="index.php?dashboard=singles&action=add" class="plus"><i class="fa-solid fa-circle-plus"></i></a>';
        echo '</div>';
    }

    ?>
    <h3>Latest Album</h3>
    <div class="col"><?php
                        $query = 'SELECT `title`,`releasedate` FROM `albums` ORDER BY `id` DESC LIMIT 1';
                        $sql = mysqli_query($connection, $query);
                        // print_r($sql);
                        if ($sql && $row = mysqli_fetch_array($sql)) {
                            echo '<p>' . $row['title'] . '</p> <p class="date">release on ' . $row['releasedate'] . '</p>';
                        } else {
                            echo 'Add your first album';
                            echo '<a href="index.php?dashboard=album&action=add" class="plus"><i class="fa-solid fa-circle-plus"></i></a>';
                        }

                        ?></div>
</div>
<div class="group" id="card_express">
    <h3>Short Cut</h3>
    <div class="btn-group">
        <a href="index.php?dashboard=post&action=add" class="btn btn-md btn-theme">Add Post</a>
        <a href="index.php?dashboard=singles&action=add" class="btn btn-md btn-theme">Add Singles</a>
    </div>
</div>

<div class="group" id="card_post">
    <h3>Latest Post</h3>
    <ul><?php
        $query = 'SELECT `post`,`postdate` FROM `posts` ORDER BY `id` DESC LIMIT 3';
        $sql = mysqli_query($connection, $query);

        if ($sql && $row = mysqli_fetch_array($sql)) {
            while ($row = mysqli_fetch_array($sql)) {
                echo '<li class="col">' . $row['postdate'] . ' <span class="title">' . $row['post'] . '</span></li>';
            }
        } else {
            echo '<li class="col">Add your first post';
            echo '<a href="index.php?dashboard=post&action=add" class="plus"><i class="fa-solid fa-circle-plus" ></i></a></li>';
        }

        ?></ul>

</div>
<div class="group" id="card_campaign">
    <h3>Current Campaign</h3>
    <p class="col"><?php

                    $query = "SELECT `id`, `title`, `setting` FROM `campaign` WHERE `setting`=1";
                    $sql = mysqli_query($connection, $query);
                    if ($sql && $row = mysqli_fetch_array($sql)) {
                        echo $row['title'];
                    } else {
                        echo 'Set campaign';
                        echo '<a href="index.php?dashboard=campaign&action=add" class="plus"><i class="fa-solid fa-circle-plus"></i></a>';
                    }

                    ?></p>
</div>



<?php //endif; 
?>
<h2>Posts</h2>
<div>
    <?php if (isset($_GET['action'])) : ?>
        <a href="index.php?dashboard=post" class="text-btn">
            << Go Back</a>
            <?php else : ?>
                <a href="index.php?dashboard=post&action=add" class="btn btn-theme btn-md">Add Post</a>
            <?php endif; ?>
</div>
<section>
    <!-- Add/Edit/Delete Post -->
    <?php

    // $_SERVER['REQUEST_METHOD'] == 'POST'

    if (isset($_GET['action'])) :
        if ($_GET['action'] == "add") {
            echo '<h3>Add a Post</h3>';
        } elseif ($_GET['action'] == "edit") {
            echo '<h3>Edit Post</h3>';
        } elseif ($_GET['action'] == "delete") {
            echo '<h3>Delte Post</h3>';
        }

        // if post: execute query, if not give form to entery
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 'POST execute query:';
            $title = mysqli_real_escape_string($connection, $_POST['title']);
            $date = date("Y/m/d");
            $content = mysqli_real_escape_string($connection, $_POST['content']);
            echo 'title=' . $title . ' date=' . $date . ' content=' . $content;
            if ($_GET['action'] == "add") {
                $query = "INSERT INTO `posts`( `post`, `postdate`, `content`) VALUES ('$title','$date','$content')";
                $sql = mysqli_query($connection, $query);
                echo '<small class="msg">Your post has been created!</small>';
                // echo '<a href="index.php?dashboard=post">Post List</a>';
            } elseif ($_GET['action'] == "edit") {
                $id = $_GET['id'];
                $query = "UPDATE `posts` SET `title`='$title',`content`='$content' WHERE `id`= '$id'";
                $sql = mysqli_query($connection, $query);
                echo '<small class="msg">Your post has been saved!</small>';
            }
            // elseif ($_GET['action'] == "delete") {
            //     $id = $_GET['id'];
            //     $sql = "DELETE FROM posts WHERE id='$id'";
            //     $sql = mysqli_query($connection, $query);
            //     echo '<small class="msg">The post has been deleted!</small>';
            // }
            echo '<a href="index.php?dashboard=post" class="btn btn-primary">Post List</a>';
        } elseif ($_GET['action'] == "delete") {
            $id = $_GET['id'];
            $query = "DELETE FROM posts WHERE id='$id'";
            $sql = mysqli_query($connection, $query);
            echo '<small class="msg">The post has been deleted!</small>';
            echo '<a href="index.php?dashboard=post" class="btn btn-primary">Post List</a>';
        } else {
            $prefill_title = '';
            $prefill_content = '';
            $id = '';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            if ($_GET['action'] == "edit") {
                $id = $_GET['id'];
                $query = "SELECT * FROM `posts` WHERE id = $id";
                $sql = mysqli_query($connection, $query);
                $row = mysqli_fetch_array($sql);
                $prefill_title = $row['title'];
                $prefill_content = $row['content'];
            }
            echo '<form action="index.php?dashboard=post&action=' . $_GET['action'] . '&id=' . $id . '" method="post">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="' . $prefill_title . '">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="60" rows="20">' . $prefill_content . '</textarea>
            <input type="submit" value="Submit" class="btn btn-outlined btn-md">
        </form>';
        }
    ?>

    <?php else : ?>
        <!-- Post List -->
        <table>
            <thead>
                <th>Date</th>
                <th>Title</th>
                <th>Edit/Delete</th>
            </thead>

            <?php
            $query = "SELECT `id`, `post`, `postdate` FROM `posts` ";
            $sql = mysqli_query($connection, $query);
            if ($sql) {
                while ($row = mysqli_fetch_array($sql)) {
                    echo '<tr id= "' . $row['id'] . '">';
                    echo '<td>' . $row['postdate'] . '</td>';
                    echo '<td>' . $row['post'] . '</td>';
                    echo '<td><a href="index.php?dashboard=post&action=edit&id=' . $row['id'] . '" class="btn btn-sm btn-outlined">Edit</a><a href="index.php?dashboard=post&action=delete&id=' . $row['id'] . '" class="btn btn-sm text-btn btn-danger">Delete</a></td>';
                    echo '</tr>';
                }
            }


            ?>
        </table>


    <?php endif; ?>
</section>
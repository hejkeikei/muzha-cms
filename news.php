<?php
include 'header.php';
if (!if_table_empty('posts')) {
    $newpost = get_max('posts');
} else {
    $newpost = 'none';
}
?>
<div class="container">
    <aside>
        <ul>
            <?php
            $query = "SELECT `id`, `post`, `postdate` FROM `posts` ORDER BY `postdate` DESC LIMIT 20";
            $sql = mysqli_query($connection, $query);
            if ($sql) {
                while ($row = mysqli_fetch_array($sql)) {
                    $id = $row['id'];
                    echo '<time datetime="' . $row['postdate'] . '">' . $row['postdate'] . '</time>';
                    echo '<li id="post_' . $id . '"><a href="' . $bodyclass . '?id=' . $id . '">' . $row['post'] . '</a></li>';
                }
            }
            ?>
        </ul>
    </aside>
    <article>

        <?php
        // $id =$_GET['id']
        if (isset($_GET['id'])) {
            get_post('post', 'h3');
            get_post('content', 'p');
        } else {
            get_post_by_id($newpost, 'post', 'h3');
            get_post_by_id($newpost, 'content', 'p');
        }
        ?>
    </article>
</div>
<?php include 'footer.php'; ?>
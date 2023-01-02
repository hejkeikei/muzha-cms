<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    // echo "called directly";
    include 'includes/header.php';
    $query = "SELECT `id`, `title`, `artist`, `releasedate`, `imagefilename` FROM `albums` WHERE `releasedate` < CURDATE() ORDER BY `releasedate` DESC LIMIT 20";
} else {
    // echo "included/required";
    $query = "SELECT `id`, `title`, `artist`, `releasedate`, `imagefilename` FROM `albums` WHERE `releasedate` < CURDATE() ORDER BY `releasedate` DESC LIMIT 3";
}
?>
<div class="wraper">
    <article class="container">
        <?php
        // $id =$_GET['id']
        if (isset($_GET['id'])) :
            echo '<div class="box box-album">';
            get_album('imagefilename', 'img');
            echo '</div>';
            echo '<div class="box">';
            get_album('title', 'h3');
            get_album('singles', 'li');
            get_album('details', 'p');
            echo '</div>';
        ?>
    </article>
<?php include 'includes/player.php';
        else : ?>

    <ul class="album-list">
        <?php

            $sql = mysqli_query($connection, $query);
            if ($sql) {
                while ($row = mysqli_fetch_array($sql)) {
                    $id = $row['id'];
                    echo '<a href="album?id=' . $id . '" class="box box-album" id =id="album_' . $id . '_container" >';
                    echo '<img src="' . $row['imagefilename'] . '" alt="' . $row['title'] . ' - album cover">';
                    echo '<time datetime="' . $row['releasedate'] . '">' . $row['releasedate'] . '</time>';
                    echo '<li id="album_' . $id . '">' . $row['title'] . '</li>';
                    echo '</a>';
                }
            }
        ?>
    </ul>


<?php endif; ?>

</div>

<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    // echo "called directly";
    include 'includes/footer.php';
} else {
    // echo "included/required";
}
?>
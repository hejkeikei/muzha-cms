<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    // echo "called directly";
    include 'header.php';
} else {
    // echo "included/required";
}
?>
<div class="wraper">

    <article class="container">

        <?php
        // $id =$_GET['id']
        if (isset($_GET['id'])) :
            echo '<div class="box">';
            get_single('imagefilename', 'img');
            echo '</div>';
            echo '<div class="box">';
            get_single('title', 'h3');
            get_single('details', 'p');
            echo '</div>';
        else :
        ?>
    </article>
    <aside>
        <ul class="single-list">
            <?php
            $query = "SELECT `id`, `title`, `feat`, `releasedate`, `imagefilename` FROM `singles` WHERE `releasedate` <= CURDATE() ORDER BY `releasedate` DESC LIMIT 20";
            $sql = mysqli_query($connection, $query);
            if ($sql) {
                while ($row = mysqli_fetch_array($sql)) {
                    $id = $row['id'];
                    $arr = explode(" ", $row['releasedate']);
                    $date = str_replace("-", ".", $arr[0]);
                    if ($row['feat'] != "") {
                        $heading = $row['title'] . " feat. " . $row['feat'];
                    } else {
                        $heading = $row['title'];
                    }


                    echo '<a href="single?id=' . $id . '" class="box box-single" id =id="single_' . $id . '_container" >';
                    echo '<img src="' . $row['imagefilename'] . '" alt="' . $heading . ' - single cover">';
                    echo '<time datetime="' . $row['releasedate'] . '">' . $date . '</time>';
                    echo '<li id="single_' . $id . '">' . $heading . '</li>';
                    echo '</a>';
                }
            }
            ?>
        </ul>

    </aside>
<?php endif; ?>

</div>

<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    // echo "called directly";
    include 'footer.php';
} else {
    // echo "included/required";
}
?>
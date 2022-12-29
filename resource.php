<?php
include 'header.php';
?>
<div class="container column">

    <article>
        <h3>License</h3>
        <summary>
            <?php
            $filepath = 'assets/LICENSE.txt';
            $license = fopen($filepath, "r") or die("Unable to open license.");
            echo fread($license, filesize($filepath));
            fclose($license);
            ?>
        </summary>
    </article>
    <table>
        <?php
        $query = "SELECT `id`, `title`, `midi`, `instrumental` FROM `resources` ORDER BY `id` DESC LIMIT 20";
        $sql = mysqli_query($conn, $query);
        if ($sql) {
            while ($row = mysqli_fetch_array($sql)) {
                $midifile = explode("/", $row['midi']);
                $instrumentalfile = explode("/", $row['instrumental']);
                echo '<tr id= "resource-' . $row['id'] . '">';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td><a href="assets/midi/' . $midifile[count($midifile) - 1] . '" download="' . $row['title'] . '-midi.mid" class="btn btn-sm btn-download btn-midi">Download</a></td>';
                echo '<td><a href="assets/instrumental/' . $instrumentalfile[count($instrumentalfile) - 1] . '" download="' . $row['title'] . '-instrumental.mp3" class="btn btn-sm btn-download btn-instrumental">Download</a></td>';
                echo '</tr>';
            }
        } else {
            die();
        }

        ?>
    </table>

</div>
<?php include 'footer.php'; ?>
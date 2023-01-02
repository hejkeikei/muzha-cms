<?php
include dirname(dirname(__FILE__)) . '/admin/defines.php';
$connection = mysqli_connect($sever, $user, $pass, $database);

function get_info($option)
{
    global $connection;
    $query = "SELECT `id`, `option_name`, `option_value` FROM `settings` WHERE `option_name`='$option'";
    $sql = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($sql);
    return $row['option_value'];
}

function get_socials()
{
    for ($i = 1; $i <= 3; $i++) {
        $link = get_info('sns' . $i);
        echo '<a href="' . $link . '">Click</a>';
    }
}
function get_post($parts, $tags)
{
    global $connection;
    $id = $_GET['id'];
    $query = "SELECT `id`, `post`, `postdate`, `content` FROM `posts` WHERE `id`=$id";
    $sql = mysqli_query($connection, $query);
    if ($sql) {
        $row = mysqli_fetch_array($sql);
        echo '<' . $tags . ' class="post-' . $parts . '">' . $row[$parts] . '</' . $tags . '>';
    }
}

function get_post_by_id($id, $parts, $tags)
{
    global $connection;
    $query = "SELECT `id`, `post`, `postdate`, `content` FROM `posts` WHERE `id`=$id";
    $sql = mysqli_query($connection, $query);
    if ($sql) {
        $row = mysqli_fetch_array($sql);
        echo '<' . $tags . ' class="post-' . $parts . '">' . $row[$parts] . '</' . $tags . '>';
    }
}

function get_single($parts, $tags)
{
    global $connection;
    $id = $_GET['id'];
    $query = "SELECT `id`, `title`, `artist`, `composer`, `lyrics`, `feat`, `releasedate`, `audiofilename`, `imagefilename`, `videofilename`, `details`, `genre` FROM `singles` WHERE `id`=$id";
    $sql = mysqli_query($connection, $query);
    if ($sql) {
        $row = mysqli_fetch_array($sql);
        if ($parts == 'imagefilename') {
            echo '<' . $tags . ' src="' . $row[$parts] . '" alt="' . $row['title'] . ' cover photo">';
        } elseif ($parts == 'videofilename') {
            echo '<' . $tags . ' width="640" height="480" controls>';
            echo '<source src="' . $row[$parts] . '" type="video/mp4">';
            echo '</' . $tags . '>';
        } else {
            echo '<' . $tags . ' class="single-' . $parts . '">' . $row[$parts] . '</' . $tags . '>';
        }
    }
}

function get_single_by_id($id, $parts, $tags)
{
    global $connection;
    $query = "SELECT `id`, `title`, `artist`, `composer`, `lyrics`, `feat`, `releasedate`, `audiofilename`, `imagefilename`, `videofilename`, `details`, `genre` FROM `singles` WHERE `id`=$id";
    $sql = mysqli_query($connection, $query);
    if ($sql) {
        $row = mysqli_fetch_array($sql);
        if ($parts == 'imagefilename') {
            echo '<' . $tags . ' src="' . $row[$parts] . '" alt="' . $row['title'] . ' cover photo">';
        } elseif ($parts == 'videofilename') {
            echo '<' . $tags . ' width="640" height="480" controls>';
            echo '<source src="' . $row[$parts] . '" type="video/mp4">';
            echo '</' . $tags . '>';
        } else {
            echo '<' . $tags . ' class="single-' . $parts . '">' . $row[$parts] . '</' . $tags . '>';
        }
    }
}
function get_album($parts, $tags)
{
    global $connection;
    $id = $_GET['id'];
    $query = "SELECT `id`, `title`, `singles`, `artist`, `releasedate`, `imagefilename`, `videofilename`, `details` FROM `albums` WHERE `id`=$id";
    $sql = mysqli_query($connection, $query);
    if ($sql) {
        $row = mysqli_fetch_array($sql);
        if ($parts == 'singles') {
            $list = explode(",", $row[$parts]);
            echo '<ul>';
            foreach ($list as $k => $id) {
                $tracksquery = "SELECT `id`, `title`, `artist`, `feat` FROM `singles` WHERE `id`=$id";
                $trackssql = mysqli_query($connection, $tracksquery);
                $track = $row = mysqli_fetch_array($trackssql);
                if ($track['feat'] != "") {
                    $heading = $track['title'] . " feat. " . $track['feat'];
                } else {
                    $heading = $track['title'];
                }
                echo '<li id="single-' . $id . '" data-track="' . $k . '">' . $heading . '</li>';
            }
            echo '</ul>';
        } elseif ($parts == 'imagefilename') {
            echo '<' . $tags . ' src="' . $row[$parts] . '" alt="' . $row['title'] . ' cover photo">';
        } elseif ($parts == 'videofilename') {
            echo '<' . $tags . ' width="640" height="480" controls>';
            echo '<source src="' . $row[$parts] . '" type="video/mp4">';
            echo '</' . $tags . '>';
        } else {
            echo '<' . $tags . ' class="single-' . $parts . '">' . $row[$parts] . '</' . $tags . '>';
        }
    }
}

function get_album_by_id($id, $parts, $tags)
{
    global $connection;
    $query = "SELECT `id`, `title`, `singles`, `artist`, `releasedate`, `imagefilename`, `videofilename`, `details` FROM `albums` WHERE `id`=$id";
    $sql = mysqli_query($connection, $query);
    if ($sql) {
        $row = mysqli_fetch_array($sql);
        if ($parts == 'singles') {
            $list = explode(",", $row[$parts]);
            echo '<ul>';
            foreach ($list as $k => $id) {
                $tracksquery = "SELECT `id`, `title`, `artist`, `feat` FROM `singles` WHERE `id`=$id";
                $trackssql = mysqli_query($connection, $tracksquery);
                $track = $row = mysqli_fetch_array($trackssql);
                if ($track['feat'] != "") {
                    $heading = $track['title'] . " feat. " . $track['feat'];
                } else {
                    $heading = $track['title'];
                }
                echo '<li id="single-' . $id . '" data-track="' . $k . '">' . $heading . '</li>';
            }
            echo '</ul>';
        } elseif ($parts == 'imagefilename') {
            echo '<' . $tags . ' src="' . $row[$parts] . '" alt="' . $row['title'] . ' cover photo">';
        } elseif ($parts == 'videofilename') {
            echo '<' . $tags . ' width="640" height="480" controls>';
            echo '<source src="' . $row[$parts] . '" type="video/mp4">';
            echo '</' . $tags . '>';
        } else {
            echo '<' . $tags . ' class="single-' . $parts . '">' . $row[$parts] . '</' . $tags . '>';
        }
    }
}
function if_table_empty($table_name)
{
    global $connection;
    $query = "SELECT COUNT(*) FROM `$table_name`";
    $sql = mysqli_query($connection, $query);
    $row = mysqli_fetch_row($sql);
    return $row[0] == 0;
}
function get_max($table_name)
{
    global $connection;
    $query = "SELECT max(id) FROM `$table_name`";
    $sql = mysqli_query($connection, $query);
    $row = mysqli_fetch_row($sql);
    return $row[0];
}

function ordinal($number)
{
    $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
    if ((($number % 100) >= 11) && (($number % 100) <= 13))
        return $number . 'th';
    else
        return $number . $ends[$number % 10];
}

// Youtube link convert
// https://youtu.be/4oMp57NFSmc to <iframe width="560" height="315" src="https://www.youtube.com/embed/4oMp57NFSmc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
function ytbEmbed($link)
{
    if (strpos($link, 'watch?v=') !== false) {
        $arr = explode('watch?v=', $link);
    } else {
        $arr = explode('/', $link);
    }
    $key = $arr[count($arr) - 1];
    $frame = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $key . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    echo $frame;
}

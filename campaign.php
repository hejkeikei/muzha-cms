<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    include 'header.php';
    $tags = "section";
    $query = "SELECT `id`, `title`, `slogan`, `type`, `no`, `releasedate`, `details`, `video`, `ytb`, `background`, `sales`, `hero`, `setting` FROM `campaign` ORDER BY `id` DESC LIMIT 5";
} else {
    $query = "SELECT `id`, `title`, `slogan`, `type`, `no`, `releasedate`, `details`, `video`, `ytb`, `background`, `sales`, `hero`, `setting` FROM `campaign` WHERE `setting`=1";
    $tags = "div";
}
$sql = mysqli_query($connection, $query);
if ($sql) {
    while ($row = mysqli_fetch_array($sql)) {
        $id = $row['id'];
        $heading = $row['title'];
        $slogan = $row['slogan'];
        $no = ordinal($row['no']) . " " . $row['type'];
        $date = $row['releasedate'];
        $details = $row['details'];
        $video = $row['video'];
        $background = $row['background'];
        $hero = $row['hero'];
        $sales = $row['sales'];
        $ytb = $row['ytb'];

        echo '<' . $tags . ' class="campaign-box box">';

        echo '<h2 id="campaign_' . $id . '_title" class="campaign-title">' . $heading . '</h2>';
        echo '<time datetime="' . $date . '" id="campaign_' . $id . '_date" class="campaign-date">' . $date . '</time>';
        echo '<small id="campaign_' . $id . '_releaseNumber" class="campaign-no">' . $no . '</small>';
        echo '<p id="campaign_' . $id . '_slogan" class="campaign-slogan">' . $slogan . '</p>';
        echo '<p id="campaign_' . $id . '_details" class="campaign-details">' . $details . '</p>';


        echo '<a href="' . $sales . '" id="campaign_' . $id . '_sales" target="_blank" class="campaign-sales btn btn-cta">BUY</a>';
        echo '<img src="' . $background . '" alt="' . $heading . ' - main visual" id="campaign_' . $id . '_background" class="campaign-background">';
        echo '<img src="' . $hero . '" alt="' . $heading . ' - hero image" id="campaign_' . $id . '_hero" class="campaign-hero">';

        // video
        if ($video != "") {
            echo '<video width="640" height="480" controls id="campaign_' . $id . '_video" class="campaign-video">';
            echo '<source src="' . $video . '" type="video/mp4">';
            echo '</video>';
        } else {
            // Youtube embed
            ytbEmbed($ytb);
        }


        echo '</' . $tags . '>';
    }
}
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    include 'footer.php';
}

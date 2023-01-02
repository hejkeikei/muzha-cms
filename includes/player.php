<?php
include 'fetch.php';
?>
<link rel="stylesheet" href="css/player.css">
<div id="player">
    <div class="display">
        <div class="cover" id="cover"><span class="cover-center"></span></div>
        <ul id="playlist">
            <?php
            if (isset($_GET['id'])) {
                get_album('singles', 'li');
            }
            ?>
        </ul>
    </div>
    <div id="controls">
        <button id="previous" class="btn-player"><i class="fa-solid fa-backward-step"></i></button>
        <button id="playBtn" class="btn-player"><i class="fa-solid fa-play"></i></button>
        <button id="pauseBtn" class="btn-player hidden"><i class="fa-solid fa-pause"></i></button>
        <button id="next" class="btn-player"><i class="fa-solid fa-forward-step"></i></button>
        <div id="progressBar"><span id="progress"></span></div>
        <figcaption id="timestamp"><span id="mins">00</span>:<span id="sec">00</span></figcaption>
    </div>
</div>
<script src="../js/player.js"></script>
<style>
    .cover {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: #eee;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }


    .spin {
        animation-name: spin;
        animation-play-state: running;
        animation-duration: 2s;
        animation-delay: .5s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;

    }

    .pause {
        animation-play-state: paused;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<div id="player">
    <div class="cover" id="cover"></div>
    <button id="playBtn">play</button>
    <button id="pauseBtn">pause</button>
    <button id="next">>></button>
</div>

<script>
    let tracklist = ["https://smokemuri.com/assets/singles/how-do-i-know.mp3", "https://smokemuri.com/assets/singles/firedance001.mp3", "https://smokemuri.com/assets/singles/say-hej.mp3"];
    let imglist = ["https://smokemuri.com/assets/images/how-do-i-know_single.jpg", "https://smokemuri.com/assets/images/fix-audio-path_single.jpg", "https://smokemuri.com/assets/images/marin-matte-black-mug.jpg"];
    let count = 0;

    var audio = new Audio(tracklist[count]);
    cover.style.backgroundImage = "url(" + imglist[count] + ")";

    function isPlaying(aud) {
        return !aud.paused;
    }

    function countTime(aud) {
        let du = aud.duration * 950;
        console.log(du);
        setTimeout(() => {
            cover.classList.add("pause");
        }, du)
    }

    next.addEventListener("click", () => {
        if ((count + 1) == tracklist.length) {
            count = 0
        } else {
            count++;
        }

        if (isPlaying(audio)) {
            countTime(audio);
            console.log("is playing");
            audio.pause();
            audio.currentTime = 0;
            audio.src = tracklist[count];
            audio.play();
            cover.classList.add("spin");
        } else {
            audio.pause();
            audio.currentTime = 0;
            audio.src = tracklist[count];
            cover.classList.remove("spin");
        }
        cover.style.backgroundImage = "url(" + imglist[count] + ")";
        // console.log(audio);
    })
    playBtn.addEventListener("click", () => {
        // if(isPlaying(aud)){

        // }else{
        //     cover.classList.add("spin");
        // }
        console.log(count);
        countTime(audio);
        audio.play();
        console.log(audio);
        cover.classList.remove("pause");
        cover.classList.add("spin");

    })
    pauseBtn.addEventListener("click", () => {
        console.log("click");
        console.log(audio.src);
        cover.classList.add("pause");
        audio.pause();

    })
</script>
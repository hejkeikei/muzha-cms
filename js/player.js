let tracklist = [];
let imglist = [];
fetch("assets/player.json")
    .then((response) => {
        if (!response.ok) { // Before parsing (i.e. decoding) the JSON data,
            // check for any errors.
            // In case of an error, throw.
            throw new Error("Something went wrong!");
        }

        return response.json(); // Parse the JSON data.
    })
    .then((data) => {
        // This is where you handle what to do with the response.
        console.log(data);
        data.forEach(obj => {
            tracklist.push(obj['track']);
            imglist.push(obj['img']);
        });
    })
    .catch((error) => {
        // This is where you handle errors.
        console.log("Fetch failed:", error);
    });
let count = 0;
var audio = new Audio(tracklist[count]);
setTimeout(() => {
    audio.src = tracklist[count];
    cover.style.backgroundImage = "url(" + imglist[count] + ")";
}, 1000)

function isPlaying(aud) {
    return !aud.paused;
}

function countTime(aud) {
    let du = aud.duration * 1000;
    console.log(du);
    setTimeout(() => {
        cover.classList.add("pause");
    }, du)
}

next.addEventListener("click", () => {
    console.log("next");
    if ((count + 1) == tracklist.length) {
        count = 0
    } else {
        count++;
    }

    if (isPlaying(audio)) {
        // countTime(audio);
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

})
previous.addEventListener("click", () => {
    console.log("previous");
    if ((count - 1) < 0) {
        count = tracklist.length - 1;
    } else {
        count--;
    }

    if (isPlaying(audio)) {

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
    console.log("play");
    audio.play();
    cover.classList.remove("pause");
    cover.classList.add("spin");
    playBtn.classList.add("hidden");
    pauseBtn.classList.remove("hidden");

})
pauseBtn.addEventListener("click", () => {
    console.log("pause");
    cover.classList.add("pause");
    audio.pause();
    pauseBtn.classList.add("hidden");
    playBtn.classList.remove("hidden");

})

audio.addEventListener('ended', function () {
    //play next song
    if ((count + 1) == tracklist.length) {
        count = 0
    } else {
        count++;
    }
    audio.pause();
    audio.src = tracklist[count];;
    audio.load();
    cover.style.backgroundImage = "url(" + imglist[count] + ")";
    audio.play();

});
const trackSelect = document.querySelectorAll('[data-track]');
trackSelect.forEach(elem => {
    elem.addEventListener("click", (e) => {
        let index = e.target.dataset.track;
        count = index;
        audio.pause();
        audio.src = tracklist[count];;
        audio.load();
        cover.style.backgroundImage = "url(" + imglist[count] + ")";
        audio.play();
        cover.classList.add("spin");
        cover.classList.remove("pause");
        playBtn.classList.add("hidden");
        pauseBtn.classList.remove("hidden");
    })
});
let curr = 0;
audio.addEventListener("timeupdate", () => {
    let time = Math.round(audio.currentTime);
    let du = audio.duration;
    let prog = Math.round(((time / du) + Number.EPSILON) * 100);
    progress.style.width = prog + "%";
    // set timestamp
    if (time < 10) {
        sec.innerHTML = "0" + time;
    } else if (time < 60) {
        sec.innerHTML = time;
    } else {
        let minutes = Math.floor(time / 60)
        mins.innerHTML = minutes;
        if (time - minutes * 60 < 10) {
            sec.innerHTML = "0" + (time - minutes * 60);
        } else {

            sec.innerHTML = time - minutes * 60;
        }
    }
});
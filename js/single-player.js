let url = "";
const audio = new Audio(url);
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
        url = data;
        audio.src = url;
    })
    .catch((error) => {
        // This is where you handle errors.
        console.log("Fetch failed:", error);
    });
let status = false;
playsingle.addEventListener("click", () => {
    if (status) {
        audio.pause();
        playsingle.innerHTML = '<i class="fa-solid fa-pause"></i>';
        status = false;
    } else {
        audio.play();
        playsingle.innerHTML = '<i class="fa-solid fa-play"></i>';
        status = true;
    }
})
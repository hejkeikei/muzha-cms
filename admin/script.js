const node = document.querySelector(".track");
var add = document.getElementById("add");
let count = 1;
if (add) {
    add.addEventListener("click", (e) => {
        e.preventDefault();
        count++;
        let clone = node.cloneNode(true);
        // console.log(clone.firstElementChild);
        clone.firstElementChild.textContent = "Track " + count;
        clone.lastElementChild.id = "track_" + count;
        console.log(clone.lastElementChild.id);
        tracklist.appendChild(clone);
    })
}
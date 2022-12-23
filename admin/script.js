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

const submitBtn = document.querySelector('input[type=submit]');
if (submitBtn) {
    submitBtn.addEventListener("click", (e) => {
        let loader = '<span class="loadwave"></span>';
        document.querySelector("#loading").innerHTML = loader;
    })
}

const confirmpass = document.querySelector('#confirmpass');
if (confirmpass) {
    confirmpass.addEventListener("change", () => {
        let pass = document.querySelector("input[type=password]");
        console.log("pass=", pass.value);
        console.log("confirm=", confirmpass.value);
        if (pass.value != confirmpass.value) {
            submitBtn.addEventListener("click", (e) => e.preventDefault());
            notice.classList.remove("hidden");
            confirmpass.style.borderColor = "var(--danger)";
        } else {
            notice.classList.add("hidden");
            confirmpass.style.borderColor = "var(--theme)";
        }
    })
}
const promote = document.getElementById('promote');
if (promote) {
    manul.addEventListener("click", (e) => {
        e.preventDefault();
        campaignSingle.classList.add("hidden");
        campaignManual.classList.remove("hidden");
    })
    choose.addEventListener("click", (e) => {
        e.preventDefault();
        campaignManual.classList.add("hidden");
        campaignSingle.classList.remove("hidden");
    })
}
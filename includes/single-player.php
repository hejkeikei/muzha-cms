<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/e2110d24a9.js" crossorigin="anonymous"></script>
    <style>
        main {
            display: flex;
            width: 80ch;
            margin: 2rem auto;
            gap: 1rem;
        }
    </style>
</head>

<body>
    <main>
        <div class="box">
            <img src="" alt="Picture">
            <div id="playsingle"></div>
        </div>
        <div class="box">
            <h3>Title</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non, blanditiis. Quam facere numquam sapiente aliquid cupiditate quae officia facilis dolor, sunt ratione harum natus, nulla eaque recusandae voluptatibus fugiat eveniet!</p>
        </div>
    </main>
</body>
<script>
    $url = "https://smokemuri.com/assets/singles/firedance001.mp3"
    const audio = new Audio($url);
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
</script>

</html>
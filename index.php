<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pokémon Server</title>
    <link rel="icon" href="resources/Pokeball1.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css?v=1.0" /> <!--Uso este atributo ?v=1.0 para indicar al navegador que refresque la cache-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body class="mainindex">
    <?php
    //Variables y funciones
    include "DBPokemon.php";
    include "functions.php";
    ?>

    <div class="containerIS">
        <div class="title">
            <img src="resources/Pokemon_animated.webp" alt="Titulo de Pokémon" />
        </div>
        <h1 class="subtitle">Server</h1>
    </div>
    <div class="divPVPandPVE">
        <a href="pvp.php" class="buttonPVPandPVE">PVP</a>
        <a href="pve.php" class="buttonPVPandPVE">PVE</a>
    </div>

    <!--Sonido con JavaScript-->
    <audio id="clickSound">
        <source src="resources/sound.mp3" type="audio/mpeg">
    </audio>

    <button id="music-button" class="music-button">🔇</button>
    <audio id="backgroundMusic" loop>
        <source src="resources/index.mp3" type="audio/mpeg">
    </audio>

    <script>
        //Botones
        const buttons = document.querySelectorAll(".buttonPVPandPVE");
        const musicButton = document.getElementById("music-button");
        //audio
        const clickSound = document.getElementById("clickSound");
        const backgroundMusic = document.getElementById("backgroundMusic");
        const isMusicPlaying = localStorage.getItem("musicPlaying") === "true";

        //Funciones
        function updateMusicIcon() {//Cambio de icono del boton
            musicButton.textContent = backgroundMusic.paused ? "🔇" : "🔊";
        }

        function toggleMusic() {
            backgroundMusic.currentTime = 0;
            if (backgroundMusic.paused) {//Un flipflop de la musica
                backgroundMusic.play();
                localStorage.setItem("musicPlaying", "true");
            } else {
                backgroundMusic.pause();
                localStorage.setItem("musicPlaying", "false");
            }
            updateMusicIcon();//Cambio de icono del boton
        }

        if (isMusicPlaying) {
            backgroundMusic.play();
        }
        updateMusicIcon();

        buttons.forEach(button => {//Al hacer click en cualquier boton
            button.addEventListener("click", (event) => {
                event.preventDefault();
                if (!backgroundMusic.paused) {
                    clickSound.play();
                }
                window.location.href = button.href;
            });
        });
        //Cada vez que hagan click en el boton de audio
        musicButton.addEventListener("click", toggleMusic);
    </script>
    <footer class="footerindex">© 2024 Pokémon Server. CyberCode Creations.</footer>
</body>

</html>
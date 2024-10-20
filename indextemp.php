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
    <div class="divPVPyPVE">
        <a href="pvp.php" class="buttonPVPyPVE">PVP</a>
        <a href="pve.php" class="buttonPVPyPVE">PVE</a>
    </div>
    <footer class="footerindex">© 2024 Pokémon Server. CyberCode Creations.</footer>
</body>

</html>
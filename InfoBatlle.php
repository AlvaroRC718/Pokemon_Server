<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batalla Pokémon</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="mainpvp">
    <?php
    //Variables y funciones
    include "DBPokemon.php";
    include "functions.php";
    ?>
    <div class="container">
        <div class="players-sections">
            <!-- Sección Jugador 1 -->
            <section class="player1">
                <h2><?php echo htmlspecialchars($_POST['player1_name']); ?> - Equipo Rojo</h2>
                <div class="icon">
                    <img src="resources/red.gif" alt="Entrenador Rojo" width="100px">
                </div>
                <h3>Equipo Pokémon</h3>
                <ul>
                    <?php
                    for ($i = 1; $i <= 6; $i++) {
                        $pokemon = htmlspecialchars($_POST["pokemon1_$i"]);
                        echo "<li>$pokemon</li>";
                    }
                    ?>
                </ul>
            </section>

            <!-- VS GIF -->
            <div class="icon">
                <img src="resources/vs.gif" alt="VS" />
            </div>

            <!-- Sección Jugador 2 -->
            <section class="player2">
                <h2><?php echo htmlspecialchars($_POST['player2_name']); ?> - Equipo Azul</h2>
                <div class="icon">
                    <img src="resources/blue.gif" alt="Entrenador Azul" width="100px">
                </div>
                <h3>Equipo Pokémon</h3>
                <ul>
                    <?php
                    for ($i = 1; $i <= 6; $i++) {
                        $pokemon = htmlspecialchars($_POST["pokemon2_$i"]);
                        echo "<li>$pokemon</li>";
                    }
                    ?>
                </ul>
            </section>
        </div>
    </div>

</body>

</html>
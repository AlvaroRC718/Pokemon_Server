<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pokémon Server - Dos Jugadores</title>
    <link rel="icon" href="resources/Pokeball1.png" type="image/x-icon"/>
    <link rel="stylesheet" href="style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
</head>

<body class="mainpvp">
    <?php
    //Variables y funciones
    include "DBPokemon.php";
    include "functions.php";
    ?>
    <div class="container">
        <form action="#" method="post">
            <div class="players-sections">
                <section>
                    <h2>Selecciona tu equipo Pokémon Jugador 1</h2>
                    
                    <label for="player1_name">Introduce tu nombre:</label>
                    <img src='resources/red.gif' alt='entrenador2' width='80px' height='80px'/>
                    <input type="text" name="player1_name" id="player1_name" required /><br />
                    <?php
                    for ($i = 1; $i < 7; $i++) {
                        echo "<img src='resources/pokeball2.png' alt='pokeball' width='20px' height='20px'/>";
                        echo "<label for='pokemon1_$i'> $i º Pokemon</label>
                    <select name='pokemon1_$i' id='pokemon1_$i'>";
                        print_select_pokemon($array_pokemon);
                        echo "</select><br/>";
                    }
                    ?>
                </section>

                <div class="icon">
                    <img src="resources/vs.gif" alt="VS" />
                </div>

                <section>
                    <h2>Selecciona tu equipo Pokémon Jugador 2</h2>
                    
                    <label for="player2_name">Introduce tu nombre:</label>
                    <img src='resources/blue.gif' alt='entrenador2' width='80px' height='80px'/>
                    <input type="text" name="player2_name" id="player2_name" required /><br />
                    <?php
                    for ($i = 1; $i < 7; $i++) {
                        echo "<img src='resources/pokeball2.png' alt='pokeball' width='20px' height='20px'/>";
                        echo "<label for='pokemon2_$i'> $i º Pokemon</label>
                    <select name='pokemon2_$i' id='pokemon2_$i'>";
                        print_select_pokemon($array_pokemon);
                        echo "</select><br/>";
                    }
                    ?>
                </section>
            </div>
            <button type="submit" class="submit-team">Listo</button>
        </form>
    </div>
</body>

</html>
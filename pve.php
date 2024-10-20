<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pokémon Server - Un Jugador</title>
    <link rel="icon" href="resources/Pokeball1.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css?v=1.0" /> <!--Uso este atributo ?v=1.0 para indicar al navegador que refresque la cache-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
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
                
            <div class="icon">
                    <img src='resources/red.png' alt='entrenador2' />
                </div>

                <section>
                    <h2>Selecciona tu equipo Pokémon Jugador 1</h2>

                    <label for="player1_name">Introduce tu nombre:</label>

                    <input type="text" name="player1_name" id="player1_name" class="select-input-team" required /><br />
                    <?php
                    for ($i = 1; $i < 7; $i++) {
                        echo "<img src='resources/pokeball2.png' alt='pokeball' width='20px' height='20px'/>";
                        echo "<label for='pokemon1_$i'> $i º Pokemon</label>
                        <select name='pokemon1_$i' id='pokemon1_$i' class='select-input-team'>";
                        print_select_pokemon($array_pokemon,"team-option"); //Funcion del archivo functions.php
                        echo "</select><br/>";
                    }
                    ?>
                </section>

                <div class="icon">
                <img src='resources/Primeape.png' alt='Primeape' />
                </div>
            </div>
            <button type="submit" class="submit-team">Listo</button>
        </form>
    </div>
</body>

</html>
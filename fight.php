<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pokémon Server - Combate</title>
    <link rel="icon" href="resources/Pokeball1.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css?v=1.0" /> <!--Uso este atributo ?v=1.0 para indicar al navegador que refresque la cache-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body class="mainfight">
    <?php if ($_SERVER["REQUEST_METHOD"] === "POST") : ?><!--Aqui solo se accede por el post. Si no es que te has colado-->
        <?php
        //Variables y funciones
        include "DBPokemon.php";
        include "functions.php";

        //Logica de juego
        $change_now = "";

        if (isset($_POST['teams']['your_team']) && isset($_POST['teams']['rival_team'])) { //La primera vez que entro
            for ($i = 0; $i < 6; $i++) {
                $your_team[$i] = $array_pokemon[$_POST['teams']['your_team'][$i]]; //Asigno al pokemon que les corresponda segun los valores que eligieron

                $rival_team[$i] = $array_pokemon[$_POST['teams']['rival_team'][$i]];
            }
        }

        $pokemon_selected = isset($_POST['pokemon_selected']) ? (int)$_POST['pokemon_selected'] : 0; //La primera vez siempre son el 0 si no es el que viene por formulario
        $pokemon_selected2 = isset($_POST['pokemon_selected2']) ? (int)$_POST['pokemon_selected2'] : 0;


        //Preguntar a jose  visto OK
        if (isset($_POST['your_team_json'])) {
            $your_team = json_decode($_POST['your_team_json'], true);
        }
        if (isset($_POST['rival_team_json'])) {
            $rival_team = json_decode($_POST['rival_team_json'], true);
        }

        $your_pokemon = $your_team[$pokemon_selected];
        $rival_pokemon = $rival_team[$pokemon_selected2];

        if (isset($_POST['fight'])) { /////////////////////////////////////////////////////////////////////////////////////////Boton de lucha
            if ($rival_pokemon['current_ps'] == 0) { //En caso de que el rival se ha debilitado paso al siguiente
                unset($rival_team[$pokemon_selected2]);
                $pokemon_selected2 += 1;
                $rival_pokemon = $rival_team[$pokemon_selected2];
            } elseif ($your_pokemon['current_ps'] == 0) { //En caso de que mi pokemon este muerto y le de ha luchar no lucha
                $change_now = "Debes cambiar de pokémon";
            } else { //Los dos estan vivos caso base
                //Evaluo velocidades
                if ($your_pokemon['speed'] == $rival_pokemon['speed']) {
                    $first = mt_rand(0, 1);
                } elseif ($your_pokemon['speed'] > $rival_pokemon['speed']) {
                    $first = 1;
                } else {
                    $first = 0;
                }

                if ($first) { //Tu primero
                    $rival_pokemon['current_ps'] -= attack($your_pokemon['attack'], $rival_pokemon['defense']); // Función del archivo functions.php
                    if ($rival_pokemon['current_ps'] > 0) { //Si el rival no ha muerto
                        $your_pokemon['current_ps'] -= attack($rival_pokemon['attack'], $your_pokemon['defense']);
                    }
                } else { //Rival primero
                    $your_pokemon['current_ps'] -= attack($rival_pokemon['attack'], $your_pokemon['defense']);
                    if ($your_pokemon['current_ps'] > 0) { //Si tu pokemon no ha muerto
                        $rival_pokemon['current_ps'] -= attack($your_pokemon['attack'], $rival_pokemon['defense']);
                    }
                }
            }
        }

        if (isset($_POST['change']) && isset($_POST['pokemon1'])) { ///////////////////////////////////////////////////////////Boton de cambio
            if ($your_pokemon['current_ps'] > 0) { //Evaluo si el cambio se debe a que te han debilitado
                $pokemon_selected = (int)$_POST['pokemon1']; //Cojo el valor de la posicion
                $your_pokemon = $your_team[$pokemon_selected];
                //Si decides cambiar recibes un golpe del otro. a no ser que tu pokemon este debilitado
                $your_pokemon['current_ps'] -= attack($rival_pokemon['attack'], $your_pokemon['defense']);
            } else { //Caso debilitado
                unset($your_team[$pokemon_selected]);
                $pokemon_selected = (int)$_POST['pokemon1']; //Cojo el valor de la posicion
                $your_pokemon = $your_team[$pokemon_selected];
            }
        }


        if ($your_pokemon['current_ps'] < 0) {
            $your_pokemon['current_ps'] = 0;
        }
        if ($rival_pokemon['current_ps'] < 0) {
            $rival_pokemon['current_ps'] = 0;
        }
        // Actualizo datos
        $your_team[$pokemon_selected] = $your_pokemon;
        $rival_team[$pokemon_selected2] = $rival_pokemon;

        //Pocentaje barra de vida
        $your_health_percentage = ($your_pokemon['current_ps'] / $your_pokemon['ps']) * 100;
        $rival_health_percentage = ($rival_pokemon['current_ps'] / $rival_pokemon['ps']) * 100;
        ?>

        <div class="body-battle">
            <div class="team1">
                <img src='resources/red.gif' alt='entrenador1' width='80px' height='80px' />
            </div>

            <div class="battlefield">
                <div class="pokemon2">

                    <div class="healthbar2">
                        <p><img src='resources/pokeball2.png' alt='pokeball' width='20px' height='20px' /> <?php echo $rival_pokemon['name']; ?> Nv5</p>
                        <div>
                            <div class="health-container">
                                <div class="hp-bar1" style=" <?php echo "width:" . $rival_health_percentage . "%;" . color_ps_bar($rival_health_percentage); ?>"></div>
                            </div>
                            <p><?php echo $rival_pokemon['current_ps'] . "/" . $rival_pokemon['ps']; ?></p>
                        </div>
                    </div>
                    <div class="pokemon2-img">
                        <?php echo "<img src='" . $rival_pokemon['img_front'] . "' alt='imagen pokemon' />"; ?>
                    </div>
                </div>

                <div class="pokemon1">
                    <div class="pokemon1-img">
                        <?php echo "<img src='" . $your_pokemon['img_back'] . "' alt='imagen pokemon' />"; ?>
                    </div>
                    <div class="healthbar1">
                        <p><img src='resources/pokeball2.png' alt='pokeball' width='20px' height='20px' /> <?php echo $your_pokemon['name']; ?> Nv5</p>
                        <div>
                            <div class="health-container">
                                <div class="hp-bar1" style=" <?php echo "width:" . $your_health_percentage . "%;" . color_ps_bar($your_health_percentage); ?>"></div>
                            </div>
                            <p><?php echo $your_pokemon['current_ps'] . "/" . $your_pokemon['ps']; ?></p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="team2">
                <img src='resources/blue.gif' alt='entrenador1' width='80px' height='80px' />
            </div>
        </div>

        <div class="battle-menu">
            <div class="battle-text">
                <?php
                if ($change_now) {
                    echo "<p>$change_now</p>";
                } elseif ($your_pokemon['current_ps'] <= 0) {
                    echo "<p>¡" . $your_pokemon['name'] . " se ha debilitado!</p>";
                } elseif ($rival_pokemon['current_ps'] <= 0) {
                    echo "<p>¡" . $rival_pokemon['name'] . " se ha debilitado!</p>";
                } else {
                    echo "<p>¿Qué hará " . $your_pokemon['name'] . "?</p>";
                }
                ?>

            </div>

            <form action="#" method="post" class="battle-options">
                <!-- Enviar equipos como json preguntar jose    Visto OK-->
                <input type="hidden" name="your_team_json" value='<?php echo json_encode($your_team); ?>' />
                <input type="hidden" name="rival_team_json" value='<?php echo json_encode($rival_team); ?>' />
                <input type="hidden" name="pokemon_selected" value="<?php echo $pokemon_selected; ?>" />
                <input type="hidden" name="pokemon_selected2" value="<?php echo $pokemon_selected2; ?>" />

                <div class="chart">
                    <button type="submit" name="fight" class="action-button">Luchar</button>
                </div>

                <div class="chart">
                    <p>Mochila</p>
                </div>

                <div class="chart">
                    <div class="chart2">

                        <div class="change-pokemon">
                            <input type="hidden" name="pokemon_selected" value="<?php echo $pokemon_selected; ?>" />

                            <?php
                            echo "<select name='pokemon1' id='pokemon1' class='select-fight'>";
                            print_select_team($your_team, $pokemon_selected);
                            echo "</select>";
                            ?>
                            <button type="submit" name="change" class="change-button">Cambiar Pokémon</button>
                        </div>
                    </div>
                </div>

                <div class="chart">
                    <a href="indextemp.php" class="run-button">Huir</a>
                </div>
            </form>

        </div>
    <?php else: ?>
        <div class="alert">
        <img src="resources/Snorlax.png" alt="pokemon" />
        <h2>¡Vaya, parece que hay un Snorlax en el camino!</h2>
        <p>No puedes pasar sin elegir a tu equipo Pokémon.</p>
    </div>
    <?php endif; ?>
</body>

</html>
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
    <?php
    //Variables y funciones
    include "DBPokemon.php";
    include "functions.php";
    $your_team = [
        [
            "name" => "Charmander",
            "ps" => "19",
            "current_ps" => "19",
            "attack" => "11",
            "defense" => "9",
            "speed" => "12",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/f/f5/latest/20140807015143/Charmander_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/b/b6/latest/20150321003402/Charmander_espalda_G6.gif",
            "img_pixel" => "https://images.wikidexcdn.net/mwuploads/wikidex/5/51/latest/20081201231548/Charmander_icon.gif"
        ],
        [
            "name" => "Squirtle",
            "ps" => "21",
            "current_ps" => "21",
            "attack" => "10",
            "defense" => "12",
            "speed" => "9",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/e/e0/latest/20140807020034/Squirtle_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/e/e9/latest/20150321172944/Squirtle_espalda_G6.gif",
            "img_pixel" => "https://images.wikidexcdn.net/mwuploads/wikidex/6/6a/latest/20081201231721/Squirtle_icon.gif"
        ],
        [
            "name" => "Gastly",
            "ps" => "30",
            "current_ps" => "30",
            "attack" => "10",
            "defense" => "10",
            "speed" => "10",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/3/31/latest/20140111115039/Gastly_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/2/22/latest/20150321172956/Gastly_espalda_G6.gif",
            "img_pixel" => ""
        ],
        [
            "name" => "Ponyta",
            "ps" => "23",
            "current_ps" => "23",
            "attack" => "15",
            "defense" => "10",
            "speed" => "16",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/1/1c/latest/20140111183928/Ponyta_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/e/e3/latest/20150321181411/Ponyta_espalda_G6.gif",
            "img_pixel" => "https://images.wikidexcdn.net/mwuploads/wikidex/1/1b/latest/20091207220413/Ponyta_icon.gif"
        ],
        [
            "name" => "Machop",
            "ps" => "25",
            "current_ps" => "25",
            "attack" => "15",
            "defense" => "10",
            "speed" => "10",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/0/02/latest/20140111171426/Machop_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/e/ed/latest/20150321175207/Machop_espalda_G6.gif",
            "img_pixel" => ""
        ],
        [
            "name" => "Charmander",
            "ps" => "19",
            "current_ps" => "19",
            "attack" => "11",
            "defense" => "9",
            "speed" => "12",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/f/f5/latest/20140807015143/Charmander_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/b/b6/latest/20150321003402/Charmander_espalda_G6.gif",
            "img_pixel" => "https://images.wikidexcdn.net/mwuploads/wikidex/5/51/latest/20081201231548/Charmander_icon.gif"
        ],
    ];
    $rival_team = [
        [
            "name" => "Squirtle",
            "ps" => "21",
            "current_ps" => "21",
            "attack" => "10",
            "defense" => "12",
            "speed" => "9",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/e/e0/latest/20140807020034/Squirtle_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/e/e9/latest/20150321172944/Squirtle_espalda_G6.gif",
            "img_pixel" => "https://images.wikidexcdn.net/mwuploads/wikidex/6/6a/latest/20081201231721/Squirtle_icon.gif"
        ],
        [
            "name" => "Charmander",
            "ps" => "19",
            "current_ps" => "19",
            "attack" => "11",
            "defense" => "9",
            "speed" => "12",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/f/f5/latest/20140807015143/Charmander_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/b/b6/latest/20150321003402/Charmander_espalda_G6.gif",
            "img_pixel" => "https://images.wikidexcdn.net/mwuploads/wikidex/5/51/latest/20081201231548/Charmander_icon.gif"
        ],
        [
            "name" => "Squirtle",
            "ps" => "21",
            "current_ps" => "21",
            "attack" => "10",
            "defense" => "12",
            "speed" => "9",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/e/e0/latest/20140807020034/Squirtle_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/e/e9/latest/20150321172944/Squirtle_espalda_G6.gif",
            "img_pixel" => "https://images.wikidexcdn.net/mwuploads/wikidex/6/6a/latest/20081201231721/Squirtle_icon.gif"
        ],
        [
            "name" => "Gastly",
            "ps" => "30",
            "current_ps" => "30",
            "attack" => "10",
            "defense" => "10",
            "speed" => "10",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/3/31/latest/20140111115039/Gastly_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/2/22/latest/20150321172956/Gastly_espalda_G6.gif",
            "img_pixel" => ""
        ],
        [
            "name" => "Ponyta",
            "ps" => "23",
            "current_ps" => "23",
            "attack" => "15",
            "defense" => "10",
            "speed" => "16",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/1/1c/latest/20140111183928/Ponyta_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/e/e3/latest/20150321181411/Ponyta_espalda_G6.gif",
            "img_pixel" => "https://images.wikidexcdn.net/mwuploads/wikidex/1/1b/latest/20091207220413/Ponyta_icon.gif"
        ],
        [
            "name" => "Machop",
            "ps" => "25",
            "current_ps" => "25",
            "attack" => "15",
            "defense" => "10",
            "speed" => "10",
            "img_front" => "https://images.wikidexcdn.net/mwuploads/wikidex/0/02/latest/20140111171426/Machop_XY.gif",
            "img_back" => "https://images.wikidexcdn.net/mwuploads/wikidex/e/ed/latest/20150321175207/Machop_espalda_G6.gif",
            "img_pixel" => ""
        ],
    ];

    $pokemon_selected = isset($_POST['pokemon_selected']) ? (int)$_POST['pokemon_selected'] : 0;
    $pokemon_selected2 = isset($_POST['pokemon_selected2']) ? (int)$_POST['pokemon_selected2'] : 0;
    $your_pokemon = $your_team[$pokemon_selected];
    $rival_pokemon = $rival_team[$pokemon_selected2];


    //Logica de juego
    $change_now = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        if (isset($_POST['your_team_json'])) {
            $your_team = json_decode($_POST['your_team_json'], true);
        }
        if (isset($_POST['rival_team_json'])) {
            $rival_team = json_decode($_POST['rival_team_json'], true);
        }
        $your_pokemon = $your_team[$pokemon_selected];
        $rival_pokemon = $rival_team[$pokemon_selected2];

        if (isset($_POST['fight'])) {
            if ($rival_pokemon['current_ps'] == 0) { //En caso de que el rival se ha debilitado paso al siguiente
                unset($rival_team[$pokemon_selected2]);
                $pokemon_selected2 += 1;
                $rival_pokemon = $rival_team[$pokemon_selected2];
            } elseif ($your_pokemon['current_ps'] == 0) { //En caso de que mi pokemon este muerto y le de ha luchar no lucha
                $change_now = "Debes cambiar de pokémon";
            } else { //Los dos estan vivos
                //Evaluo velocidades
                if ($your_pokemon['speed'] == $rival_pokemon['speed']) {
                    $first = mt_rand(0, 1);
                } elseif ($your_pokemon['speed'] > $rival_pokemon['speed']) {
                    $first = 1;
                } else {
                    $first = 0;
                }

                if ($first) { //Tu primero
                    $rival_pokemon['current_ps'] -= attack($your_pokemon['attack'], $rival_pokemon['defense']);
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
        
        //////////////////////////////////////////////////Revisar el ataque que recibe el pokemon al cambiar////////////////////////////////////////////////////////////
        if (isset($_POST['change']) && isset($_POST['pokemon1'])) {
            if ($your_pokemon['current_ps'] > 0) { //Evaluo si el cambio se debe a que te han debilitado
                //Si decides cambiar recibes un golpe del otro. a no ser que tu pokemon este debilitado
                $your_pokemon['current_ps'] -= attack($rival_pokemon['attack'], $your_pokemon['defense']);
            }else{
                unset($your_team[$pokemon_selected]);
            }
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

        <form action="#" method="post" class="battle-options" >
            <!-- Enviar equipos como JSON -->
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
                        print_select_team($your_team);
                        echo "</select>";
                        ?>
                        <button type="submit" name="change" class="change-button">Cambiar Pokémon</button>
                    </div>
                </div>
            </div>

            <div class="chart">
                <button class="run-button">Huir</button>
            </div>
        </form>

    </div>
</body>

</html>
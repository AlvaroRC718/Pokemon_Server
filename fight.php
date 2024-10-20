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
    ];

    $your_pokemon_name = $your_team[0]["name"];
    $your_pokemon_ps = $your_team[0]["ps"];
    $your_pokemon_current_ps = $your_team[0]["current_ps"];
    $your_pokemon_attack = $your_team[0]["attack"];
    $your_pokemon_defense = $your_team[0]["defense"];
    $your_pokemon_speed = $your_team[0]["speed"];
    $your_pokemon_img = $your_team[0]["img_back"];

    $rival_pokemon_name = $rival_team[0]["name"];
    $rival_pokemon_ps = $rival_team[0]["ps"];
    $rival_pokemon_current_ps = $rival_team[0]["current_ps"];
    $rival_pokemon_attack = $rival_team[0]["attack"];
    $rival_pokemon_defense = $rival_team[0]["defense"];
    $rival_pokemon_speed = $rival_team[0]["speed"];
    $rival_pokemon_img = $rival_team[0]["img_front"];

    //Logica de juego
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['fight'])) {

            //Evaluo velocidades
            if ($your_pokemon_speed == $rival_pokemon_speed) {
                $first = mt_rand(0, 1);
            } elseif ($your_pokemon_speed > $rival_pokemon_speed) {
                $first = 1;
            } else {
                $first = 0;
            }

            if ($first) {//Tu primero
                sleep(1);
                $rival_pokemon_current_ps -= attack($your_pokemon_attack, $rival_pokemon_defense);
                sleep(1);
                $your_pokemon_current_ps -= attack($rival_pokemon_attack, $your_pokemon_defense);
            }else{//Rival primero
                sleep(1);
                $your_pokemon_current_ps -= attack($rival_pokemon_attack, $your_pokemon_defense);
                sleep(1);
                $rival_pokemon_current_ps -= attack($your_pokemon_attack, $rival_pokemon_defense);
            }


        }
    }
    ?>
    <div class="body-battle">
        <div class="team1">
            <img src='resources/red.gif' alt='entrenador1' width='80px' height='80px' />
        </div>

        <div class="battlefield">
            <div class="pokemon2">

                <div class="healthbar2">
                    <p><img src='resources/pokeball2.png' alt='pokeball' width='20px' height='20px' /> <?php echo $rival_pokemon_name; ?> Nv5</p>
                    <div>
                        <div class="health-container">
                            <div class="hp-bar"></div>
                        </div>
                        <p><?php echo $rival_pokemon_current_ps . "/" . $rival_pokemon_ps; ?></p>
                    </div>
                </div>
                <div class="pokemon2-img">
                    <?php echo "<img src='$rival_pokemon_img' alt='imagen pokemon' />"; ?>
                </div>
            </div>


            <div class="pokemon1">
                <div class="pokemon1-img">
                    <?php echo "<img src='$your_pokemon_img' alt='imagen pokemon' />"; ?>
                </div>
                <div class="healthbar1">
                    <p><img src='resources/pokeball2.png' alt='pokeball' width='20px' height='20px' /> <?php echo $your_pokemon_name; ?> Nv5</p>
                    <div>
                        <div class="health-container">
                            <div class="hp-bar"></div>
                        </div>
                        <p><?php echo $your_pokemon_current_ps . "/" . $your_pokemon_ps; ?></p>
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
            <p>¿Qué hará <?php echo $your_pokemon_name; ?>?</p>
        </div>

        <div class="battle-options">

            <form action="" method="post" class="chart">
                <button type="submit" name="fight" class="action-button">Luchar</button>
            </form>

            <div class="chart">
                <p>Mochila</p>
            </div>

            <div class="chart">
                <div class="chart2">

                    <form action="#" method="post" class="change-pokemon">
                        <?php
                        echo "<select name='pokemon1' id='pokemon1' class='select-fight'>";
                        print_select_pokemon($your_team, "fight-option");
                        echo "</select>";
                        ?>
                        <button class="change-button">Cambiar Pokémon</button>
                    </form>
                </div>
            </div>
            <div class="chart">
                <button class="run-button">Huir</button>
            </div>
        </div>

    </div>
</body>

</html>
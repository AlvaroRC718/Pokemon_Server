<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batalla Pokémon</title>
    <link rel="stylesheet" href="style1.css?v=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body class="mainBattleInfo">
    <?php
    //Variables y funciones
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
    ?>

    <div class="player2Info">
        <div class="trainners2Info">

            <img src="resources/blue.gif" alt="Entrenador Rojo" width="100px">
            <p>Entrenador2</p>
        </div>
        <?php
        for ($i = 0; $i < 6; $i++) {
            echo "<div class='Pokemon2Info'>
                    <img src=" . $your_team[$i]['img_front'] . " alt='Entrenador Rojo'/>
                    <p>" . $your_team[$i]['name'] . "</p>
                </div>";
        }
        ?>
    </div>

    <div class="iconInfo">
        <a href="indextemp.php" class="return-buttonInfo">Volver</a>
        <img src="resources/vs.gif" alt="VS" />
        <form action="fight.php" method="post">
            <button type="submit" class="submit-teamInfo">Comenzar</button>
        </form>
    </div>

    <div class="player1Info">
        <div class="trainners1Info">
            <img src="resources/red.gif" alt="Entrenador Azul" width="100px">
            <p>Entrenador1</p>
        </div>
        <?php
        for ($i = 0; $i < 6; $i++) {
            echo "<div class='Pokemon1Info'>
                    <img src=" . $rival_team[$i]['img_front'] . " alt='Entrenador Rojo'/>
                    <p>" . $rival_team[$i]['name'] . "</p>
                </div>";
        }
        ?>
    </div>

</body>

</html>
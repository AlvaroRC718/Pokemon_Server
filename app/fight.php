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
        $message_log = "";

        if (isset($_POST['battle_state'])) { //Para controlar el inicio y el final
            $battle_state = true;
        } else { //Solo la primera vez porque no tengo una petion post de battle_state
            $battle_state = false;
            if (isset($_POST["player1_name"]) && isset($_POST["player2_name"])) {
                $message_log = "El entrenador " . htmlspecialchars($_POST["player1_name"], ENT_QUOTES, 'UTF-8') . " se enfrentará al entrenador " . htmlspecialchars($_POST["player2_name"], ENT_QUOTES, 'UTF-8') . ".";
            } else {
                $message_log = "El entrenador " . htmlspecialchars($_POST["player1_name"], ENT_QUOTES, 'UTF-8') . " se enfrentará al entrenador calvo Fran.";
            }
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Preparacion de equipos
        if (isset($_POST['teams']['your_team']) && isset($_POST['teams']['rival_team'])) { //La primera vez que entro
            for ($i = 0; $i < 6; $i++) {
                $your_team[$i] = $array_pokemon[$_POST['teams']['your_team'][$i]]; //Asigno al pokemon que les corresponda segun los valores que eligieron

                $rival_team[$i] = $array_pokemon[$_POST['teams']['rival_team'][$i]];
            }
        }

        //Preguntar a jose  visto OK
        if (isset($_POST['your_team_json'])) {
            $your_team = json_decode($_POST['your_team_json'], true);
        }
        if (isset($_POST['rival_team_json'])) {
            $rival_team = json_decode($_POST['rival_team_json'], true);
        }

        $pokemon_selected = isset($_POST['pokemon_selected']) ? (int)$_POST['pokemon_selected'] : 0; //La primera vez siempre son el 0 si no es el que viene por formulario
        $pokemon_selected2 = isset($_POST['pokemon_selected2']) ? (int)$_POST['pokemon_selected2'] : 0;

        $your_pokemon = $your_team[$pokemon_selected];
        $rival_pokemon = $rival_team[$pokemon_selected2];
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Boton de lucha
        if (isset($_POST['fight'])) {
            if ($your_pokemon['name'] == "Ditto") { //Caso ditto Cambio imagen y ataque
                $your_pokemon['img_back'] = $rival_pokemon['img_back'];
                $your_pokemon['attack'] = $rival_pokemon['attack'];
            }
            if ($rival_pokemon['name'] == "Ditto") { //Caso ditto 
                $rival_pokemon['img_front'] = $your_pokemon['img_front'];
                $rival_pokemon['attack'] = $your_pokemon['attack'];
            }


            if ($rival_pokemon['current_ps'] == 0) { //En caso de que el rival se ha debilitado paso al siguiente
                if (count($rival_team) == 1 && $battle_state) { //No le quedan pokemon
                    $battle_state = false;
                    if (isset($_POST["player2_name"])) { //Solo existe en pvp
                        $message_log = "El entrenador " . htmlspecialchars($_POST["player1_name"]) . " ganó al entrenador " .  htmlspecialchars($_POST["player2_name"]) . ".</br> Debes pulsar (Salir) para seleccionar un nuevo combate.";
                    } else {
                        $message_log = "El entrenador " .  htmlspecialchars($_POST["player1_name"]) . " ganó al entrenador calvo Fran.</br> Debes pulsar (Salir) para seleccionar un nuevo combate.";
                    }
                } else {
                    array_splice($rival_team, $pokemon_selected2, 1);
                    $rival_pokemon = $rival_team[$pokemon_selected2];
                }
            } elseif ($your_pokemon['current_ps'] == 0) { //En caso de que mi pokemon este muerto y le de ha luchar no lucha
                $message_log = "Debes cambiar de pokémon";
                if (count($your_team) == 1 && $battle_state) { //No te quedan pokemon
                    $battle_state = false;
                    if (isset($_POST["player2_name"])) { //Solo existe en pvp
                        $message_log = "El entrenador " .  htmlspecialchars($_POST["player2_name"]) . " ganó al entrenador " .  htmlspecialchars($_POST["player1_name"]) . ".</br> Debes pulsar (Salir) para seleccionar un nuevo combate.";
                    } else {
                        $message_log = "El entrenador calvo Fran ganó al entrenador " .  htmlspecialchars($_POST["player1_name"]) . ".</br> Debes pulsar (Salir) para seleccionar un nuevo combate.";
                    }
                }
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
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Boton de cambio
        if (isset($_POST['change']) && isset($_POST['index_pokemon_change'])) {
            if ($your_pokemon['current_ps'] > 0) { //Evaluo si el cambio se debe a que te han debilitado
                $pokemon_selected = (int)$_POST['index_pokemon_change']; //Cojo el valor de la posicion
                $your_pokemon = $your_team[$pokemon_selected];
                //Si decides cambiar recibes un golpe del otro. a no ser que tu pokemon este debilitado
                $your_pokemon['current_ps'] -= attack($rival_pokemon['attack'], $your_pokemon['defense']);
            } else { //Caso debilitado
                array_splice($your_team, $pokemon_selected, 1);
                if ($pokemon_selected < $_POST['index_pokemon_change']) { //Este parche casi me cuesta la vida xd
                    $pokemon_selected = (int)$_POST['index_pokemon_change'] - 1;
                } else {
                    $pokemon_selected = (int)$_POST['index_pokemon_change']; //Cojo el valor de la posicion
                }
                $your_pokemon = $your_team[$pokemon_selected];
            }
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////Ajustes finales
        if ($your_pokemon['current_ps'] < 0) {
            $your_pokemon['current_ps'] = 0;
        }
        if ($rival_pokemon['current_ps'] < 0) {
            $rival_pokemon['current_ps'] = 0;
        }
        // Actualizo datos para enviar el equipo por fomulario
        $your_team[$pokemon_selected] = $your_pokemon;
        $rival_team[$pokemon_selected2] = $rival_pokemon;
        $size_your_team = count($your_team);
        $size_rival_team = count($rival_team);

        //Pocentaje barra de vida para calcular el css
        $your_health_percentage = ($your_pokemon['current_ps'] / $your_pokemon['ps']) * 100;
        $rival_health_percentage = ($rival_pokemon['current_ps'] / $rival_pokemon['ps']) * 100;
        ?>

        <div class="body-battle">
            <div class="team1">
                <img src='resources/red.gif' alt='entrenador1'  width='80px' height='80px' />
                <?php
                for ($i = 0; $i < $size_your_team; $i++) {
                    echo "<div>
                        <img src='resources/pokeball2.png' alt='pokeball' width='40px' height='40px' />
                        <img src='" . $your_team[$i]['img_pixel'] . "' alt='pokemon'  width=80px' height='80px' />
                    </div>";
                }

                ?>
            </div>

            <div class="battlefield">

                <div class="pokemon2">

                    <div class="healthbar2">
                        <p><img src='resources/pokeball2.png' alt='pokeball' width='20px' height='20px' /> <?php echo $rival_pokemon['name']; ?> Nv5</p>
                        <div>
                            <div class="ps">
                                <p>PS</p>
                                <div class="health-container">
                                    <div class="hp-bar1" style=" <?php echo "width:" . $rival_health_percentage . "%;" . color_ps_bar($rival_health_percentage); ?>"></div><!--Función del archivo functions.php-->
                                </div>
                            </div>
                            <p><?php echo $rival_pokemon['current_ps'] . "/" . $rival_pokemon['ps']; ?></p>
                        </div>
                    </div>

                    <div class="pokemon2-img">
                        <?php
                        if ($battle_state) {
                            echo "<img src='" . $rival_pokemon['img_front'] . "' alt='imagen pokemon' />";
                        } elseif (isset($_POST["player2_name"])) { //Este isset solo existe en pvp
                            echo "<img src='resources/blue.png' alt='imagen entrenador' />";
                        } else {
                            echo "<img src='resources/calvo.png' alt='imagen entrenador' />";
                        }
                        ?>

                    </div>

                </div>

                <div class="pokemon1">

                    <div class="pokemon1-img">
                        <?php
                        if ($battle_state) {
                            echo "<img src='" . $your_pokemon['img_back'] . "' alt='imagen pokemon' />";
                        } else {
                            echo "<img src='resources/red.webp' alt='imagen entrenador' />";
                        }
                        ?>
                    </div>

                    <div class="healthbar1">
                        <p><img src='resources/pokeball2.png' alt='pokeball' width='20px' height='20px' /> <?php echo $your_pokemon['name']; ?> Nv5</p>
                        <div>
                            <div class="ps">
                                <p>PS</p>
                                <div class="health-container">
                                    <div class="hp-bar1" style=" <?php echo "width:" . $your_health_percentage . "%;" . color_ps_bar($your_health_percentage); ?>"></div>
                                </div>
                            </div>
                            <p><?php echo $your_pokemon['current_ps'] . "/" . $your_pokemon['ps']; ?></p>
                        </div>
                    </div>

                </div>

            </div>

            <div class="team2">
                <?php
                if (isset($_POST["player2_name"])) {
                    echo "<img src='resources/blue.gif' alt='entrenador1' width='80px' height='80px' />";
                } else {
                    echo "<img src='resources/calvo.gif' alt='entrenador1' width='80px' height='80px' />";
                }


                for ($i = 0; $i < $size_rival_team; $i++) {
                    echo "<div>
                        <img src='" . $rival_team[$i]['img_pixel'] . "' alt='pokemon' width=80px' height='80px' />
                        <img src='resources/pokeball2.png' alt='pokeball' width='40px' height='40px' />
                    </div>";
                }

                ?>
            </div>
        </div>

        <div class="battle-menu">
            <div class="battle-log">
                <div class="battle-text">
                    <?php
                    if ($message_log) {
                        echo "<p>$message_log</p>";
                    } elseif ($your_pokemon['current_ps'] <= 0) {
                        echo "<p>¡" . $your_pokemon['name'] . " se ha debilitado!</p>";
                    } elseif ($rival_pokemon['current_ps'] <= 0) {
                        echo "<p>¡" . $rival_pokemon['name'] . " se ha debilitado!</p>";
                    } else {
                        echo "<p>¿Qué hará " . $your_pokemon['name'] . "?</p>";
                    }
                    ?>
                </div>
            </div>

            <form action="#" method="post" class="battle-options">
                <!-- Enviar equipos como json preguntar jose    Visto OK-->
                <input type="hidden" name="your_team_json" value='<?php echo json_encode($your_team); ?>' />
                <input type="hidden" name="rival_team_json" value='<?php echo json_encode($rival_team); ?>' />
                <input type="hidden" name="pokemon_selected" value="<?php echo $pokemon_selected; ?>" />
                <input type="hidden" name="pokemon_selected2" value="<?php echo $pokemon_selected2; ?>" />
                <input type="hidden" name="battle_state" value="<?php echo $battle_state; ?>" />
                <input type="hidden" name="player1_name" value="<?php echo $_POST["player1_name"]; ?>" />
                <?php
                if (isset($_POST["player2_name"])) {
                    echo "<input type='hidden' name='player2_name' value=" . $_POST["player2_name"] . " />";
                }
                ?>
                <div class="chart">
                    <button type="submit" name="fight" class="action-button">Luchar</button>
                </div>

                <div class="chart">
                    <a class="music-toggle">🔇</a>
                </div>

                <div class="chart">
                    <div class="chart2">
                        <div class="change-pokemon">
                            <input type="hidden" name="pokemon_selected" value="<?php echo $pokemon_selected; ?>" />

                            <?php
                            echo "<select name='index_pokemon_change' id='index_pokemon_change' class='select-fight'>";
                            print_select_team($your_team, $pokemon_selected); //Función del archivo functions.php
                            echo "</select>";
                            if ($battle_state && $size_your_team > 1) {
                                echo "<button type='submit' name='change' class='change-button'>Cambiar Pokémon</button>";
                            } else {
                                echo "<button name='change' class='change-button' disabled>Cambiar Pokémon</button>";
                            }
                            ?>


                        </div>
                    </div>
                </div>

                <div class="chart">
                    <a href="index.php" class="run-button"><?php echo $battle_state ? "Huir" : "Salir"; ?></a>
                </div>
            </form>

        </div>

        <!--Sonido con JavaScript-->
        <audio id="clickSound">
            <source src='resources/sound.mp3' type='audio/mpeg'>
        </audio>

        <audio id="changeSound">
            <source src='resources/change.mp3' type='audio/mpeg'>
        </audio>

        <audio id="runSound">
            <source src='resources/run.mp3' type='audio/mpeg' />
        </audio>

        <audio id="backgroundMusic" loop>
            <?php if (($your_pokemon['current_ps'] == 0 || $rival_pokemon['current_ps'] == 0) && !$battle_state): //Cambio a music de victoria
            ?>
                <source src='resources/victory.mp3' type='audio/mpeg'>
            <?php else: ?>
                <source src='resources/battle.mp3' type='audio/mpeg'>
            <?php endif; ?>
        </audio>


        <script>
            //Botones
            const submitButton = document.querySelector(".action-button");
            const changeButton = document.querySelector(".change-button");
            const returnButton = document.querySelector(".run-button");
            const musicButton = document.querySelector(".music-toggle");
            //Sonidos
            const clickSound = document.getElementById("clickSound");
            const changeSound = document.getElementById("changeSound");
            const runSound = document.getElementById("runSound");
            const backgroundMusic = document.getElementById("backgroundMusic");
            const isMusicPlaying = localStorage.getItem("musicPlaying") === "true";
            const savedTime = parseFloat(localStorage.getItem("musicTime")) || 0; //Tiempo inicial

            //Funciones
            function updateMusicIcon() { //Cambio de icono del boton
                musicButton.textContent = backgroundMusic.paused ? "🔇" : "🔊";
            }

            function toggleMusic() {
                if (backgroundMusic.paused) { //flipflop musica
                    backgroundMusic.play();
                    localStorage.setItem("musicPlaying", "true");
                } else {
                    backgroundMusic.pause();
                    localStorage.setItem("musicPlaying", "false");
                }
                updateMusicIcon();
            }
            // Si cargo y esta la musica activada
            if (isMusicPlaying) {
                //Continuo la cancion en el segundo que me quede el 0.25 es un filtro que me he inventado para que se note menos el corte
                backgroundMusic.currentTime = savedTime + 0.25;
                backgroundMusic.play();
            }
            updateMusicIcon();

            // Guardo el tiempo de reproduccion cada segundo
            backgroundMusic.addEventListener("timeupdate", () => {
                localStorage.setItem("musicTime", backgroundMusic.currentTime);
            });

            //Al hacer click reproduce el sonido boton atacar
            submitButton.addEventListener("click", () => {
                if (!backgroundMusic.paused) { //Si tengo musica
                    clickSound.play();
                }
                submit();
            });

            //Al hacer click reproduce el sonido boton cambiar
            changeButton.addEventListener("click", () => {
                if (!backgroundMusic.paused) { //Si tengo musica
                    changeSound.play();
                    changeSound.onended = () => { //Espero a que termine
                        submit();
                    };
                }
                submit();
            });

            //Al hacer click reproduce el sonido boton huir
            returnButton.addEventListener("click", (event) => {
                event.preventDefault(); // Evita el redireccionamiento inmediato
                if (!backgroundMusic.paused) { //Si tengo musica
                    if (returnButton.textContent === "Salir") {
                        clickSound.play();
                        clickSound.onended = () => {
                            window.location.href = returnButton.href;
                        };
                    } else {
                        runSound.play();
                        runSound.onended = () => {
                            window.location.href = returnButton.href;
                        };
                    }
                } else {
                    window.location.href = returnButton.href;
                }
            });

            musicButton.addEventListener("click", toggleMusic);
        </script>

    <?php else: ?>
        <div class="alert">
            <img src="resources/Snorlax.png" alt="pokemon" />
            <h2>¡Vaya, parece que hay un Snorlax en el camino!</h2>
            <p>No puedes pasar sin elegir a tu equipo Pokémon.</p>
        </div>
    <?php endif; ?>

</body>

</html>
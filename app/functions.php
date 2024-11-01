<?php
include "DBpokemon.php";


//Genera los option de un select segun el array que le des y le aplica un estilo a este
function print_select_pokemon($array_pokemon, $trainer)
{
    $array_pokemon_size = count($array_pokemon);
    $pokemon_random = mt_rand(1, $array_pokemon_size - 1); //pongo pokemon aleatorios, el 0 lo oculto porque es un easter egg

    foreach ($array_pokemon as $index => $pokemon) {
        if ($index == $pokemon_random) { //selecciono un pordefecto aleatorio
            echo "<option value='$index' name='$trainer' class='team-option' selected>" . $pokemon['name'] . "</option>";
        } else {
            echo "<option value='$index' name='$trainer' class='team-option'>" . $pokemon['name'] . "</option>";
        }
    }
}

//Evalua si un ataque va a ser critico
function critical()
{
    $critical = mt_rand(1, 100);
    if ($critical <= 10) {
        return true;
    } else {
        return false;
    }
}

//Devuelve los ps que quita
function attack($attack, $defense)
{
    $ps = 1;
    if (critical()) {
        $ps = (int)(($attack - $defense) * 0.5);
    } else {
        $ps = (int)($attack - $defense);
    }

    if ($ps <= 0) {
        $ps = 1;
    }

    return $ps;
}

//Dependiendo del porcentaje de salud devuelvo un color 
function color_ps_bar($ps)
{
    $color = "";
    if ($ps >= 75) { //Verde
        $color = "background: linear-gradient(to left, rgb(0, 255, 0), rgb(2, 163, 2));";
    } elseif ($ps >= 50) { //Amarillo
        $color = "background: linear-gradient(to left, rgb(255, 251, 0), rgb(173, 171, 7));";
    } elseif ($ps >= 25) { //Naranja
        $color = "background: linear-gradient(to left, rgb(255, 145, 0), rgb(196, 113, 5));";
    } else {
        $color = "background: linear-gradient(to left, rgb(255, 38, 0), rgb(155, 27, 4));";
    }
    return $color;
}

//Print de los option de tu equipo de valor mando el indice
function print_select_team($team, $pokemon_selected)
{
    foreach ($team as $index => $pokemon) {
        if ($index != $pokemon_selected) {
            echo "<option value='$index' class='fight-option'>" . $pokemon['name'] . "</option>";
        }
    }
}

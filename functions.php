<?php
include "DBpokemon.php";

//Genera los option de un select segun el array que le des y le aplica un estilo a este
function print_select_pokemon($array_pokemon)
{
    $array_pokemon_size = count($array_pokemon);
    $pokemon_random = mt_rand(1, $array_pokemon_size - 1); //pongo pokemon aleatorios, el 0 lo oculto porque es un easter egg

    for ($i = 0; $i < $array_pokemon_size; $i++) {
        if ($i == $pokemon_random) { //selecciono un pordefecto aleatorio
            echo "<option value='" . $array_pokemon[$i]["name"] . "' name='select_pokemon' id='" . $array_pokemon[$i]["name"] . "' class='team-option' selected>" . $array_pokemon[$i]["name"] . "</option>";
        }else{
            echo "<option value='" . $array_pokemon[$i]["name"] . "' name='select_pokemon' id='" . $array_pokemon[$i]["name"] . "' class='team-option'>" . $array_pokemon[$i]["name"] . "</option>";
        }
    }
}

//Evalua si un ataque va a ser critico
function critical(){
    $critical = mt_rand(1, 100);
    if ($critical <= 10) {
        return true ;
    }else{
        return false;
    }
}

//Devuelve los ps que quita
function attack($attack, $defense){
    $ps = 1;
    if (critical()) {
        $ps = ($attack - $defense) * 0.5;
    }else{
        $ps = ($attack - $defense);
    }

    if ($ps <= 0) {
        $ps = 1;
    }

    return (int)$ps;
}

//Dependiendo del porcentaje de salud devuelvo un color 
function color_ps_bar($ps){
    $color = "";
    if ($ps >= 75) {//Verde
        $color = "background: linear-gradient(to left, rgb(0, 255, 0), rgb(2, 163, 2));";
    }elseif($ps >= 50){//Amarillo
        $color = "background: linear-gradient(to left, rgb(255, 251, 0), rgb(173, 171, 7));";
    }elseif($ps >= 25){//Naranja
        $color = "background: linear-gradient(to left, rgb(255, 145, 0), rgb(196, 113, 5));";
    }else {
        $color = "background: linear-gradient(to left, rgb(255, 38, 0), rgb(155, 27, 4));";
    }
    return $color;
}

function print_select_team($team) {
    foreach ($team as $index => $pokemon) {
        echo "<option value='$index' class='fight-option'>".$pokemon['name']."</option>";
    }
}
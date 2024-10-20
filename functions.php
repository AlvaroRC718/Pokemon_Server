<?php
include "DBpokemon.php";

//Genera los option de un select segun el array que le des y le aplica un estilo a este
function print_select_pokemon($array_pokemon , $class_option)
{
    $array_pokemon_size = count($array_pokemon);
    $pokemon_random = mt_rand(1, $array_pokemon_size - 1); //pongo pokemon aleatorios, el 0 lo oculto porque es un easter egg

    for ($i = 0; $i < $array_pokemon_size; $i++) {
        if ($i == $pokemon_random) { //selecciono un pordefecto aleatorio
            echo "<option value='" . $array_pokemon[$i]["name"] . "' name='select_pokemon' id='" . $array_pokemon[$i]["name"] . "' class='".$class_option."' selected>" . $array_pokemon[$i]["name"] . "</option>";
        }else{
            echo "<option value='" . $array_pokemon[$i]["name"] . "' name='select_pokemon' id='" . $array_pokemon[$i]["name"] . "' class='".$class_option."'>" . $array_pokemon[$i]["name"] . "</option>";
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

    return $ps;
}



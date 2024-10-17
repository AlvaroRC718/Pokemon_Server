<?php
include "DBpokemon.php";
function print_select_pokemon($array_pokemon)
{
    global $array_pokemon_size;
    $pokemon_random = mt_rand(1, $array_pokemon_size - 1); //pongo pokemon aleatorios, el 0 lo oculto porque es un easter egg

    for ($i = 0; $i < $array_pokemon_size; $i++) {
        if ($i == $pokemon_random) { //selecciono un pordefecto aleatorio
            echo "<option value='" . $array_pokemon[$i]["name"] . "' name='select_pokemon' id='" . $array_pokemon[$i]["name"] . "' selected>" . $array_pokemon[$i]["name"] . "</option>";
        }else{
            echo "<option value='" . $array_pokemon[$i]["name"] . "' name='select_pokemon' id='" . $array_pokemon[$i]["name"] . "'>" . $array_pokemon[$i]["name"] . "</option>";
        }
    }
}

<?php
function print_select_pokemon($array_pokemon)
{
    $array_pokemon_size = count($array_pokemon);

    for ($i = 0; $i < $array_pokemon_size; $i++) {
        echo "<option value='" . $array_pokemon[$i][1] . "' name='select_pokemon' id='" . $array_pokemon[$i][1] . "'>" . $array_pokemon[$i][1] . "</option>";
    }
}

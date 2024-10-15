<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
</head>

<body>
    <?php //Variables y funciones
    include "DBPokemon.php";
    include "functions.php"
    ?>

    <h2>Selecciona tu equipo Pokemon</h2>
    <form action="#" method="post">
        <label for="pokemon1">1º Pokemon</label>
        <select name="select_pokemon" id="select_pokemon">
            <?php
                for ($i=0; $i < 5; $i++) { 
                    print_select_pokemon($array_pokemon);
                }
                
            ?>
        </select>
    </form>

</body>

</html>
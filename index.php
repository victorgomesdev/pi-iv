<?php


spl_autoload_register(function ($controller) {
    $class = __DIR__ . "/controllers/$controller.php";

    include $class;
});


Estoque::cadastar_categoria('anestésicos');
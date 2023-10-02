<?php

namespace Models;

use PDO;

class Conexao
{

    public static function conectar(){

        return new PDO('','','');
    }
}

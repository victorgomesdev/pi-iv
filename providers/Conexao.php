<?php

namespace Providers;

use PDO;
class Conexao
{

    public static function conectar(){

        return new PDO('mysql:host=localhost;dbname=smille','root','');
    }
}

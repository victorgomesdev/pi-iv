<?php

use Controllers\Estoque;
use Models\Produto;
use Providers\Resposta;

include 'autoload.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_POST['opt'])) {
            switch($_POST['opt']){
                case 'sum':
                    Produto::adicionar($_POST['codigo']);
                    Resposta::enviar(200, ['status'=> true]);
                case 'sub':
                    Produto::baixar($_POST['codigo']);
                    Resposta::enviar(200, ['status'=> true]);
            }
        }
        break;

    case 'GET':

        if(isset($_GET['edit'])){
            echo $_GET['edit'];
            exit;
        }
        
        $lista = Estoque::buscar();
        Resposta::enviar(200, $lista);
        break;
}

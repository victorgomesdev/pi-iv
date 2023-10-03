<?php

use Models\Item;
use Models\Resposta;
use Models\Transacao;

class CadastrarProduto{

    public static function cadastrar(int $id, string $descricao, int $categoria, int $tipo, int $usuario, int $clinica){

        $cadastro = new Transacao(1, $tipo, date('dd-mm-YY'), $usuario, $clinica);
        $item = new Item($id, $descricao, $categoria, 1);

        if($cadastro->registar()){
            $item->cadastrar_item()? Resposta::enviar(200,[]): Resposta::enviar(400,[]);
        }else{
            
        }
    }
}
?>
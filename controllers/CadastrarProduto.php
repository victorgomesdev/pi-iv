<?php

use Models\Item;
use Models\Resposta;

class CadastrarProduto{

    public static function cadastrar(string $descricao){

        $item = new Item(1, $descricao, 1);

        if($item->cadastrar_item()){
            Resposta::enviar(200, ['Produto cadastrado!']);
        }else{
            
        }
    }
}
?>
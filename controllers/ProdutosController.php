<?php

include 'models/Resposta.php';
include 'models/Produto.php';
class ProdutosController
{

    public static function cadastrar(string $nome,  int $id_categoria,  int $codigo)
    {

        $novo_produto = new Produto($nome, $id_categoria, $codigo);
        $t = $novo_produto->cadastrar_item();

        if($t === true){
            Resposta::enviar(200, ['message'=> '<p>Produto cadastrado.</p>']);
        }else{
            Resposta::enviar(200, ['message'=> "<p>Código inválido</p>"]);
        }
    }

    public static function excluir(int $codigo){

        if(($res = Produto::excluir_item($codigo)) === true){
            Resposta::enviar(200, ['message'=> '<p>Produto excluído.</p>']);
        }else{
            Resposta::enviar(200, ['message'=> $res]);
        }
    }
}

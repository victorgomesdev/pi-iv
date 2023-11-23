<?php

namespace Controllers;
use Models\Produto;
use Providers\Resposta;

class Estoque
{

    public static function cadastrar(string $nome,  int $id_categoria,  int $codigo)
    {

        $novo_produto = new Produto($nome, $id_categoria, $codigo);
        $t = $novo_produto->cadastrar_item();

        if ($t === true) {
            Resposta::enviar(200, ['message' => '<p>Produto cadastrado.</p>']);
        } else {
            Resposta::enviar(200, ['message' => "<p>Código inválido</p>"]);
        }
    }

    public static function excluir(int $codigo)
    {

        if (($res = Produto::excluir_item($codigo)) === true) {
            Resposta::enviar(200, ['message' => '<p>Produto excluído.</p>']);
        } else {
            Resposta::enviar(200, ['message' => $res]);
        }
    }

    public static function buscar(int $codigo = null):array
    {

        $lista = Produto::buscar_produto($codigo);

        if (count($lista) == 0) {
            return [];
        } else {
            return $lista;
        }
    }

    public static function editar(string $nome, int $categoria, int $codigo)
    {

        if (Produto::editar_item($nome, $categoria, $codigo) === true) {
            Resposta::enviar(200, ['message' => '<p>Alterações salvas com sucesso.</p>']);
        } else {
            Resposta::enviar(200, ['oi']);
        }
    }

}

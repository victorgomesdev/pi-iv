<?php

namespace Controllers;

use Providers\Resposta;
use Models\Produto;
use Providers\Conexao;
use PDOException;

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

    public static function buscar(int $codigo = null)
    {

        $lista = Produto::buscar_produto($codigo);

        if (count($lista) == 0) {
            Resposta::enviar(200, ['message' => '<p>Produto não encontrado, verifique o código.</p>']);
        } else {
            Resposta::enviar(200, $lista);
        }
    }

    public static function listar(int $codigo)
    {

        $lista = Produto::listar_produtos($codigo);

        if (count($lista) == 0) {
            Resposta::enviar(200, ['message' => '<p>Categoria não encontrada, verifique o código.</p>']);
        } else {
            Resposta::enviar(200, $lista);
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

    public static function cadastar_categoria(string $nome)
    {

        try {

            $query = 'INSERT INTO categoria_produto(descricao) VALUES(:nome);';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);

            $req->execute(['nome' => $nome]);

            $conn = null;

            Resposta::enviar(200, ['message' => '<p>Categoria cadastrada</p>']);
        } catch (PDOException $err) {

            $conn = null;

            $err->getCode() == 23000 ? Resposta::enviar(200, ['message' => '<p>Categoria já cadastrada</p>']) : Resposta::enviar(200, []);
        }
    }

    public static function remover_categoria(string $nome)
    {

        try {

            $query = 'DELETE FROM categoria_produto WHERE descricao = :nome';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['nome' => $nome]);

            $conn = null;
            return true;
        } catch (PDOException $err) {

            $conn = null;

            return $err->getCode();
        }
    }

    public static function listar_categorias()
    {
        try {

            $query = 'SELECT * FROM categoria_produto;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute();

            $conn = null;
            return $req->fetchAll();
        } catch (PDOException $err) {

            $conn = null;

            return $err->getCode();
        }
    }
}

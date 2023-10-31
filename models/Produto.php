<?php

namespace Models;

use Providers\Conexao;
use PDOException;
use Providers\Resposta;

class Produto
{

    public function __construct(private string $nome, private int $id_categoria, private int $codigo)
    {

        $this->id_categoria = $id_categoria;
        $this->nome = $nome;
        $this->codigo = $codigo;
    }

    public function cadastrar_item()
    {
        try {
            $query = 'INSERT INTO produtos( nome, id_categoria, codigo) VALUES (:nome, :id_categoria, :codigo);';

            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(array('nome' => $this->nome, 'id_categoria' => $this->id_categoria, 'codigo' => $this->codigo));

            $conn = null;
            return true;
        } catch (PDOException $err) {

            $conn = null;
            return $err->getCode();
        }
    }

    public static function excluir_item(int $codigo)
    {
        try {
            $query = 'DELETE FROM produtos WHERE codigo = :codigo;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['codigo' => $codigo]);

            $conn = null;
            return true;
        } catch (PDOException $err) {
            $conn = null;
            return $err->getCode();
        }
    }

    public static function editar_item(string $nome, int $id_categoria, int $codigo): bool
    {
        try {
            $query = 'UPDATE produtos SET nome = :nome, id_categoria = :id_categoria, codigo = :codigo WHERE codigo = :codigo;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['nome' => $nome, 'id_categoria' => $id_categoria, 'codigo' => $codigo]);

            $conn = null;
            return true;
        } catch (PDOException $err) {
            $conn = null;
            return $err->getCode();
        }
    }

    public static function buscar_produto(int $codigo = null)
    {

        if ($codigo == null) {

            try {

                $query = 'SELECT * FROM produtos;';
                $conn = Conexao::conectar();

                $req = $conn->prepare($query);
                $req->execute();

                $res = $req->fetchAll();
                $conn = null;

                return $res;
            } catch (PDOException $err) {

                $conn = null;
                return $err->getCode();
            }
        } else {

            try {

                $query = 'SELECT * FROM produtos WHERE codigo = :codigo;';
                $conn = Conexao::conectar();

                $req = $conn->prepare($query);
                $req->execute(['codigo' => $codigo]);

                $res = $req->fetchAll();
                $conn = null;

                return $res;
            } catch (PDOException $err) {

                $conn = null;
                return $err->getCode();
            }
        }
    }

    public static function listar_produtos(int $id_categoria)
    {

        try {

            $query = 'SELECT * FROM produtos WHERE id_categoria = :id_categoria;;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['id_categoria' => $id_categoria]);

            $res = $req->fetchAll();
            $conn = null;

            return $res;
        } catch (PDOException $err) {

            $conn = null;
            return $err->getCode();
        }
    }

    public static function baixar(int $codigo, int $quantidade){
        try{

            $query = 'UPDATE produtos SET quantidade = quantidade - :quantidade WHERE codigo = :codigo;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['quantidade'=> $quantidade, 'codigo'=> $codigo]);

            $conn = null;
            Resposta::enviar(200, ['']);
        }catch(PDOException $err){

            $conn = null;
        }
    }

    public static function adicionar(int $quantidade, int $codigo){
        try{

            $query = 'UPDATE produtos SET quantidade = quantidade + :quantidade WHERE codigo = :codigo;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['quantidade'=> $quantidade, 'codigo'=> $codigo]);

            $conn = null;
            Resposta::enviar(200, ['']);
        }catch(PDOException $err){

            $conn = null;
        }
    }
}

<?php

namespace Models;

use PDOException;

class Item
{

    public function __construct(private int $id_produto, private string $descricao, private int $id_categoria, private int $transcao)
    {
        $this->id_produto = $id_produto;
        $this->id_categoria = $id_categoria;
        $this->descricao = $descricao;
        $this->transcao = $transcao;
    }

    public function cadastrar_item(): bool
    {
        try {
            $query = 'INSERT INTO itens(id_produto, descricao, id_categoria, transacao) VALUES (:id, :descricao, :id_categoria, :transacao);';

            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(array('id' => $this->id_produto, 'descricao' => $this->descricao, 'id_categoria' => $this->id_categoria, 'transacao'=> $this->transcao));

            $conn = null;
            return true;
        } catch (PDOException $err) {

            $conn = null;
            return false;
        }
    }

    public static function excluir_item(int $id): bool
    {
        try {
            $query = 'DELETE FROM itens WHERE id = :id;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['id' => $id]);

            $conn = null;
            return true;
        } catch (PDOException $err) {
            $conn = null;
            return false;
        }
    }

    public static function editar_item(int $id_produto, string $descricao, int $id_categoria): bool
    {
        try {
            $query = 'UPDATE itens SET id_produto = :id_produto, descricao = :descricao, id_categoria = :id_categoria WHERE id_produto = :$id_produto;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['id_produto' => $id_produto, 'descricao' => $descricao, 'id_categoria' => $id_categoria]);

            $conn = null;
            return true;
        } catch (PDOException $err) {
            $conn = null;
            return false;
        }
    }

    public static function listar_item(int $id = null)
    {

        if ($id == null) {

            try {

                $query = 'SELECT * FROM itens;';
                $conn = Conexao::conectar();

                $req = $conn->prepare($query);
                $req->execute();

                $res = $req->fetchAll();
                $conn = null;

                return $res;
            } catch (PDOException $err) {

                $conn = null;

                return false;
            }
        } else {

            try {

                $query = 'SELECT * FROM itens WHERE id_produto = :id;';
                $conn = Conexao::conectar();

                $req = $conn->prepare($query);
                $req->execute(['id' => $id]);

                $res = $req->fetchAll();
                $conn = null;

                return $res;
            } catch (PDOException $err) {

                $conn = null;
                return false;
            }
        }
    }
}

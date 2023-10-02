<?php

namespace Models;

use PDOException;

class Item
{

    public function __construct(private int $id_produto, private string $descricao, private int $id_categoria)
    {
        $this->id_produto = $id_produto;
        $this->id_categoria = $id_categoria;
        $this->descricao = $descricao;
    }

    public function cadastrar_item(): bool
    {
        try {
            $query = 'INSERT INTO itens(id_produto, descricao, id_categoria) VALUES (:id, :descricao, :id_categoria);';

            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(array('id'=>$this->id_produto, 'descricao'=>$this->descricao, 'id_categoria'=> $this->id_categoria));

            $conn = null;
            return true;

        } catch (PDOException $err) {
            return $err->errorInfo;
        }
    }

    public function excluir_item(): bool
    {
        try {
            $query = 'DELETE FROM itens WHERE id = :id;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['id'=>$this->id_produto]);

            $conn = null;
            return true;

        } catch (PDOException $err) {
            return $err->errorInfo;
        }
    }
}

<?php

namespace Models;

use PDO;
use PDOException;

class Item
{

    private $conn = new PDO('mysql:host=localhost;dbname=smill', 'root', '');

    public function __construct(private string $nome, private int $id_fornecedor, private int $id_categoria)
    {
        $this->nome = $nome;
        $this->id_fornecedor = $id_fornecedor;
        $this->id_categoria = $id_categoria;
    }

    public function cadastrar_produto()
    {
        try {
            $query = '';
        } catch (PDOException $err) {
            return $err->errorInfo;
        }
    }

    public function excluir_produto()
    {
        try {
            $query = '';
        } catch (PDOException $err) {
            return $err->errorInfo;
        }
    }
}

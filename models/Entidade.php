<?php

namespace Models;

use PDOException;

class Entidade
{

    public function __construct(private string $nome, private string $data, private string $email)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->data = $data;
    }

    public function cadastrar()
    {
        try {

            $query = 'INSERT INTO entidades(nome, data_cadastro, email) VALUES(:nome, :data_cad, :endereco)';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);

            $res = $req->execute(['nome' => $this->nome, 'data_cadastro' => $this->data, 'email' => $this->email]);

            $conn = null;
            return true;
        } catch (PDOException $err) {

            $conn = null;
            return false;
        }
    }

    public static function listar(string $nome = null)
    {

        if ($nome == null) {
            try {

                $query = 'SELECT * FROM entidades;';
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

                $query = 'SELECT * FROM entidades WHERE nome LIKE %:nome%';
                $conn = Conexao::conectar();

                $req = $conn->prepare($query);
                $req->execute(['nome' => $nome]);

                $res = $req->fetchAll();
                $conn = null;

                return $res;
            } catch (PDOException $err) {

                $conn = null;
                return false;
            }
        }
    }

    public static function editar(string $nome, string $data, string $email): bool
    {
        try {
            $query = 'UPDATE entidades SET nome = :nome, data_cadastro = :data_cad, email = :email WHERE nome = :nome;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['nome' => $nome, 'data_cadastro' => $data, 'email' => $email, 'nome' => $nome]);

            $conn = null;
            return true;
        } catch (PDOException $err) {
            $conn = null;
            return false;
        }
    }
}

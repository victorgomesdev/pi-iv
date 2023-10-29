<?php

namespace Models;

use Providers\Conexao;
use PDOException;

class Entidade
{

    public function __construct(private string $nome, private string $email)
    {
        $this->nome = $nome;
        $this->email = $email;
    }

    public function cadastrar()
    {
        try {

            $query = 'INSERT INTO entidades(nome, data_cad, email) VALUES(:nome, CURRENT_DATE, :email)';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);

            $req->execute(['nome' => $this->nome, 'email' => $this->email]);

            $conn = null;
            return true;
        } catch (PDOException $err) {

            $conn = null;
            return $err->errorInfo;
        }
    }

    public static function listar(?string $nome): array
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

                return [];
            }
        } else {

            try {

                $query = 'SELECT * FROM entidades WHERE nome LIKE :nome';
                $conn = Conexao::conectar();

                $req = $conn->prepare($query);
                $nome_pesquisa = "%$nome%";

                $req->execute(['nome' => $nome_pesquisa]);

                $res = $req->fetchAll();
                $conn = null;

                return $res;
            } catch (PDOException $err) {

                $conn = null;
                return $err->errorInfo;
            }
        }
    }

    public static function editar(string $nome, string $email): bool
    {
        try {
            $query = 'UPDATE entidades SET nome = :nome, email = :email WHERE nome = :nome;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['nome' => $nome, 'email' => $email, 'nome' => $nome]);

            $conn = null;
            return true;
        } catch (PDOException $err) {
            $conn = null;
            return false;
        }
    }
}

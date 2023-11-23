<?php

namespace Models;
use Providers\Conexao;
use PDOException;

class Produto
{

    public function __construct(private string $nome, private int $codigo)
    {
        $this->nome = $nome;
        $this->codigo = $codigo;
    }

    public function cadastrar_item()
    {
        try {
            $query = 'INSERT INTO produtos( nome, codigo) VALUES (:nome, :codigo);';

            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(array('nome' => $this->nome, 'codigo' => $this->codigo));

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
            $query = 'UPDATE produtos SET nome = :nome, codigo = :codigo WHERE codigo = :codigo;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['nome' => $nome, 'codigo' => $codigo]);

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


    public static function baixar(int $codigo){
        try {
            $conn = Conexao::conectar();
        
            // Iniciar a transação
            $conn->beginTransaction();
        
            $query1 = 'UPDATE produtos SET quantidade = quantidade - 1 WHERE codigo = :codigo;';
            $query2 = 'INSERT INTO baixas(codigo) VALUES (:codigo)';
        
            $req1 = $conn->prepare($query1);
            $req1->execute(['codigo' => $codigo]);
        
            $req2 = $conn->prepare($query2);
            $req2->execute(['codigo' => $codigo]);
        
            // Commitar a transação apenas se ambas as consultas foram bem-sucedidas
            $conn->commit();
        
            
        } catch (PDOException $err) {
            // Desfazer a transação em caso de erro
            $conn->rollBack();
        
            // Tratar a exceção de alguma forma (imprimir, logar, etc.)
            echo "Erro: " . $err->getMessage();
        
            $conn = null;
        }
        
    }

    public static function adicionar($codigo){
        try{

            $query = 'UPDATE produtos SET quantidade = quantidade + 1 WHERE codigo = :codigo;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['codigo'=> $codigo]);

            $conn = null;
        }catch(PDOException $err){

            $conn = null;
            return $err->errorInfo;
        }
    }
}

<?php

class Transacao
{

    public function __construct(private int $id, private int $tipo, private string $data, private int $usuario, private int $clinica)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->data = $data;
        $this->usuario = $usuario;
        $this->clinica = $clinica;
    }

    public function registar(): bool
    {
        try {

            $query = 'INSERT INTO transacoes(id_transacao, id_tipo_tran, data_tran, id_usuario, id_clinica) VALUES (:id, :tipo, :data_tran, :usuario, :clinica);';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);

            $req->execute(['id' => $this->id, 'tipo' => $this->tipo, 'data_tran' => $this->data, 'usuario' => $this->usuario, 'clinica' => $this->clinica]);

            $conn = null;
            return true;
        } catch (PDOException $err) {
            $conn = null;
            return false;
        }
    }

    public static function listar(int $tipo = null)
    {

        if ($tipo == null) {

            try {

                $query = 'SELECT * FROM transacoes;';
                $conn = Conexao::conectar();

                $req = $conn->prepare($query);

                $req->execute();

                $res = $req->fetchAll();

                $conn = null;
                return $res;
            } catch (PDOException $err) {
            }
        } else {

            try {

                $query = 'SELECT * FROM transacoes WHERE id_tipo_tran = :tipo;';
                $conn = Conexao::conectar();

                $req = $conn->prepare($query);

                $req->execute(['tipo' => $tipo]);

                $res = $req->fetchAll();

                $conn = null;
                return $res;
            } catch (PDOException $err) {
                $conn = null;
                return false;
            }
        }
    }

    public static function obter_dados(int $id_transacao)
    {

        try {

            $query = 'SELECT * FROM transacoes WHERE id_transacao = :id_transacao;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $res = $req->execute(['id_transacao' => $id_transacao]);

            $conn = null;
            return $res;
        } catch (PDOException $err) {
            $conn = null;
            return false;
        }
    }
}

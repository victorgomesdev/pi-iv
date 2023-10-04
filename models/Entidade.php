<?php

namespace Models;

use PDOException;
class Entidade
{

    public function __construct(private string $nome, private string $data, private string $email, private int $endereco)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->data = $data;
        $this->endereco = $endereco;
    }

    public function cadastrar(){
        try{
            
        }catch(PDOException $err){

        }
    }
}

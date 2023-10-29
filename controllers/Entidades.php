<?php

namespace Controllers;

use Providers\Resposta;
use Models\Entidade;

class Entidades
{

    public static function cadastrar(string $nome, string $email)
    {

        $verificacao = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/';
        if (strlen($nome) > 0 && (strlen($email) > 0 && preg_match($verificacao, $email))) {

            $entidade = new Entidade($nome, $email);
            $entidade->cadastrar() ? Resposta::enviar(200, ['message' => '<p>Cadastro realizado com sucesso</p>']) : Resposta::enviar(200, ['message' => '<p>Dados inválidos.</p>']);
        } else {
            Resposta::enviar(400, ['message' => '<p>Dados inválidos inseridos</p>']);
        }
    }

    public static function listar($nome = null)
    {

        $lista = Entidade::listar($nome);

        if (count($lista) > 0) {
            Resposta::enviar(200, $lista);
        } else {
            Resposta::enviar(200, ['message' => '<p>Não encontrado</p>']);
        }
    }
}

<?php


class Resposta
{

    public static function enviar(int $status, array $corpo_resposta): void
    {

        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($corpo_resposta);
    }
}

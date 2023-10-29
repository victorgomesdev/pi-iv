<?php


/**
 * ARQUIVO DE PRÉ-CARREGAMENTO DAS CLASSES DO SISTEMA 
 * 
 * VISÍVEL EM 'index.php'
 * 
 * CARREGA AUTOMATICAMENTE AS CLASSES NO MOMENTO DE SUA REQUISIÇÃO SEM PRECISAR INCLUIR MANUALMENTE
 */
spl_autoload_register(function ($nome_classe){

    $caminho_model = str_replace('Models\\', 'models', $nome_classe);
    $caminho_provider = str_replace('Providers\\', 'providers', $nome_classe);
    $caminho_controller = str_replace('Controllers\\', 'controllers', $nome_classe);

    $dir_model = str_replace('\\', DIRECTORY_SEPARATOR, $caminho_model) . '.php';
    $dir_provider = str_replace('\\', DIRECTORY_SEPARATOR, $caminho_provider) . '.php';
    $dir_controller = str_replace('\\', DIRECTORY_SEPARATOR, $caminho_controller) . '.php';

    if(file_exists($dir_model)){
        require_once $dir_model;
    }
    if(file_exists($dir_provider)){
        require_once $dir_provider;
    }
    if(file_exists($dir_controller)){
        require_once $dir_controller;
    }
})
?>
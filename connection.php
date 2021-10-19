<?php

function mysqlConnect()
{
    $db_host = "fdb30.awardspace.net";
    $db_username = "3635833_trabalhoppi";
    $db_password = "Trabalho_finalpp1";
    $db_name = "3635833_trabalhoppi";

    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

    $options = [
        PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ativa o modo de erros para lançar exceções    
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // altera o modo padrão do método fetch para FETCH_ASSOC
    ];

    try {
        $pdo = new PDO($dsn, $db_username, $db_password, $options);
        return $pdo;
    } catch (Exception $e) {
        exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
    }
}

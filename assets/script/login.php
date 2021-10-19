<?php


$inputUsuario = $_POST["usuario"];
$inputSenha = $_POST["senha"];

$inputUsuario = htmlspecialchars($inputUsuario);
$inputSenha = htmlspecialchars($inputSenha);

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);


function salvaString($string, $arquivo){
    $arq = fopen($arquivo, "w");
    fwrite($arq,$string);
    fclose($arq);
    }




salvaString($inputUsuario, "email.txt");
salvaString($senhaHash, "senhaHash.txt");







?>
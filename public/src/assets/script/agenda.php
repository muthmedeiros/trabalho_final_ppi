<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php

require_once "./PROJETO-FINAL/connection.php";


if($_SERVER["REQUEST_METHOD"]=="GET"){

$pdo = mysqlConnect();

// BUSCANDO OS INPUTS DO FORMULARIO E PREVENINDO OS ATAQUES DE SQL INJECTION
if (isset ($_GET["medico"])); $medico = $_GET['medico'];
$medico = htmlspecialchars($medico);

if (isset ($_GET["especialidade"])); $especilidade = $_GET['especialidade'];
$especilidade = htmlspecialchars($especilidade);

if (isset ($_GET["time"])); $time = $_GET['time'];
$time = htmlspecialchars($time);

if (isset ($_GET["email"])); $email = $_GET['email'];
$email = htmlspecialchars($email);

if (isset ($_GET["date"])); $email = $_GET['date'];
$date = htmlspecialchars($date);

if (isset ($_GET["sexo"])); $sexo = $_GET['sexo'];
$sexo = htmlspecialchars($sexo);

if (isset ($_GET["nome"])); $nome = $_GET['nome'];
$nome = htmlspecialchars($nome);

try{
$sql = <<<SQL
SELECT * FROM `Agenda`
INSERT INTO Agenda( Data, horario, nome, sexo, email , codigoMedico)
VALUES (?,?,?,?,?,?)
SQL;

$stmt = $pdo ->prepare($sql);
$stmt->execute([$date,$time,$nome, $sexo, $email, $especilidade]);
header("location: ../index.html");
}
catch (Exception $e) {  
    //error_log($e->getMessage(), 3, 'log.php');
    if ($e->errorInfo[1] === 1062)
      exit('Dados duplicados: ' . $e->getMessage());
    else
      exit('Falha ao cadastrar os dados: ' . $e->getMessage());
  }
}

?>
</body>
</html>


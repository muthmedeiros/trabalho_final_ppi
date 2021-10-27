<?php

require_once "../../../../connection.php";

if($_SERVER["REQUEST_METHOD"]=="GET"){

$pdo = mysqlConnect();

// BUSCANDO OS INPUTS DO FORMULARIO E PREVENINDO OS ATAQUES DE SQL INJECTION
if (isset ($_GET["especialidade"])); $especilidade = $_GET['especialidade'];
$especilidade = htmlspecialchars($especilidade);

if (isset ($_GET["medico"])); $medico = $_GET['medico'];
$medico = htmlspecialchars($medico);

if (isset ($_GET["date"])); $date = $_GET['date'];
$date = htmlspecialchars($date);

if (isset ($_GET["time"])); $time = $_GET['time'];
$time = htmlspecialchars($time);

if (isset ($_GET["nome"])); $nome = $_GET['nome'];
$nome = htmlspecialchars($nome);

if (isset ($_GET["email"])); $email = $_GET['email'];
$email = htmlspecialchars($email);

if (isset ($_GET["sexo"])); $sexo = $_GET['sexo'];
$sexo = htmlspecialchars($sexo);


try{
  $sqlMedico = <<<SQL
  SELECT codigo
  FROM Pessoa
  WHERE nome = ?
  SQL;

  $stmt1 = $pdo->prepare($sqlMedico);
  $stmt1->execute([$medico]);
  $codigoMedico = $stmt1->fetchColumn();

  $sql = <<<SQL
  INSERT INTO Agenda(data, horario, nome, sexo, email, codigoMedico)
  VALUES (?, ?, ?, ?, ?, ?)
  SQL;

  $stmt2 = $pdo->prepare($sql);
  $stmt2->execute([$date, $time, $nome, $sexo, $email, $codigoMedico]);
  
  header("location: ../../../index.html");
} catch (Exception $e) {  
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


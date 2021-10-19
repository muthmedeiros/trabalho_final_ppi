  <?php

  require_once "./PROJETO-FINAL/connection.php";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pdo = mysqlConnect();

    // BUSCANDO OS INPUTS DO FORMULARIO E PREVENINDO OS ATAQUES DE SQL INJECTION
    if (isset($_POST["inputCEP"]));
    $cep = $_POST['inputCEP'];
    $cep = htmlspecialchars($cep);

    if (isset($_POST["inputLogradouro"]));
    $logradouro = $_POST['inputLogradouro'];
    $logradouro = htmlspecialchars($logradouro);

    if (isset($_POST["inputEstado"]));
    $estado = $_POST['inputEstado'];
    $estado = htmlspecialchars($estado);

    if (isset($_POST["inputCidade"]));
    $cidade = $_POST['inputCidade'];
    $cidade = htmlspecialchars($cidade);

    try {
      $sql = <<<SQL
INSERT INTO BaseDeEnderecoAjax (cep, logradouro, cidade, estado)
VALUES (?,?,?,?)
SQL;

      $stmt = $pdo->prepare($sql);
      $stmt->execute([$cep, $logradouro, $cidade, $estado]);
      header("location: ../index.html");
      exit();
    } catch (Exception $e) {
      //error_log($e->getMessage(), 3, 'log.php');
      if ($e->errorInfo[1] === 1062)
        exit('Dados duplicados: ' . $e->getMessage());
      else
        exit('Falha ao cadastrar os dados: ' . $e->getMessage());
    }
  }

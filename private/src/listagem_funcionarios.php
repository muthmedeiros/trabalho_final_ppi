<?php
require '../../public/src/assets/script/auth.php';
require '../../connection.php';

$pdo = mysqlConnect();
session_start();
exitWhenNotLogged($pdo);

$medico = $_SESSION['medico'];

try {
    $sql = <<<SQL
    SELECT PE.codigo, PE.nome, PE.sexo, PE.email, PE.telefone, 
    PE.cep, PE.logradouro, PE.cidade, PE.estado, 
    FC.codigo, FC.dataContrato, FC.salario
    FROM Pessoa AS PE, Funcionario AS FC
    WHERE PE.codigo = FC.codigo
    SQL;

    $stmt = $pdo->query($sql);
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os pacientes: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <title>Listagem de Funcionarios Cadastrados</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div
      class="
        d-flex
        flex-column flex-md-row
        align-items-center
        p-3
        px-md-4
        mb-3
        bg-white
        border-bottom
        shadow-sm
      "
    >
      <h5 class="my-0 mr-md-auto font-weight-normal">Clínica RNM</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="novo_funcionario.php"
          >Novo Funcionário</a
        >
        <a class="p-2 text-dark" href="novo_paciente.php"
          >Novo Paciente</a
        >
        <a class="p-2 text-dark" href="listagem_funcionarios.php"
          >Listar Funcionários</a
        >
        <a class="p-2 text-dark" href="listagem_pacientes.php"
          >Listar Pacientes</a
        >
        <a class="p-2 text-dark" href="listagem_enderecos.php"
          >Listar Endereços</a
        >
        <a class="p-2 text-dark" href="listagem_agendamentos.php"
          >Listar Agendamentos</a
        >
        <?php
        if($medico){
          echo '<a class="p-2 text-dark" href="listagem_meus_agendamentos.php"
                >Listar Meus Agendamentos</a> ';
        }
        ?>
      </nav>
    </div>

    <table class="table table-striped table-dark table-hover">
      <caption>
        Lista de dados dos funcionarios cadastrados
      </caption>
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome Completo</th>
          <th scope="col">Sexo</th>
          <th scope="col">Email</th>
          <th scope="col">Telefone</th>
          <th scope="col">CEP</th>
          <th scope="col">Logradouro</th>
          <th scope="col">Cidade</th>
          <th scope="col">Estado</th>
          <th scope="col">Código</th>
          <th scope="col">Início do Contrato</th>
          <th scope="col">Salário</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while($row = $stmt->fetch()){
          $rowNumber = htmlspecialchars($row['codigo']);;
          $nome = htmlspecialchars($row['nome']);
          $sexo = htmlspecialchars($row['sexo']);
          $email = htmlspecialchars($row['email']);
          $telefone = htmlspecialchars($row['telefone']);
          $cep = htmlspecialchars($row['cep']);
          $logradouro = htmlspecialchars($row['logradouro']);
          $cidade = htmlspecialchars($row['cidade']);
          $estado = htmlspecialchars($row['estado']);
          $codigo = htmlspecialchars($row['codigo']);
          $dataContrato = htmlspecialchars($row['dataContrato']);
          $salario = htmlspecialchars($row['salario']);

          echo <<<HTML
            <tr>
            <th scope="row">$rowNumber</th>
            <td>$nome</td>
            <td>$sexo</td>
            <td>$email</td>
            <td>$telefone</td>
            <td>$cep</td>
            <td>$logradouro</td>
            <td>$cidade</td>
            <td>$estado</td>
            <td>$codigo</td>
            <td>$dataContrato</td>
            <td>$salario</td>
          </tr>
          HTML;
        }
        ?>
      </tbody>
    </table>
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

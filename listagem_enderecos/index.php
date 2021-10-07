<?php
require '../conexao_bd/conexao_bd.php';
$pdo = openDb();

try {
    $sql = <<<SQL
    SELECT cep, logradouro, cidade, estado
    FROM BaseDeEnderecoAjax
    SQL;

    $stmt = $pdo->query($sql);

    header("location: ../listagem_enderecos/index.html");
    exit();
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os endereços: ' . $e->getMessage());
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

    <title>Listagem de Endereços Cadastrados</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
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
        <a class="p-2 text-dark" href="/novo_funcionario/index.html"
          >Novo Funcionário</a
        >
        <a class="p-2 text-dark" href="/novo_paciente/index.html"
          >Novo Paciente</a
        >
        <a class="p-2 text-dark" href="/listagem_pacientes/index.html"
          >Listar Pacientes</a
        >
        <a class="p-2 text-dark" href="/listagem_enderecos/index.php"
          >Listar Endereços</a
        >
        <a class="p-2 text-dark" href="/listagem_agendamentos/index.html"
          >Listar Agendamentos</a
        >
        <a class="p-2 text-dark" href="/listagem_meus_agendamentos/index.html"
          >Listar Meus Agendamentos</a
        >
        <!-- só aparece para médicos-->
      </nav>
    </div>

    <table class="table table-striped table-dark table-hover mt-1">
      <caption>
        Lista de dados dos endereços cadastrados
      </caption>
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">CEP</th>
          <th scope="col">Logradouro</th>
          <th scope="col">Cidade</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while($row = $stmt->fetch()){
          $rowNumber = 1;
          $cep = htmlspecialchars($row['cep']);
          $logradouro = htmlspecialchars($row['logradouro']);
          $cidade = htmlspecialchars($row['cidade']);
          $estado = htmlspecialchars($row['estado']);

          echo <<<HTML
            <tr>
            <th scope="row">$rowNumber</th>
            <td>$cep</td>
            <td>$logradouro</td>
            <td>$cidade</td>
            <td>$estado</td>
          </tr>
          HTML;

          $rowNumber++;
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

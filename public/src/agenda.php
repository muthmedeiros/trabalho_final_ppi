<?php
require '../../connection.php';

$pdo = mysqlConnect();

try {
    $sql = <<<SQL
    SELECT DISTINCT especialidade
    FROM Medico
    SQL;

    $especialidades = $pdo->query($sql);
} catch (Exception $e) {
    exit('Ocorreu uma falha ao listar os agendamentos: ' . $e->getMessage());
}

try {
  $sql = <<<SQL
  SELECT PE.nome
  FROM Medico AS ME, Pessoa AS PE
  WHERE ME.codigo = PE.codigo
  SQL;

  $medicos = $pdo->query($sql);
} catch (Exception $e) {
  exit('Ocorreu uma falha ao listar os agendamentos: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta lang="pt-br" />
    <meta charset="utf-8" />
    <meta name="description" content="Clinica" />
    <meta name="keywords" content="Medicina" />
    <meta name="author" content="Antonio Rezende" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./assets/css/agenda.css" />
    <title>Agenda</title>
  </head>

  <body>
    <div class="container-fluid">
      <div>
        <nav class="navbar navbar-expand-sm navbar-light">
          <a class="navbar-brand" href="../index.html"
            ><img
              src="../assets/images/logo.jpg"
              alt="logo"
              width="100px"
              height="100px"
          /></a>
          <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation"
          ></button>
          <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
              <li class="nav-item active">
                <a class="nav-link" href="galeria.html"
                  >Galeria <span class="visually-hidden">(current)</span></a
                >
              </li>

              <li class="nav-item">
                <a class="nav-link" href="agenda.php">Agenda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.html">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="endereco.html">Cadastro Endereço</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>

      <form
        action="assets/script/agenda.php"
        method="GET"
        class="form-control mb-3"
      >
        <div class="mb-3">
          <label for="Especialidade médica desejada" class="form-label"
            >Especialidades</label
          >
          <select class="form-control" name="especialidade" id="especialidade">
            <option value="">Especialidades</option>
            <?php
            while($row = $especialidades->fetch()){
              $especialidade = htmlspecialchars($row['especialidade']);

              echo <<<HTML
                <option value="Cardiologista">$especialidade</option>
              HTML;
            }
            ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="Nome do Médico desejado" class="form-label"
            >Medicos</label
          >
          <select class="form-control" name="medico" id="medico">
            <option value="">Escolha o Medico</option>
            <?php
            while($row = $medicos->fetch()){
              $medico = htmlspecialchars($row['nome']);

              echo <<<HTML
                <option value="João Antonio da Silva">$medico</option>
              HTML;
            }
            ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="date" class="form-label">Agende o dia</label>
          <input
            type="date"
            name="date"
            id="date"
            class="form-control"
            placeholder="date"
            aria-describedby="helpId"
          />
        </div>

        <div class="mb-3">
          <label for="time" class="form-label">Horarios Disponiveis</label>
          <select class="form-control" name="time" id="time">
            <option value="08">08:00</option>
            <option value="09">09:00</option>
            <option value="10">10:00</option>
            <option value="11">11:00</option>
            <option value="12">12:00</option>
            <option value="13">13:00</option>
            <option value="14">14:00</option>
            <option value="15">15:00</option>
            <option value="16">16:00</option>
            <option value="17">17:00</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Nome</label>
          <input
            type="text"
            class="form-control"
            name="nome"
            id="nome"
            aria-describedby="emailHelpId"
            placeholder="Nome"
          />
        </div>

        <div class="mb-3">
          <label for="" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            name="email"
            id="email"
            aria-describedby="emailHelpId"
            placeholder="Email"
          />
          <small id="emailHelpId" class="form-text text-muted"></small>
        </div>
        <div class="mb-3">
          <label for="Sexo" class="form-label">Sexo</label>
          <select class="form-control" name="sexo" id="sexo">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
          </select>
        </div>

        <button type="submit" class="btn btn-danger">Envie-nos</button>
      </form>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
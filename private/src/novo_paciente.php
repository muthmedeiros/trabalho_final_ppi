<?php
require '../../public/src/assets/script/auth.php';
require '../../connection.php';

$pdo = mysqlConnect();
session_start();
exitWhenNotLogged($pdo);

$medico = $_SESSION['medico'];

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <title>Cadastro de Pacientes</title>
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
        <a class="p-2 text-dark" href="novo_paciente.php">Novo Paciente</a>
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

    <div class="container">
      <form
        action="../assets/scripts/cadastrar_paciente.php"
        method="POST"
        id="form"
        class="px-5 pb-5"
      >
        <div class="form-group">
          <label for="inputNome">Nome</label>
          <input
            type="text"
            class="form-control"
            id="inputNome"
            placeholder="Digite o nome completo"
            name="inputNome"
            required
          />
        </div>

        <div class="form-group">
          <label for="inputSexo">Sexo</label>
          <select id="inputSexo" class="form-control" name="inputSexo" required>
            <option selected>Escolher...</option>
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outro">Outro</option>
            <option value="Prefiro não informar">Prefiro não informar</option>
          </select>
        </div>

        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input
            type="email"
            class="form-control"
            id="inputEmail"
            placeholder="Digite o email"
            name="inputEmail"
            required
          />
        </div>

        <div class="form-group">
          <label for="inputTelefone">Telefone</label>
          <input
            type="tel"
            class="form-control"
            id="inputTelefone"
            placeholder="Digite o telefone de contato"
            name="inputTelefone"
            required
          />
        </div>

        <div class="form-group">
          <label for="inputCep">CEP</label>
          <input
            type="text"
            class="form-control"
            id="inputCep"
            placeholder="Digite o CEP"
            name="inputCep"
            required
          />
        </div>

        <div class="form-group">
          <label for="inputLogradouro">Logradouro</label>
          <input
            type="tel"
            class="form-control"
            id="inputLogradouro"
            name="inputLogradouro"
            required
          />
        </div>

        <div class="form-group">
          <label for="inputCidade">Cidade</label>
          <input
            type="text"
            class="form-control"
            id="inputCidade"
            name="inputCidade"
            required
          />
        </div>

        <div class="form-group">
          <label for="inputEstado">Estado</label>
          <input
            type="text"
            class="form-control"
            id="inputEstado"
            name="inputEstado"
            required
          />
        </div>

        <div class="form-group">
          <label for="inputPeso">Peso</label>
          <input
            type="number"
            class="form-control"
            id="inputPeso"
            placeholder="Peso (kg)"
            name="inputPeso"
            required
          />
        </div>

        <div class="form-group">
          <label for="inputAltura">Altura</label>
          <input
            type="number"
            class="form-control"
            id="inputAltura"
            placeholder="Altuara (cm)"
            name="inputAltura"
            required
          />
        </div>

        <div class="form-group">
          <label for="inputTipoSanguineo">Tipo Sanguíneo</label>
          <select
            id="inputTipoSanguineo"
            class="form-control"
            name="inputTipoSanguineo"
            required
          >
            <option selected>Escolher...</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="0-">O-</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
    <script src="../../assets/js/busca_endereco.js"></script>
    <script>
      var inputCep = document.getElementById("inputCep");

      window.onload = () => {
        inputCep.onkeyup = () => buscaEndereco(inputCep.value, "../../assets/script/busca_endereco.php?cep=");
      };
    </script>
  </body>
</html>

<?php

require_once "../../../../connection.php";
session_start();
$pdo = mysqlConnect();

class RequestResponse
{
        public $success;
        public $detail;

        function __construct($success, $detail)
        {
                $this->success = $success;
                $this->detail = $detail;
        }
}


function checkLogin($pdo, $email, $senha)
{
        $sql = <<<SQL
                SELECT *
                FROM Pessoa AS PS, Funcionario AS FC
                WHERE FC.codigo = PS.codigo  AND  PS.email = ? AND FC.senhaHash = ?
                SQL;

        try {

                $stmt = $pdo->prepare($sql);
                $stmt->execute([$email, $senha]);
                $row = $stmt->fetch();
                if (!$row) {
                        return false;
                } else {
                        return password_verify($senha, $row['senhaHash']);
                }
        } catch (Exception $e) {
                exit('falhou' . $e->getMessage());
        }
}


function checkPassword($pdo, $email, $senha)
{
        $sql = <<<SQL
        SELECT FC.senhaHash
        FROM Pessoa AS PS, Funcionario AS FC
        WHERE PS.email = ? AND PS.codigo = FC.codigo
        SQL;

        try {
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$email]);
                $senhaHash = $stmt->fetchColumn();

                if (!$senhaHash) {
                        echo 'sem senha';
                        return false;
                }
                if (!password_verify($senha, $senhaHash)) {
                        echo 'senha errada';
                        return false;
                }

                return $senhaHash;
        } catch (Exception $e) {
                exit('falhou' . $e->getMessage());
        }
}


function checkLogged($pdo)
{
        // Verifica se as variáveis de sessão criadas
        // no momento do login estão definidas
        if (!isset($_SESSION['emailUsuario'], $_SESSION['loginString']))
                return false;

        $email = $_SESSION['emailUsuario'];

        // Resgata a senha hash armazenada para conferência
        $sql = <<<SQL
          SELECT hash_senha
          FROM cliente
          WHERE email = ?
          SQL;

        try {
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$email]);
                $senhaHash = $stmt->fetchColumn();
                if (!$senhaHash)
                        return false; // nenhum resultado (email não encontrado)

                // Gera uma nova string de login com base nos dados
                // atuais do navegador do usuário e compara com a
                // string de login gerada anteriormente no momento do login
                $loginStringCheck = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
                if (!hash_equals($loginStringCheck, $_SESSION['loginString']))
                        return false;

                return true;
        } catch (Exception $e) {
                exit('Falha inesperada: ' . $e->getMessage());
        }
}

function exitWhenNotLogged($pdo)
{
        if (!checkLogged($pdo)) {
                header("Location: ../../login.html");
                exit();
        }
}

function isDoctor($pdo, $inputEmail)
{
        try {
                $sql = <<<SQL
                SELECT ME.codigo
                FROM Medico ME, Pessoa PE
                WHERE PE.email = ?
                SQL;

                $stmt = $pdo->prepare($sql);
                $stmt->execute([$inputEmail]);

                return $stmt->fetch()['codigo'];
        } catch (Exception $e) {
                exit($e->getMessage());
        }
}

// main
$errormsg = "";

$email = $_POST['inputEmail'] ?? '';
$senha = $_POST['inputSenha'] ?? '';

if ($senhaHash = checkPassword($pdo, $email, $senha)) {
        $_SESSION['emailUsuario'] = $email;
        $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
        $_SESSION['medico'] = isDoctor($pdo, $inputEmail);
        $response = new RequestResponse(true, '../../private/index.html');
} else {
        $response = new RequestResponse(false, 'login.html');
}
echo json_encode($response);

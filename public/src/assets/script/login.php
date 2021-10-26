<?php

require_once "../../../../connection.php";
session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);


class RequestResponse
{
        public $sucess;
        public $detail;

        function __construct($sucess, $detail)
        {
                $this->$sucess = $sucess;
                $this->$detail = $detail;
        }
}


function checkLogin($pdo, $email, $senha)
{
        $sql = <<<SQL
                SELECT *
                FROM Pessoa AS PS, Funcionario AS FC
                WHERE  FC.codigo = PS.codigo  AND  PS.email = ? AND FC.senhaHash = ?
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
        SELECT senhaHash
        FROM Funcionario
        SQL;

        try {
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$email]);
                $senhaHash = $stmt->fetchColumn();
                if (!$senhaHash) {
                        return false;
                }
                if (!password_verify($senha, $senhaHash)) {
                        return false;
                }
        } catch (Exception $e) {
                exit('falhou' . $e->getMessage());
        }
}


function checkLogged($pdo)
{
        if (!isset($inputEmail, $inputSenha))
                return false;
}


// main
$errormsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (isset($_POST['inputEmail'])) $inputEmail = $_POST["inputEmail"];
        if (isset($_POST['inputSenha'])) $inputSenha = $_POST["inputSenha"];

        $inputEmail = htmlspecialchars($inputEmail);
        $inputSenha = htmlspecialchars($inputSenha);

        $senhaHash = password_hash($inputSenha, PASSWORD_DEFAULT);

        if (checkLogin($pdo, $inputEmail, $inputSenha)) {
                header("location: ../../../../private/index.html");
                exit();
        } else
                $errorMsg = "Dados incorretos";
}


if ($senhaHash = checkPassword($pdo, $email, $senha)) {
        $_SESSION['emailUsuario'] = $email;
        $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
        $response = new RequestResponse(true, '');
} else {
        $response = new RequestResponse(false, '');
}
echo json_encode($response);

function exitWhenNotLogged($pdo)
{
        if (!checkLogged($pdo)) {
                header("Location: ../../login.html");
                exit();
        }
}

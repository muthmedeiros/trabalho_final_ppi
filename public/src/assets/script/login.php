<?php
require_once $_SERVER['DOCUMENT_ROOT']."/trabalho_final/connection.php";
require_once 'auth.php';

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

$errormsg = "";

$email = $_POST['inputEmail'] ?? '';
$senha = $_POST['inputSenha'] ?? '';

if ($senhaHash = checkPassword($pdo, $email, $senha)) {
        $_SESSION['emailUsuario'] = $email;
        $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
        $medico = isDoctor($pdo, $email);
        $_SESSION['medico'] = $medico;
        $response = new RequestResponse(true, '../../private/index.html');
} else {
        $response = new RequestResponse(false, 'login.html');
}
echo json_encode($response);

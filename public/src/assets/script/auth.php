<?php
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
                        return false;
                }
                if (!password_verify($senha, $senhaHash)) {
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
          SELECT FC.senhaHash
          FROM Funcionario AS FC, Pessoa AS PE
          WHERE PE.codigo = FC.codigo AND PE.email = ?
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
                header("Location: ../../index.html");
                exit();
        }
}

function isDoctor($pdo, $inputEmail)
{
        try {
                $sql = <<<SQL
                SELECT ME.codigo
                FROM Medico AS ME, Pessoa AS PE
                WHERE PE.email = ? AND PE.codigo = ME.codigo
                SQL;

                $stmt = $pdo->prepare($sql);
                $stmt->execute([$inputEmail]);
                $medico = $stmt->fetchColumn();

                return $medico;
        } catch (Exception $e) {
                exit($e->getMessage());
        }
}
?>
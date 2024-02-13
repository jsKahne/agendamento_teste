<?php
// Este script lida com o processo de "Esqueci Minha Senha"
// Aqui, vou adicionar a geração de um token único e o envio por e-mail usando PHPMailer.

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Configurações de conexão e informações do banco de dados
$host = '127.0.0.1';
$user = 'root';
$senha = '';
$banco = 'agendamento_consultas';

// Configurações de e-mail
$email_host = 'smtp.hostinger.com';
$email_usuario = 'atendimento@webmindsdev.com.br';
$email_senha = 'Webminds@2';
$email_porta = 465; // Use a porta correta para o seu servidor SMTP

// Conexão com o banco de dados
$connection = new mysqli($host, $user, $senha, $banco);

// Verificar a conexão
if ($connection->connect_error) {
    die("Erro de conexão: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Verificar se o e-mail existe no banco de dados
    $sql = "SELECT id, username FROM users WHERE email = '$email'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Gerar um token único
        $token = bin2hex(random_bytes(32));

        // Atualizar o banco de dados com o token
        $sql_update = "UPDATE users SET reset_token = '$token' WHERE id = $user_id";
        $connection->query($sql_update);

        // Enviar e-mail com o token
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host       = $email_host;
            $mail->SMTPAuth   = true;
            $mail->Username   = $email_usuario;
            $mail->Password   = $email_senha;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $email_porta;
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Debugoutput = 'html';


            // Configurações do e-mail
            $mail->setFrom($email_usuario, 'Seu Nome');
            $mail->addAddress($email);
            $mail->Subject = 'Redefinição de Senha';
            $mail->Body    = "Para redefinir sua senha, clique no link a seguir:\n\n http://www.localhost/Agendamento/reset_password.php/$token";
            $mail->addCustomHeader('From: atendimento@webmindsdev.com.br');
            $mail->send();
            echo "Um e-mail de redefinição de senha foi enviado para $email";
        } catch (Exception $e) {
            echo "Erro no envio de e-mail: {$mail->ErrorInfo}";
        }
    } else {
        echo "E-mail não encontrado!";
    }
}

$connection->close();
?>

<!-- HTML do formulário de "Esqueci Minha Senha" -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci Minha Senha</title>
</head>
<body>
    <h2>Esqueci Minha Senha</h2>
    <form action="forgot_password.php" method="post">
        <label for="email">E-mail associado à sua conta:</label>
        <input type="email" name="email" required>

        <button type="submit">Enviar E-mail de Redefinição</button>
    </form>
</body>
</html>

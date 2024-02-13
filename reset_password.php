<?php
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
$email_porta = 465; 

// Conexão com o banco de dados
$connection = new mysqli($host, $user, $senha, $banco);

// Verificar a conexão
if ($connection->connect_error) {
    die("Erro de conexão: " . $connection->connect_error);
}

// Lógica para enviar e-mail
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

    // Configurações do e-mail
    $mail->setFrom($email_usuario, 'Atendimento');
    $mail->addAddress($email);
    $mail->Subject = 'Redefinição de Senha';
    $mail->Body    = "Para redefinir sua senha, clique no link a seguir:\n\n localhost/Agendamento/reset_password.php?token=$token";

    // Adicione o cabeçalho "From"
    $mail->setFrom('atendimento@webmindsdev.com.br', 'Atendimento');

    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Habilitar depuração do PHPMailer
    $mail->Debugoutput = 'html'; // Saída de depuração formatada como HTML

    // Tente enviar o e-mail
    $mail->send();
    echo "Um e-mail de redefinição de senha foi enviado para $email";
} catch (Exception $e) {
    echo "Erro no envio de e-mail: {$mail->ErrorInfo}";
}

// ...
$connection->close();
?>

<?php
$host = '127.0.0.1';
$user = 'root';
$senha = '';
$banco = 'agendamento_consultas';

$connection = new mysqli($host, $user, $senha, $banco);

// Processar o formulário de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash da senha
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

    if ($connection->query($sql) === TRUE) {
        echo "Registro bem-sucedido!";
    } else {
        echo "Erro no registro: " . $connection->error;
    }
}

$connection->close();
?>
<!-- HTML do formulário de registro -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>
    <form action="register.php" method="post">
        <label for="username">Nome de Usuário:</label>
        <input type="text" name="username" required>

        <label for="password">Senha:</label>
        <input type="password" name="password" required>

        <label for="email">E-mail:</label>
        <input type="email" name="email" required>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>

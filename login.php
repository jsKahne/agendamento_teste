<?php
$host = '127.0.0.1';
$user = 'root';
$senha = '';
$banco = 'agendamento_consultas';

$connection = new mysqli($host, $user, $senha, $banco);

// Verificar a conexão
if ($connection->connect_error) {
    die("Erro de conexão: " . $connection->connect_error);
}

// Processar o formulário de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php"); // Redirecionar para a página principal após o login
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
}

$connection->close();
?>

<!-- HTML do formulário de login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style/style.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
    <div class="login-box">
        <div class= "login-title">
            <h2>Login</h2>
        </div>
        <div class="form-login">
        <form action="login.php" method="post">
            <label for="username">Nome de Usuário:</label>
            <input type="text" name="username" required>
            <label for="password">Senha:</label>
            <input type="password" name="password" required>
        </form>
            <button type="submit" class= "btn-shine"><span>Login</span></button>        
            <button><a href="forgot_password.php"><span>Esqueci Minha Senha</span></a></button>
            </div> 
        </div>
        
    </div>
</body>
</html>

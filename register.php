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
        $registro_sucesso = "Cadastro bem-sucedido!";
    } else {
        $registro_erro = "Erro no Cadastro: " . $connection->error;
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
    <link rel="stylesheet" type="text/css" href="Style/style.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card2">
                <form class="form"action="register.php" method="post">
                    <p id="tittle"> Cadastro </p>
                    <?php if (isset($registro_sucesso)) : ?>
                        <span class="registro-sucesso"><?php echo $registro_sucesso; ?></span>
                    <?php endif; ?>
                    <?php if (isset($registro_erro)) : ?>
                        <span class="registro-error"><?php echo $registro_erro; ?></span>
                    <?php endif; ?>
                    <div class="field">
                        <svg viewBox="0 0 16 16"fill="currentColor"height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
                            <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z">
                            </path>
                        </svg>
                        <input type="text" class="input-field" placeholder="User" name="username" required>
                    </div>  
                    <div class="field">
                        <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z">
                            </path>
                        </svg>   
                        <input type="password" class="input-field" placeholder="Senha" name="password" required>
                    </div>
                    <div class="field">
                    <svg class="" xml:space="preserve" fill="currentColor" style="enable-background:new 0 0 16 16" viewBox="0 0 512 512" y="0" x="0" height="16" width="16" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg"><g><path class="" data-original="#000000" fill="currentColor" d="M256 0c-74.439 0-135 60.561-135 135s60.561 135 135 135 135-60.561 135-135S330.439 0 256 0zM423.966 358.195C387.006 320.667 338.009 300 286 300h-60c-52.008 0-101.006 20.667-137.966 58.195C51.255 395.539 31 444.833 31 497c0 8.284 6.716 15 15 15h420c8.284 0 15-6.716 15-15 0-52.167-20.255-101.461-57.034-138.805z"></path></g>
                    </svg>
                        <input type="email"  class="input-field" placeholder="Email" name="email" required>
                    </div>
                    <div class="btn">
                    <button type="submit" class="button1">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
</body>
</html>

<?php
session_start();

// Função para verificar se o usuário é admin (exemplo simplificado)
function isAdmin($user_id) {
    // Substitua isso pela lógica real para verificar se o usuário é admin
    return ($user_id == 1); // Supondo que o admin tenha user_id 1
}

// Verificar se o usuário está logado
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Verificar se o usuário é admin
    $isAdmin = isAdmin($user_id);

    if ($isAdmin) {
        // Página para administradores
        include('admin_index.php');
    } else {
        // Página para usuários logados
        include('user_index.php');
    }
} else {
    // Usuário não está logado
    include('index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Admin</title>
</head>
<body>
    <h1>Bem-vindo, Administrador!</h1>
    <!-- Conteúdo específico para a página do admin -->
</body>
</html>
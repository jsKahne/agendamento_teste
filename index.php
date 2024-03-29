<?php
session_start();

// Função para verificar se o usuário é admin (exemplo simplificado)
function isAdmin($user_id) {
    
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


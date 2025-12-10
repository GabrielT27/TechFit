<?php
// Arquivo: verificar_login.php
session_start();

// Credenciais fixas (em produção, use banco de dados)
$usuarios_validos = [
    'admin' => 'admin123',
    'gabriel' => 'techfit2024',
    'instrutor' => 'academia123'
];

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    
    // Validações básicas
    if (empty($usuario) || empty($senha)) {
        header('Location: login.html?erro=campos_vazios');
        exit();
    }
    
    // Verifica se o usuário existe e a senha está correta
    if (isset($usuarios_validos[$usuario]) && $usuarios_validos[$usuario] === $senha) {
        // Login bem-sucedido
        $_SESSION['usuario_logado'] = $usuario;
        $_SESSION['nome_usuario'] = ucfirst($usuario); // Transforma primeira letra em maiúscula
        $_SESSION['login_time'] = time();
        
        // Redireciona para a página admin
        header('Location: index.php'); // Ou admin.php
        exit();
    } else {
        // Login falhou
        header('Location: login.html?erro=credenciais_invalidas');
        exit();
    }
} else {
    // Se acessado diretamente sem POST
    header('Location: login.html');
    exit();
}
?>
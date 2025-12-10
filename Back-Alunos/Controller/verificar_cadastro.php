
<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once __DIR__ . '/../Model/connection.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new RuntimeException('Método inválido.');
    }

    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $data  = trim($_POST['data_nascimento'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($nome === '' || $email === '' || $data === '' || $senha === '') {
        throw new InvalidArgumentException('Preencha todos os campos.');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidArgumentException('E-mail inválido.');
    }

    // Hash de senha seguro
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    $pdo = Connection::getPDO();

    // EXEMPLO de tabela 'usuarios' — ajuste se for outra
    $sql = 'INSERT INTO usuarios (nome, email, data_nascimento, senha_hash) 
            VALUES (:nome, :email, :data, :senha)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome'  => $nome,
        ':email' => $email,
        ':data'  => $data,
        ':senha' => $hash,
    ]);

    $_SESSION['cadastro_msg'] = 'Cadastro realizado com sucesso!';
    header('Location: ../View/login.php');
    exit;

} catch (Throwable $e) {
    $_SESSION['cadastro_msg'] = $e->getMessage();
    header('Location: ../View/cadastro.php');
    exit;
}
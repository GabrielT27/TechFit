
<?php
// Inicia sessão para mensagens (opcional)
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// Captura mensagem de erro ou sucesso (se existir)
$mensagem = $_SESSION['cadastro_msg'] ?? null;
unset($_SESSION['cadastro_msg']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Seu CSS (não mudei) -->
    css/login.css
    <!-- Ícones Boxicons -->
    https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css

    <title>Cadastro Academia</title>
</head>
<body>
    <main class="container">
        <?php if (!empty($mensagem)): ?>
            <div class="alert">
                <?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endif; ?>

        <!-- Formulário correto, com action e method -->
        ../Controller/verificar_cadastro.php
            <h1>Cadastro</h1>

            <div class="input-box">
                <input name="nome" placeholder="Seu Nome Completo" type="text" required>
                <i class="bx bxs-user"></i>
            </div>

            <div class="input-box">
                <input name="email" placeholder="Email" type="email" required>
                <i class="bx bxs-envelope"></i>
            </div>

            <div class="input-box">
                <input name="data_nascimento" placeholder="Data De Nascimento" type="date" required>
                <i class="bx bxs-calendar"></i>
            </div>

            <div class="input-box">
                <input name="senha" placeholder="Senha" type="password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>

            <button type="submit" class="login">Cadastrar</button>
            <a href="login.php" class="btn-voltar" style="color: rgb(0html)">

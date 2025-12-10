
<?php
// login.php
session_start();

// ============================
// CONFIGURAÇÃO DE USUÁRIOS
// ============================
// Em produção, usar banco de dados e password_hash / password_verify.
// Aqui é apenas para fins de teste, mantendo equivalência com seu exemplo.
$USUARIOS = [
    'admin'   => 'admin123',
    'gabriel' => 'techfit2024',
];

// ============================
// LÓGICA DE LOGIN
// ============================
$mensagemErro = '';
$usuarioDigitado = '';

// Se o usuário já está logado, redireciona para o painel
if (!empty($_SESSION['admin_logado']) && $_SESSION['admin_logado'] === true) {
    header('Location: pagAdm.php');
    exit;
}

// POST: tentativa de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $senha   = isset($_POST['senha']) ? trim($_POST['senha']) : '';
    $lembrar = isset($_POST['lembrar']);

    $usuarioDigitado = $usuario;

    // Validação básica
    if ($usuario === '' || $senha === '') {
        $mensagemErro = '❌ Preencha usuário e senha!';
    } else {
        // Verifica credenciais no servidor
        if (array_key_exists($usuario, $USUARIOS) && $USUARIOS[$usuario] === $senha) {
            // Login OK: cria sessão
            $_SESSION['admin_logado'] = true;
            $_SESSION['admin_usuario'] = $usuario;
            $_SESSION['admin_nome'] = ucfirst($usuario);

            // "Lembrar usuário" via cookie (30 dias)
            if ($lembrar) {
                setcookie('admin_usuario_salvo', $usuario, time() + (30 * 24 * 60 * 60), '/');
            } else {
                // Remove cookie se existir
                if (isset($_COOKIE['admin_usuario_salvo'])) {
                    setcookie('admin_usuario_salvo', '', time() - 3600, '/');
                }
            }

            // Redireciona para a página do painel
            header('Location: pagAdm.php');
            exit;
        } else {
            $mensagemErro = '❌ Usuário ou senha incorretos!';
        }
    }
}

// Ao carregar, tenta preencher usuário do cookie
if (empty($usuarioDigitado) && isset($_COOKIE['admin_usuario_salvo'])) {
    $usuarioDigitado = $_COOKIE['admin_usuario_salvo'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TechFit Admin</title>
<link rel="stylesheet" href="./css/login.css">

    <style>
        /* Estilo para mensagem de erro */
        .mensagem-erro {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            border: 1px solid #f5c6cb;
            display: <?php echo $mensagemErro ? 'block' : 'none'; ?>;
        }

        .info-teste {
            background: #e7f3ff;
            border: 1px dashed #4a6ee0;
            border-radius: 8px;
            padding: 12px;
            margin-top: 20px;
            font-size: 13px;
            color: #333;
        }

        /* Ajuste simples do container (se não estiver no CSS externo) */
        .container {
            max-width: 380px;
            margin: 40px auto;
            padding: 24px;
            border: 1px solid #eee;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            background: #fff;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Ubuntu, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
        }
        .input-box {
            position: relative;
            margin-bottom: 18px;
        }
        .input-box input {
            width: 100%;
            padding: 12px 38px 12px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border-color .2s;
        }
        .input-box input:focus {
            border-color: #4a6ee0;
        }
        .input-box i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            font-size: 20px;
        }
        .login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #4a6ee0;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
        }
        .login:hover {
            background: #3f5cd1;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <main class="container">
        <h1>🔐 Login Admin</h1>

        <!-- Mensagem de erro -->
        <div class="mensagem-erro" id="mensagemErro">
            <?php echo htmlspecialchars($mensagemErro, ENT_QUOTES, 'UTF-8'); ?>
        </div>

        <!-- Form de login (POST) -->
        login.php
            <div class="input-box">
                <input
                    type="text"
                    id="usuario"
                    name="usuario"
                    placeholder="Usuário"
                    required
                    value="<?php echo htmlspecialchars($usuarioDigitado ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                >
                <i class="bx bxs-user"></i>
            </div>

            <div class="input-box">
                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Senha"
                    required
                >
                <i class="bx bxs-lock-alt"></i>
            </div>

            <div>
                <label>
                    <input type="checkbox" id="lembrar" name="lembrar" style="margin-bottom: 13px;"
                        <?php echo !empty($usuarioDigitado) ? 'checked' : ''; ?>>
                    Lembrar usuário
                    Esqueci senha</a>
                </label>
            </div>

            <!-- Botão de Login -->
            <button type="submit" class="login" id="loginBtn">
                Entrar no Painel Admin
            </button>
        </form>

        <div style="margin-top: 18px;">
            <p>
                Não tem acesso admin?
                <a href="#" onclick="solicitarAcesso(); return false;" style="color: rgb(58, 150, 255);"div>

        <!-- Informação para teste -->
        <div class="info-teste">
            <p><strong>💡 Para teste rápido:</strong></p>
            <p>Usuário: <strong>admin</strong> | Senha: <strong>admin123</strong></p>
        </div>
    </main>

    <script>
        // Tecla Enter faz submit do form
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const form = document.getElementById('formLogin');
                form.submit();
            }
        });

        function esqueciSenha() {
            const usuario = document.getElementById('usuario').value.trim();
            if (usuario) {
                alert(`Recuperação solicitada para: ${usuario}\n\nEm um sistema real, enviaríamos um email.`);
            } else {
                alert('Digite seu usuário primeiro.');
                document.getElementById('usuario').focus();
            }
        }

        function solicitarAcesso() {
            alert('Para acesso administrativo, entre em contato com o administrador do sistema.');
        }
    </script>
</body>
</html>

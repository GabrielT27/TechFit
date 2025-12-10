<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Login - TechFit Admin</title>
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
            display: none;
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
    </style>
</head>
<body>
    <main class="container">
        <h1>🔐 Login Admin</h1>
        
        <!-- Mensagem de erro -->
        <div id="mensagemErro" class="mensagem-erro"></div>
        
        <!-- Campos de login -->
        <div class="input-box">
            <input type="text" id="usuario" placeholder="Usuário" required>
            <i class="bx bxs-user"></i>
        </div>
        
        <div class="input-box">
            <input type="password" id="senha" placeholder="Senha" required>
            <i class="bx bxs-lock-alt"></i>
        </div>
        
        <div>
            <label>
                <input type="checkbox" id="lembrar" style="margin-bottom: 13px;">
                Lembrar senha
                <a href="#" onclick="esqueciSenha()" style="color: rgb(57, 149, 255);">Esqueci senha</a>
            </label>
        </div>

        <!-- Botão de Login -->
        <button type="button" class="login" id="loginBtn" onclick="fazerLogin()">
            Entrar no Painel Admin
        </button>

        <div style="margin-top: 18px;">
            <p>
                Não tem acesso admin? 
                <a href="#" onclick="solicitarAcesso()" style="color: rgb(58, 150, 255);">
                    Solicitar acesso
                </a>
            </p>
        </div>
        
        <!-- Informação para teste -->
        <div class="info-teste">
            <p><strong>💡 Para teste rápido:</strong></p>
            <p>Usuário: <strong>admin</strong> | Senha: <strong>admin123</strong></p>
        </div>
    </main>

    <script>
        // USUÁRIOS E SENHAS VÁLIDOS
        const USUARIOS = {
            'admin': 'admin123',
            'gabriel': 'techfit2024'
        };
        
        // FUNÇÃO PRINCIPAL DE LOGIN
        function fazerLogin() {
            const usuario = document.getElementById('usuario').value.trim();
            const senha = document.getElementById('senha').value.trim();
            const btnLogin = document.getElementById('loginBtn');
            const mensagemErro = document.getElementById('mensagemErro');
            
            // Reset
            mensagemErro.style.display = 'none';
            btnLogin.disabled = false;
            
            // Validação básica
            if (!usuario || !senha) {
                mostrarErro('Preencha usuário e senha!');
                return;
            }
            
            // Verifica credenciais
            if (USUARIOS[usuario] && USUARIOS[usuario] === senha) {
                // Login bem-sucedido
                btnLogin.disabled = true;
                btnLogin.textContent = 'Entrando...';
                
                // Salva no sessionStorage (dura enquanto o navegador estiver aberto)
                sessionStorage.setItem('admin_logado', 'true');
                sessionStorage.setItem('admin_usuario', usuario);
                sessionStorage.setItem('admin_nome', formatarNome(usuario));
                
                // Se "lembrar" estiver marcado, salva também no localStorage
                if (document.getElementById('lembrar').checked) {
                    localStorage.setItem('admin_usuario_salvo', usuario);
                }
                
                // Redireciona para a página admin
                setTimeout(() => {
                    window.location.href = 'pagAdm.php'; // OU o nome da sua página admin
                }, 800);
                
            } else {
                mostrarErro('Usuário ou senha incorretos!');
                document.getElementById('senha').value = '';
                document.getElementById('senha').focus();
            }
        }
        
        // Funções auxiliares
        function mostrarErro(mensagem) {
            const mensagemErro = document.getElementById('mensagemErro');
            mensagemErro.textContent = '❌ ' + mensagem;
            mensagemErro.style.display = 'block';
        }
        
        function formatarNome(usuario) {
            return usuario.charAt(0).toUpperCase() + usuario.slice(1);
        }
        
        function esqueciSenha() {
            const usuario = document.getElementById('usuario').value;
            if (usuario) {
                alert(`Recuperação solicitada para: ${usuario}\n\nEm um sistema real, enviaríamos um email.`);
            } else {
                alert('Digite seu usuário primeiro.');
                document.getElementById('usuario').focus();
            }
            return false;
        }
        
        function solicitarAcesso() {
            alert('Para acesso administrativo, entre em contato com o administrador do sistema.');
            return false;
        }
        
        // Tecla Enter faz login
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                fazerLogin();
            }
        });
        
        // Ao carregar a página, preenche usuário salvo se existir
        window.onload = function() {
            const usuarioSalvo = localStorage.getItem('admin_usuario_salvo');
            if (usuarioSalvo) {
                document.getElementById('usuario').value = usuarioSalvo;
                document.getElementById('lembrar').checked = true;
                document.getElementById('senha').focus();
            } else {
                document.getElementById('usuario').focus();
            }
        };
    </script>
</body>
</html>
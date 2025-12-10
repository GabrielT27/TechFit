
<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$mensagem = $_SESSION['contato_msg'] ?? null;
unset($_SESSION['contato_msg']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contato - TechFit</title>

  <!-- Seu CSS (mantido; ajuste o caminho se seu CSS estiver em View/css/contato.css) -->
  css/contato.css

  <!-- AOS (animações) -->
  https://unpkg.com/aos@2.3.1/dist/aos.css

  <!-- FONT AWESOME -->
  https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css
</head>
<body data-aos="fade-down">
  <header>
    <div data-aos="fade-down">
      <h1>Contato e Localização</h1>
      <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        Estamos sempre de portas abertas para <span style="color: aqua;">exercitar você!</span>
      </p>
    </div>
  </header>

  <!-- Mensagem de feedback -->
  <?php if (!empty($mensagem)): ?>
    <div class="alert"><?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?></div>
  <?php endif; ?>

  <!-- ÍCONES DE REDES SOCIAIS -->
  <div class="social-icons" data-aos="fade-down">
    #<i class="fa-brands fa-facebook-f"></i></a>
    #<i class="fa-brands fa-instagram"></i></a>
    #<i class="fa-brands fa-whatsapp"></i></a>
    #<i class="fa-brands fa-youtube"></i></a>
    #<i class="fa-brands fa-twitter"></i></a>
  </div>

  <div class="container contato-page">
    <!-- Formulário -->
    <section class="card contato" data-aos="fade-down">
      <h2>Fale Conosco</h2>
      ../Controller/verificar_contato.php
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Seu nome" required>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="aluno@gmail.com" required>

        <label for="mensagem">Mensagem</label>
        <textarea id="mensagem" name="mensagem" rows="5" placeholder="Escreva sua mensagem..." required></textarea>

        <button type="submit">Enviar Mensagem</button>
      </form>
    </section>

    <!-- Localização -->
    <section class="card localizacao" data-aos="fade-down">
      <h2>Onde Estamos</h2>
      <p>
        <strong>Academia TechFit</strong><br>
        Rua José Joaquim Duarte do Páteo, 222 - Jardim do Lago<br>
        Limeira
      </p>

      https://share.google/wZor15nCFoeLBvQCG
        MAPS.png
      </a>
    </section>
  </div>

  <!-- Scripts -->
  https://unpkg.com/aos@2.3.1/dist/aos.js</script>
  <script>
    AOS.init({ duration: 1200 }); // duração da animação em ms
  </script>

  <footer>
    <div class="mensagem">
      TechFitLogo.png
      <div class="separator"></div>

      mailto:gymtechfit@gmail.com
        gymtechfit@gmail.com
      </a>

      <div class="copyright">
        <p>© 2025 Academia Tech Fit - Todos os direitos reservados</p>
      </div>
    </div>
  </footer>
</body>
</html>

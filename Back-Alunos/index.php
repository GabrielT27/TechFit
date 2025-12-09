<?php

require_once __DIR__ . "/alunosController.php";




$controller = new AlunosController();
$mensagem = '';
$tipoMensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    if ($_POST['acao'] === 'salvar') {
      $controller->criar(
        $_POST['nome'],
        $_POST['sobrenome'],
        $_POST['status'],
        $_POST['plano'],
        $_POST['email'],
        $_POST['cpf'],

      );
      $mensagem = 'Aluno cadsatrado com sucesso!';
      $tipoMensagem = 'sucesso';
    } elseif ($_POST['acao'] === 'deletar') {
      $controller->excluir($_POST['id_aluno']);
      $mensagem = 'Aluno excluído com sucesso!';
      $tipoMensagem = 'sucesso';
    } elseif ($_POST['acao'] === 'atualizar') {
      $controller->atualizar(
        $_POST['id_aluno'],
        $_POST['nome'],
        $_POST['sobrenome'],
        $_POST['status'],
        $_POST['plano'],
        $_POST['email'],
        $_POST['cpf']

      );
      $mensagem = 'Aluno atualizado com sucesso!';
      $tipoMensagem = 'sucesso';
    }
  } catch (Exception $e) {
    $mensagem = $e->getMessage();
    $tipoMensagem = 'erro';
  }
}


// LISTA TODOS OS ALUNOS
$alunos = $controller->ler();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TechFit</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <!-- MENSAGENS -->
    <?php if ($mensagem): ?>
      <div class="mensagem <?php echo $tipoMensagem; ?>">
        <?php echo $mensagem; ?>
      </div>


    <?php endif; ?>


    <!-- FORMULÁRIO DE CADASTRO -->
    <h1>Cadastro de Alunos</h1>
    <form method="POST">
      <input type="hidden" name="acao" value="salvar">
      <input type="text" name="nome" placeholder="Nome do Aluno" required>
      <input type="text" name="sobrenome" placeholder="Sobrenome" required>
      <input type="text" name="status" placeholder="Ex: Ativo" required>
      <input type="text" name="plano" placeholder="Ex: Premium" required>
      <input type="text" name="email" placeholder="exemplo123@gmail.com" required>
      <input type="number" name="cpf" placeholder="12345678936" required>
      <button type="submit" class="cadastrar">Cadastrar</button>
    </form>


    <!-- LISTAGEM DE LIVROS -->
    <h2>Livros Cadastrados</h2>
    <?php if ($alunos): ?>
      <table>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Sobrenome</th>
          <th>Status</th>
          <th>Plano</th>
          <th>Email</th>
          <th>Cpf</th>
        </tr>

        <?php foreach ($alunos as $aluno): ?>

          <tr>
            <td><?php echo $aluno->getIdAluno(); ?></td>
            <td><?php echo $aluno->getNomeAluno(); ?></td>
            <td><?php echo $aluno->getSobrenomeAluno(); ?></td>
            <td><?php echo $aluno->getStatus(); ?></td>
            <td><?php echo $aluno->getPlano(); ?></td>
            <td><?php echo $aluno->getEmailAluno(); ?></td>
            <td><?php echo $aluno->getCpf(); ?></td>

            <div class="acoes-form">
              <button type="button" class="editar"

                data-id="<?php echo $aluno->getIdAluno(); ?>"

                data-nome="<?php echo htmlspecialchars($aluno->getNomeAluno(), ENT_QUOTES); ?>"

                data-sobrenome="<?php echo htmlspecialchars($livro->getSobrenomeAluno(), ENT_QUOTES); ?>"

                data-status="<?php echo htmlspecialchars(
                                $aluno->getStatus(),
                                ENT_QUOTES
                              ); ?>"

                data-plano="<?php echo htmlspecialchars(
                              $aluno->getPlano(),
                              ENT_QUOTES
                            ); ?>"

                data-emailAluno="<?php echo htmlspecialchars($aluno->getEmailAluno(), ENT_QUOTES); ?>"


                data-cpf="<?php echo $aluno->getCpf(); ?>"


                onclick="abrirModalFromButton(this)">Editar</button>
              <form method="POST" style="display:inline;">
                <input type="hidden" name="acao" value="deletar">
                <input type="hidden" name="id_aluno" value="<?php echo $aluno->getIdAluno(); ?>">
                <button type="submit" class="excluir" onclick="return confirm('Tem certeza que deseja excluir esse aluno?')">Excluir</button>
              </form>
            </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php else: ?>
      <p>Nenhum aluno cadastrado.</p>
    <?php endif; ?>
  </div>



  <!-- MODAL DE EDIÇÃO -->

  <div id="modalEditar" class="modal">
    <div class="modal-content"><span class="close" onclick="fecharModal()">&times;</span>

      <h2>Editar Aluno</h2>
      <form method="POST">
        <input type="hidden" name="acao"
          value="atualizar">

        <input type="hidden" id="edit_id" name="id_aluno">

        <input type="text" id="edit_nome" name="nome" placeholder="Nome do aluno: " required>

        <input type="text" id="edit_sobrenome" name="sobrenome" required>

        <input type="text" id="edit_status" name="status" required>

        <input type="text" id="edit_plano" name="plano" required>

        <input type="email" id="edit_email" name="email" required>

        <input type="number" id="edit_cpf" name="cpf" required>


        <button type="submit" class="cadastrar">Salvar Alterações</button>
      </form>
    </div>
  </div>


  <script>
    function abrirModalFromButton(btn) {
      var d = btn.dataset;
      document.getElementById('edit_id').value = d.id || '';

      document.getElementById('edit_nome').value = d.nome || '';

      document.getElementById('edit_sobrenome').value = d.sobrenome || '';

      document.getElementById('edit_status').value = d.status || '';

      document.getElementById('edit_plano').value = d.plano || '';

      document.getElementById('edit_email').value = d.email || '';

      document.getElementById('edit_cpf').value = d.cpf || '';

      document.getElementById('modalEditar').style.display = 'block';

    }

    function abrirModal(id, nome, sobrenome, status, plano, email, cpf) {

      document.getElementById('edit_id').value = id;

      document.getElementById('edit_nome').value = nome;

      document.getElementById('edit_sobrenome').value = sobrenome;

      document.getElementById('edit_status').value = status;

      document.getElementById('edit_plano').value = plano;

      document.getElementById('edit_email').value = email;

      document.getElementById('edit_cpf').value = cpf;
      
      document.getElementById('modalEditar').style.display = 'block';
    }

    function fecharModal() {
      document.getElementById('modalEditar').style.display = 'none';
    }

    // FECHAR MODAL CLICANDO FORA DELE 
    window.onclick = function(event) {
      var model = document.getElementById('modalEditar');
      if (event.target == modal) {
        fecharModal();
      }
    }
    
  </script>
 
</body>

</html>
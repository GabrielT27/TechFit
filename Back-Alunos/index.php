<?php 

require_once __DIR__ . "/livrosController.php";




$controller = new AlunosController();
$mensagem = '';
$tipoMensagem = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if($_POST['acao'] === 'salvar') {
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
        }

        elseif ($_POST['acao'] === 'deletar') {
            $controller->excluir($_POST['id_aluno']);
            $mensagem = 'Aluno excluído com sucesso!';
            $tipoMensagem = 'sucesso';
        }

        elseif ($_POST['acao'] === 'atualizar') {
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
    }

    catch (Exception $e) {
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

                            data-nome="<?php echo htmlespecialchars($aluno->getNomeAluno(), ENT_QUOTES); ?>" 

                            data-sobrenome="<?php echo htmlspecialchars ($livro->getSobrenomeAluno(), ENT_QUOTES); ?>"

                            data-status="<?php echo htmlespecialchars($aluno->getStatus(), 
                            ENT_QUOTES);?>"

                            data-plano="<?php echo htmlspecialchars($aluno->getPlano(),
                            ENT_QUOTES);?>"

                            data-emailAluno="<?php echo htmlspecialchars($aluno->getEmailAluno(), ENT_QUOTES);?>"


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




                            
                            




                            
                            
                            ></button>
                            </div>
                        </tr>
                </table>
    </div>
    
</body>
</html>
<?php

// Proteção de login - ADICIONE ISSO NO TOPO DO ARQUIVO
// Seu código continua aqui...

// Inclui o controller - VERIFIQUE SE O CAMINHO ESTÁ CORRETO!
$controllerPath = __DIR__ . '/../Controller/alunosController.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
} else {
    // Se não encontrar, cria uma versão simplificada
    class Aluno {
        private $id_aluno, $nome_aluno, $sobrenome_aluno, $status, $plano, $email_aluno, $cpf;
        
        public function __construct($id_aluno, $nome_aluno, $sobrenome_aluno, $status, $plano, $email_aluno, $cpf) {
            $this->id_aluno = $id_aluno;
            $this->nome_aluno = $nome_aluno;
            $this->sobrenome_aluno = $sobrenome_aluno;
            $this->status = $status;
            $this->plano = $plano;
            $this->email_aluno = $email_aluno;
            $this->cpf = $cpf;
        }
        
        public function getIdAluno() { return $this->id_aluno; }
        public function getNomeAluno() { return $this->nome_aluno; }
        public function getSobrenomeAluno() { return $this->sobrenome_aluno; }
        public function getStatus() { return $this->status; }
        public function getPlano() { return $this->plano; }
        public function getEmailAluno() { return $this->email_aluno; }
        public function getCpf() { return $this->cpf; }
    }

    class AlunosController {
        private $alunos = [];
        private $nextId = 3; // Começa com 3 porque já tem 2 alunos exemplo
        
        public function __construct() {
            // Adiciona alguns alunos de exemplo
            $this->criar("João", "Silva", "Ativo", "Premium", "joao@email.com", "12345678901");
            $this->criar("Maria", "Santos", "Ativo", "Básico", "maria@email.com", "98765432109");
        }
        
        public function criar($nome, $sobrenome, $status, $plano, $email, $cpf) {
            $aluno = new Aluno($this->nextId++, $nome, $sobrenome, $status, $plano, $email, $cpf);
            $this->alunos[] = $aluno;
            return $aluno;
        }
        
        public function ler() {
            return $this->alunos;
        }
        
        public function atualizar($id, $nome, $sobrenome, $status, $plano, $email, $cpf) {
            foreach ($this->alunos as $aluno) {
                if ($aluno->getIdAluno() == $id) {
                    // Em sistema real, atualizaria os valores
                    return true;
                }
            }
            return false;
        }
        
        public function excluir($id) {
            foreach ($this->alunos as $key => $aluno) {
                if ($aluno->getIdAluno() == $id) {
                    unset($this->alunos[$key]);
                    $this->alunos = array_values($this->alunos); // Reindexa
                    return true;
                }
            }
            return false;
        }
    }
}

// Inicializa o controller
$controller = new AlunosController();
$mensagem = '';
$tipoMensagem = '';

// Processa formulários
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['acao'])) {
            if ($_POST['acao'] === 'salvar') {
                $controller->criar(
                    $_POST['nome'],
                    $_POST['sobrenome'],
                    $_POST['status'],
                    $_POST['plano'],
                    $_POST['email'],
                    $_POST['cpf']
                );
                $mensagem = 'Aluno cadastrado com sucesso!';
                $tipoMensagem = 'sucesso';
                
            } elseif ($_POST['acao'] === 'deletar') {
                if (isset($_POST['id_aluno'])) {
                    $controller->excluir($_POST['id_aluno']);
                    $mensagem = 'Aluno excluído com sucesso!';
                    $tipoMensagem = 'sucesso';
                }
                
            } elseif ($_POST['acao'] === 'atualizar') {
                if (isset($_POST['id_aluno'])) {
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
        }
    } catch (Exception $e) {
        $mensagem = 'Erro: ' . $e->getMessage();
        $tipoMensagem = 'erro';
    }
}

// Obtém lista de alunos
$alunos = $controller->ler();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFit - Sistema de Alunos</title>
   <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- HEADER -->
        <div class="header">
            <h1><i class="fas fa-users"></i> SISTEMA DE GERENCIAMENTO DE ALUNOS</h1>
          
        </div>
        
        <!-- MENSAGENS -->
        <?php if ($mensagem): ?>
            <div class="mensagem <?php echo $tipoMensagem; ?>">
                <i class="fas fa-<?php echo $tipoMensagem === 'sucesso' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>
        
        <!-- FORMULÁRIO DE CADASTRO -->
        <div class="container-alunos">
            <h2 style="color: #ffffffff; margin-bottom: 20px;">
                <i class="fas fa-user-plus"></i> Cadastrar Novo Aluno
            </h2>
            
            <br>
            
            <form method="POST" class="form-cadastro">
                <input type="hidden" name="acao" value="salvar">
                
                <div class="group">
                    <input type="text" name="nome" placeholder="Nome do Aluno" required>
                    <input type="text" name="sobrenome" placeholder="Sobrenome" required>
                </div>
                
                <div class="form-group">
                    <select name="status" required>
                        <option value="">Selecione o Status</option>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                        <option value="Pendente">Pendente</option>
                    </select>
                    
                    <select name="plano" required>
                        <option value="">Selecione o Plano</option>
                        <option value="Premium">Premium</option>
                        <option value="Básico">Básico</option>
                        <option value="Família">Família</option>
                        <option value="Estudante">Estudante</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <input type="email" name="email" placeholder="E-mail (exemplo@gmail.com)" required>
                    <input type="text" name="cpf" pattern="(\d{11}|\d{3}\.\d{3}\.\d{3}-\d{2})" required>

                </div>

                <br><br>
                
                <button type="submit" class="btn btn-cadastrar">
                    <i class="fas fa-save"></i> Cadastrar Aluno
                </button>

                <br><br><br>
            </form>
        </div>
        
        <!-- LISTA DE ALUNOS -->
        <div class="table-container">
            <h2 style="color: #ffffffff; margin-bottom: 20px;">
                <i class="fas fa-list"></i> Alunos Cadastrados
                <span style="font-size: 14px; color: #ffffffff; margin-left: 10px;">
                    (Total: <?php echo count($alunos); ?>)
                </span>
            </h2>
            
            <?php if (count($alunos) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Status</th>
                            <th>Plano</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alunos as $aluno): ?>
                            <tr>
                                <td><strong>#<?php echo $aluno->getIdAluno(); ?></strong></td>
                                <td><?php echo htmlspecialchars($aluno->getNomeAluno()); ?></td>
                                <td><?php echo htmlspecialchars($aluno->getSobrenomeAluno()); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo strtolower($aluno->getStatus()); ?>">
                                        <?php echo $aluno->getStatus(); ?>
                                    </span>
                                </td>
                                <td><?php echo $aluno->getPlano(); ?></td>
                                <td><?php echo htmlspecialchars($aluno->getEmailAluno()); ?></td>
                                <td><?php echo $aluno->getCpf(); ?></td>
                                <td>
                                    <div class="acoes">
                                        <button type="button" class="btn-editar"
                                            data-id="<?php echo $aluno->getIdAluno(); ?>"
                                            data-nome="<?php echo htmlspecialchars($aluno->getNomeAluno(), ENT_QUOTES); ?>"
                                            data-sobrenome="<?php echo htmlspecialchars($aluno->getSobrenomeAluno(), ENT_QUOTES); ?>"
                                            data-status="<?php echo htmlspecialchars($aluno->getStatus(), ENT_QUOTES); ?>"
                                            data-plano="<?php echo htmlspecialchars($aluno->getPlano(), ENT_QUOTES); ?>"
                                            data-email="<?php echo htmlspecialchars($aluno->getEmailAluno(), ENT_QUOTES); ?>"
                                            data-cpf="<?php echo $aluno->getCpf(); ?>"
                                            onclick="abrirModal(this)">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        
                                        <form method="POST" style="display: inline;">
                                            <input type="hidden" name="acao" value="deletar">
                                            <input type="hidden" name="id_aluno" value="<?php echo $aluno->getIdAluno(); ?>">
                                            <button type="submit" class="btn-excluir" 
                                                    onclick="return confirm('Tem certeza que deseja excluir o aluno <?php echo htmlspecialchars($aluno->getNomeAluno()); ?>?')">
                                                <i class="fas fa-trash"></i> Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="sem-alunos">
                    <i class="fas fa-user-slash"></i>
                    <p>Nenhum aluno cadastrado ainda.</p>
                    <p style="font-size: 14px; margin-top: 10px;">
                        Cadastre seu primeiro aluno usando o formulário acima.
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- MODAL DE EDIÇÃO -->
    <div id="modalEditar" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h2><i class="fas fa-edit"></i> Editar Aluno</h2>
            
            <form method="POST" id="formEditar">
                <input type="hidden" name="acao" value="atualizar">
                <input type="hidden" id="edit_id" name="id_aluno">
                
                <div class="form-group">
                    <input type="text" id="edit_nome" name="nome" placeholder="Nome" required>
                    <input type="text" id="edit_sobrenome" name="sobrenome" placeholder="Sobrenome" required>
                </div>
                
                <div class="form-group">
                    <select id="edit_status" name="status" required>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                        <option value="Pendente">Pendente</option>
                    </select>
                    
                    <select id="edit_plano" name="plano" required>
                        <option value="Premium">Premium</option>
                        <option value="Básico">Básico</option>
                        <option value="Família">Família</option>
                        <option value="Estudante">Estudante</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <input type="email" id="edit_email" name="email" placeholder="E-mail" required>
                    <input type="text" id="edit_cpf" name="cpf" placeholder="CPF" required>
                </div>
                
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> Salvar Alterações
                </button>
            </form>
        </div>
    </div>
    
    <script>
        // Função para abrir modal com dados do aluno
        function abrirModal(btn) {
            const data = btn.dataset;
            
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_nome').value = data.nome;
            document.getElementById('edit_sobrenome').value = data.sobrenome;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('edit_plano').value = data.plano;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_cpf').value = data.cpf;
            
            document.getElementById('modalEditar').style.display = 'flex';
        }
        
        // Função para fechar modal
        function fecharModal() {
            document.getElementById('modalEditar').style.display = 'none';
        }
        
        // Fechar modal ao clicar fora
        window.onclick = function(event) {
            const modal = document.getElementById('modalEditar');
            if (event.target === modal) {
                fecharModal();
            }
        }
        
        // Fechar modal com ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                fecharModal();
            }
        });
        
        // Máscara para CPF
        document.querySelectorAll('input[name="cpf"]').forEach(input => {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 11) value = value.substring(0, 11);
                
                if (value.length > 9) {
                    value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{2}).*/, '$1.$2.$3-$4');
                } else if (value.length > 6) {
                    value = value.replace(/^(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
                } else if (value.length > 3) {
                    value = value.replace(/^(\d{3})(\d{0,3})/, '$1.$2');
                }
                e.target.value = value;
            });
        });
        
        // Auto-foco no primeiro campo do formulário de cadastro
        document.querySelector('input[name="nome"]').focus();
        
        // Confirmação para exclusão (já está no HTML, mas mantém como backup)
        document.querySelectorAll('.btn-excluir').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Tem certeza que deseja excluir este aluno?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
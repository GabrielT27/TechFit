
<?php
require_once __DIR__ . '/../Model/alunos.php';
require_once __DIR__ . '/../Model/alunosDAO.php';

class AlunosController {
    private $dao;

    public function __construct() {
        $this->dao = new AlunosDAO();
    }

    public function ler() {
        return $this->dao->lerAlunos();
    }

    public function criar($nome_aluno, $sobrenome_aluno, $status, $plano, $email_aluno, $cpf) {
        if (trim($nome_aluno) === '' || trim($sobrenome_aluno) === '') {
            throw new InvalidArgumentException('Nome e sobrenome são obrigatórios.');
        }
        if (!filter_var($email_aluno, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('E-mail inválido.');
        }

        $aluno = new Aluno(null, $nome_aluno, $sobrenome_aluno, $status, $plano, $email_aluno, $cpf);
        return $this->dao->criarAlunos($aluno); // retorna ID
    }

    public function atualizar($id_aluno, $novonome_aluno, $novosobrenome_aluno, $novostatus, $novoplano, $novoemail_aluno, $novocpf) {
        if ($id_aluno <= 0) {
            throw new InvalidArgumentException('ID inválido.');
        }
        if (!filter_var($novoemail_aluno, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('E-mail inválido.');
        }
        return $this->dao->atualizarAlunos($id_aluno, $novonome_aluno, $novosobrenome_aluno, $novostatus, $novoplano, $novoemail_aluno, $novocpf);
    }

    public function excluir($id_aluno) {
        if ($id_aluno <= 0) {
            throw new InvalidArgumentException('ID inválido.');
        }
        return $this->dao->excluirAlunos($id_aluno);
    }

    public function buscarPorNome($nome_aluno) {
        $nome_aluno = trim($nome_aluno);
        if ($nome_aluno === '') {
            return [];
        }
        return $this->dao->buscarPorNome($nome_aluno);
    }
}

<?php 


require_once __DIR__ . '/../Modal/alunos.php';
require_once __DIR__ . '/../Modal/alunosDAO.php';

class AlunosController {

    private $dao;


    public function __construct() {
        $this->dao = new AlunosDAO();
    }

    // READ - listar todos os alunos

    public function ler() {
        return $this->dao->lerAlunos();
    }


    // CREATE - criar novo aluno 

    public function criar($nome_aluno, $sobrenome_aluno, $status, $plano, $email_aluno, $cpf) {

        $aluno = new Aluno(null, $nome_aluno, $sobrenome_aluno, $status,  $plano, $email_aluno, $cpf);
        $this->dao->criarAlunos($aluno);

    }



    // UPDATE - ATUALIZAR ALUNO EXISTE 

    public function atualizar($id_aluno, $novonome_aluno, $novosobrenome_aluno, $novostatus, $novoplano, $novoemail_aluno, $novocpf) {

        $this->dao->atualizarAlunos($id_aluno, $novonome_aluno, $novosobrenome_aluno, $novostatus, $novoplano, $novoemail_aluno, $novocpf);
    }


    // DELETE - EXCLUIR ALUNO 

    public function excluir($id_aluno) {
        return $this->dao->excluirAlunos($id_aluno);
    }

    // BUSCAR - BUSCAR ALUNOS POR NOMES

    public function buscarPorNome($nome_aluno) {
        return $this->dao->buscarPorNome($nome_aluno);
    }
}


?>
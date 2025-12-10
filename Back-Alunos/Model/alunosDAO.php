
<?php
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/alunos.php';

class AlunosDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Connection::getPDO();
    }

    public function lerAlunos() {
        $sql = "SELECT id_aluno, nome_aluno, sobrenome_aluno, status, plano, email_aluno, cpf FROM alunos";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function criarAlunos(Aluno $aluno) {
        $sql = "INSERT INTO alunos (nome_aluno, sobrenome_aluno, status, plano, email_aluno, cpf)
                VALUES (:nome, :sobrenome, :status, :plano, :email, :cpf)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nome'      => $aluno->getNomeAluno(),
            ':sobrenome' => $aluno->getSobrenomeAluno(),
            ':status'    => $aluno->getStatus(),
            ':plano'     => $aluno->getPlano(),
            ':email'     => $aluno->getEmailAluno(),
            ':cpf'       => $aluno->getCpf(),
        ]);
        return (int)$this->pdo->lastInsertId(); // retorna ID
    }

    public function atualizarAlunos($id, $nome, $sobrenome, $status, $plano, $email, $cpf) {
        $sql = "UPDATE alunos
                   SET nome_aluno = :nome,
                       sobrenome_aluno = :sobrenome,
                       status = :status,
                       plano = :plano,
                       email_aluno = :email,
                       cpf = :cpf
                 WHERE id_aluno = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id'        => $id,
            ':nome'      => $nome,
            ':sobrenome' => $sobrenome,
            ':status'    => $status,
            ':plano'     => $plano,
            ':email'     => $email,
            ':cpf'       => $cpf,
        ]);
    }

    public function excluirAlunos($id) {
        $stmt = $this->pdo->prepare("DELETE FROM alunos WHERE id_aluno = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function buscarPorNome($nome) {
        $stmt = $this->pdo->prepare("SELECT * FROM alunos WHERE nome_aluno LIKE :nome");
        $stmt->execute([':nome' => "%$nome%"]);
        return $stmt->fetchAll();
    }
}

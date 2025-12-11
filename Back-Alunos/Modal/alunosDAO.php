<?php 


require_once 'alunos.php';
require_once 'connection.php';


class AlunosDAO {

    private $conn;

    public function __construct() {

        $this->conn = Connection::getInstance();

        
        

         // cria tabela se nao existir 

         $this->conn->exec("
            CREATE TABLE IF NOT EXISTS Alunos (
            id_aluno int auto_increment primary key, nome_aluno varchar(100) not null,
            sobrenome_aluno varchar(100) not null,
            status varchar(30) not null,
            plano varchar (100) not null,
            email_aluno varchar (230) not null,
            cpf varchar(20) not null
            )
            ");

             $this->conn->exec("ALTER TABLE Alunos MODIFY cpf VARCHAR(20)");
    }


    // CREATE 

    public function criarAlunos(Aluno $aluno) {
        $stmt = $this->conn->prepare( "
        INSERT INTO Alunos (nome_aluno, sobrenome_aluno, status, plano, email_aluno, cpf)
        VALUES (:nome, :sobrenome, :status, :plano, :email_aluno, :cpf)
        ");

        $stmt->execute( [
            ':nome'  => $aluno->getNomeAluno(),
            ':sobrenome'  => $aluno->getSobrenomeAluno(),
            ':status' => $aluno->getStatus(),
            ':plano' => $aluno->getPlano(),
            ':email_aluno' => $aluno->getEmailAluno(),
            ':cpf' => $aluno->getCpf(),
        ]);
    }


    // READ 

    public function lerAlunos() {
        $stmt = $this->conn->query("SELECT * FROM Alunos ORDER BY nome_aluno");
        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Aluno(
                $row['id_aluno'],
                $row['nome_aluno'],
                $row['sobrenome_aluno'],
                $row['status'],
                $row['plano'],
                $row['email_aluno'],
                $row['cpf']

            );
        }

        return $result;
    }



    // UPDATE 

    public function atualizarAlunos($id_aluno, $novoNome, $novoSobreNomeAluno, $novoStatus, $novoPlano, $novoEmailAluno, $novoCpf) {

        $stmt = $this->conn->prepare( "
        UPDATE Alunos
        SET nome_aluno = :novoNome,
            sobrenome_aluno = :novoSobreNomeAluno,
            status = :novoStatus,
            plano = :novoPlano,
            email_aluno = :novoEmailAluno,
            cpf = :novoCpf
        WHERE id_aluno = :id_aluno
        ");

        $stmt->execute([
    ':novoNome'  => $novoNome,
    ':novoSobreNomeAluno'  => $novoSobreNomeAluno,
    ':novoStatus'  => $novoStatus,
    ':novoPlano'  => $novoPlano,
    ':novoEmailAluno'  => $novoEmailAluno,
    ':novoCpf' => $novoCpf,
    ':id_aluno' => $id_aluno
]);

    }


    // DELETE 

    public function excluirAlunos($id_aluno) {
        $stmt = $this->conn->prepare("DELETE FROM Alunos WHERE id_aluno = :id_aluno");
        $stmt->execute([':id_aluno' => $id_aluno]);
    }


    // BUSCAR POR NOME

    public function buscarPorNome($nome_aluno) {
        $stmt = $this->conn->prepare( "SELECT * FROM Alunos WHERE nome_aluno LIKE :nome_aluno");
        $stmt->execute([':nome_aluno' => "%$nome_aluno%"]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Aluno(
                $row['id_aluno'],
                $row['nome_aluno'],
                $row['sobrenome_aluno'],
                $row['status'],
                $row['plano'],
                $row['email_aluno'],
                $row['cpf']
            );
        }
        return null;
    }
}


?>
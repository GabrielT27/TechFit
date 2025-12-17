<?php 

require_once 'funcionarios.php';
require_once 'connection.php';

class FuncionariosDAO {

    private $conn;


    public function __construct() {

        $this->conn = 
        Connection::getInstance();




        // criar tabela se nao existir


        $this->conn->exec("
        CREATE TABLE IF NOT EXISTS FUNCIONARIO (
    id_func INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    cargo VARCHAR(50),
    turno CHAR(1),
    email VARCHAR(200),
    endereco VARCHAR(200),
    cpf CHAR(11),
    telefone CHAR(11),
    dtn DATE,
    dt_adm DATE,
    salario DECIMAL(10,2),
    modalidade varchar(200)
);
");

    $this->conn->exec("ALTER TABLE Alunos MODIFY cpf VARCHAR(20)");
    }


    // CREATE 



    public function criarFuncionarios(Funcionario $funcionario) {
        $stmt = $this->conn->prepare("
        INSERT INTO FUNCIONARIOS (nome, cargo, turno, email, endereco, cpf, telefone, dtn, dt_adm, salario, id_modalidade)
        VALUES (:nome, :cargo, :turno, :email, :endereco, :cpf, :telefone, :dtn, :dt_adm, :salario, :id_modalidade)
        ");

        $stmt->execute( [
            ':nome' => $funcionario->getNomeFunc(),

            ':cargo' => $funcionario->getCargo(),

            ':turno' =>
            $funcionario->getTurno(),

            ':email' =>
            $funcionario->getEmailFunc(),

            ':endereco' => 
            $funcionario->getEnderecoFunc(),

            ':cpf' =>
            $funcionario->getCpfFunc(),

            ':telefone' =>
            $funcionario->getTelFunc(),

            ':dtn' =>
            $funcionario->getDtnFunc(),

            ':dt_adm' =>
            $funcionario->getDtnFunc(),

            ':salario' => 
            $funcionario->getSalario(),

            ':modalidade' => 
            $funcionario->getModalidade

        ])
    }


    // READ 

    public function lerFuncionarios() {
        $stmt = $this->conn->query
        ("SELECT * FROM Funcionarios ORDER BY nome");
        $result = [];

        while ($row = $stmt->fetch
        (PDO::FETCH_ASSOC)) {
            $result[] = new Funcionario(
                $row['id_func'],
                $row['nomeFunc'],
                $row['cargo'],
                $row['turno'],
                $row['emailFunc'],
                $row['enderecoFunc'],
                $row['cpfFunc'],
                $row['telFunc'],
                $row['dtnFunc'],
                $row['dt_admFunc'],
                $row['salario'],
                $row['modalidade']


            );
        }

        return $result;
    }


    // UPDATE

    public function atualizarFuncionarios
    ($id_func, $nomeFunc, $cargo, $turno, $emailFunc, $enderecoFunc, $cpfFunc, $telFunc, $dtnFunc, $dt_admFunc, $salario, $modalidade) {

        $stmt = $this->conn->prepare( "
        UPDATE Funcionarios 
        SET 
        nome = :novoNome,
        cargo = :novoCargo,
        turno = :novoTurno,
        email = :novoEmailFunc,
        endereco = :novoEnderecoFunc,
        cpf = : novoCpfFunc,
        telefone = :novoTelFunc,
        dtn = :novoDtnFunc,
        dtAdm = :novoDtAdmFunc,
        salario = :novoSalario,
        modalidade = :novoModalidade
        WHERE id_func = :id_func
        ");


        $stmt->execute([
            ':novoNomeFunc' => $novoNomeFunc,
            ':novoCargo' => $novoCargo,
            ':novoTurno' => $novoTurno,
            ':novoEmailFunc' => $novoEmailFunc,
            ':novoEnderecoFunc' => $novoEnderecoFunc,
            ':novoCpfFunc' => $novoCpfFunc,
            ':novoTelFunc' => $novoTelFunc,
            ':novoDtnFunc' => $novoDtnFunc,
            ':novoDtAdmFunc' => $novoDtAdmFunc,
            ':novoSalario' => 
            $salario,
            'novoModalidade' => $novoModalidade,
            'id_func' => $id_func
        ]);
    }


    // DELETE 

    public function excluirFuncionarios
    ($id_func) {
        $stmt = $this->conn->prepare
        ("DELETE FROM Funcionarios WHERE id_aluno = :id_aluno");
        $stmt->execute([':id_func'=>
        $id_func]);
    }




    // BUSCAR POR NOME


    public function buscarPorNome
    ($nomeFunc) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM Funcionarios WHERE nome_func LIKE :nome_func");
            $stmt->execute([':nome_func' =>
            "$nome_func"]);

            $row = $stmt->fetch
            (PDO::FETCH_ASSOC);
            if ($row) {
                return new Funcionario(
                    $row['id_func'],
                    $row['nome_func'],
                    $row['cargo'],
                    $row['turno'],
                    $row['emailFunc'],
                    $row['enderecoFunc'],
                    $row['cpf'],
                    $row['telefone'],
                    $row['DtnFunc']
                    $row['DtAdmFunc'],
                    $row['salario'],
                    $row['modalidade']
                );
            }

            return null;
        
    }
}


?>
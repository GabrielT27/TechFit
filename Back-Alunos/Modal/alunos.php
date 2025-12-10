<?php 


class Aluno{

    private $id_aluno = null;

    private $nome_aluno;

    private $sobrenome_aluno;

    private $status;

    private $plano;

    private $email_aluno;

    private $cpf;


    public function __construct($id_aluno, $nome_aluno,$sobrenome_aluno,$status,$plano,$email_aluno,$cpf) {

        $this->setIdAluno($id_aluno);
        $this->setNomeAluno($nome_aluno);
        $this->setSobrenomeAluno($sobrenome_aluno);
        $this->setStatus($status);
        $this->setPlano($plano);
        $this->setEmailAluno($email_aluno);
        $this->setCpf($cpf);
    }

    public function getIdAluno()
    {
        return $this->id_aluno;
    }

    public function setIdAluno($id_aluno)
    {
        $this->id_aluno = $id_aluno;

        return $this;
    }


    public function getNomeAluno() {
        return $this->nome_aluno;
    }

    public function setNomeAluno($nome_aluno)
    {
        $this->nome_aluno = $nome_aluno;

        return $this;
    }


    public function getSobrenomeAluno() {
        return $this->sobrenome_aluno; 
    }

    public function setSobrenomeAluno($sobrenome_aluno) {
        $this->sobrenome_aluno = $sobrenome_aluno;
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $status;
    }

    public function getPlano() {
        return $this->plano;
    }

    public function setPlano($plano) {
        $this->plano = $plano;
        return $this;
    }

    public function getEmailAluno() {
        return $this->email_aluno;
    }

    public function setEmailAluno($email_aluno) {
        $this->email_aluno = $email_aluno;
        return $this;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }
}

?>
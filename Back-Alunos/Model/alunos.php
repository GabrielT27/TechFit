
<?php
class Aluno {
    private $id_aluno = null;
    private $nome_aluno;
    private $sobrenome_aluno;
    private $status;
    private $plano;
    private $email_aluno;
    private $cpf;

    public function __construct($id_aluno, $nome_aluno, $sobrenome_aluno, $status, $plano, $email_aluno, $cpf) {
        $this->id_aluno        = $id_aluno;
        $this->nome_aluno      = $nome_aluno;
        $this->sobrenome_aluno = $sobrenome_aluno;
        $this->status          = $status;
        $this->plano           = $plano;
        $this->email_aluno     = $email_aluno;
        $this->cpf             = $cpf;
    }

    public function getIdAluno()         { return $this->id_aluno; }
    public function getNomeAluno()       { return $this->nome_aluno; }
    public function getSobrenomeAluno()  { return $this->sobrenome_aluno; }
    public function getStatus()          { return $this->status; }
    public function getPlano()           { return $this->plano; }
    public function getEmailAluno()      { return $this->email_aluno; }
    public function getCpf()             { return $this->cpf; }

    public function setIdAluno($v)       { $this->id_aluno = $v; return $this; }
    public function setNomeAluno($v)     { $this->nome_aluno = $v; return $this; }
    public function setSobrenomeAluno($v){ $this->sobrenome_aluno = $v; return $this; }
    public function setStatus($v)        { $this->status = $v; return $this; }
    public function setPlano($v)         { $this->plano = $v; return $this; }
    public function setEmailAluno($v)    { $this->email_aluno = $v; return $this; }
    public function setCpf($v)           { $this->cpf = $v; return $this; }
}

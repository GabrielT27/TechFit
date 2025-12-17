<?php 


class Funcionario{

    private $id_func = null;

    private $nomeFunc;

    private $cargo;

    private $turno;

    private $emailFunc;

    private $enderecoFunc;

    private $cpfFunc;

    private $telFunc;

    private $dtnFunc;

    private $dt_admFunc;

    private $salario;

    private $modalidade;



    public function __construct($id_func, $nomeFunc, $cargo, $turno, $emailFunc, $enderecoFunc, $cpfFunc, $telFunc, $dtnFunc, $dt_admFunc, $salario, $modalidade) {

  
        $this->setIdFunc($id_func);
        $this->setNomeFunc($nomeFunc);
        $this->setCargo($cargo);
        $this->setTurno($turno);
        $this->setEmailFunc($emailFunc);
        $this->setEnderecoFunc($enderecoFunc);
        $this->setCpfFunc($cpfFunc);
        $this->setTelFunc($telFunc);
        $this->setDtnFunc($dtnFunc);
        $this->setDtAdm($dt_admFunc);
        $this->setSalario($salario);
        $this->setModalidade($modalidade);
    }


    public function getIdFunc() {
        return $this->id_func;
    }

    public function setIdFunc($id_func) {
        $this->id_func = $id_func;

        return $this;
    }



    public function getNomeFunc() {
        return $this->nomeFunc;
    }

    public function setNomeFunc($nomeFunc) {
        $this->nomeFunc = $nomeFunc;

        return $this;
    }



    public function getCargo() {
        return $this->cargo;
    }


    public function setCargo($cargo) {
        $this->cargo = $cargo;

        return $this;
    }



    public function getTurno() {
        return $this->turno;
    }


    public function setTurno($turno) {
        $this->turno = $turno;

        return $this;
    }


    public function getEmailFunc() {
        return $this->emailFunc;
    }

    public function setEmailFunc($emailFunc) {
        $this->emailFunc=$emailFunc;

        return $this;
    }

    public function getEnderecoFunc() {
        return $this->enderecoFunc;
    }

    public function setEnderecoFunc($enderecoFunc) {
        $this->enderecoFunc=$enderecoFunc;

        return $this;
    }

    public function getCpfFunc() {
        return $this->cpfFunc;
    }

    public function setCpfFunc($cpfFunc) {
        $this->cpfFunc = $cpfFunc;
        
        return $this;
    }

    public function getTelFunc() {
        return $this->telFunc;
    }

    public function setTelFunc($telFunc) {
        $this->telFunc = $telFunc;

        return $this;
    }

    public function getDtnFunc() {
        return $this->dtnFunc;
    }

    public function setDtnFunc($dtnFunc) {
        $this->dtnFunc = $dtnFunc;

        return $this;
    }

    public function getDtAdm() {
        return $this->dt_admFunc;
}

    public function setDtAdm($dt_admFunc) {
        $this->dt_admFunc =$dt_admFunc;

        return $this;
    }

    public function getSalario() {
        return $this->salario;

    }

    public function setSalario($salario) {
        $this->salario = $salario;

        return $this;
    }

    public function getModalidade() {
        return $this->modalidade;
    }

    public function setModalidade($modalidade) {
        $this->modalidade=$modalidade;

        return $this;

    }
    

}


?>
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

    private $id_modalidade;



    public function __construct($id_func, $nomeFunc, $cargo, $turno, $emailFunc, $enderecoFunc, $cpfFunc, $telFunc, $dtnFunc, $dt_admFunc, $salario, $id_modalidade) {


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
        $this->setIdModalidade($id_modalidade);
    }


    public function getIdFunc() {
        return $this->id_func;
    }

    public function setIdFunc($id_func) {
        $this->id_func = $id_func;

        return $this;
    }



    

}


?>
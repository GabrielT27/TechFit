<?php


require_once __DIR__ . '/../Modal/funcionarios.php';

require_once __DIR__ . '/../Modal/funcionariosDAO.php';


class FuncionariosController {


    private $dao;


    public function __construct() {
        $this->dao = new AlunosDAO();
    }

    // READ - LISTAR TODOS OS FUNCIONARIOS

    public function ler() {
        return $this->dao->lerFuncionarios();
    }



    // CREATE CRIAR NOVOS FUNCIONARIOS

    public function criar($id_func, $nomeFunc, $cargo, $turno, $emailFunc, $enderecoFunc, $cpfFunc, $telFunc, $dtnFunc, $dt_admFunc, $salario, $modalidade)  {

        $funcionario = new Funcionario
        (null,
         $nomeFunc,
         $cargo,
         $turno,
         $emailFunc,
         $enderecoFunc,
         $cpfFunc,
         $telFunc,
         $dtnFunc,
         $dt_admFunc,
         $salario,
         $modalidade);
        
    }


    // UPDATE - ATUALIZAR FUNCIONARIO EXISTENTE 


    public function atualizar($id_func, $nomeFunc, $cargo, $turno, $emailFunc, $enderecoFunc, $cpfFunc, $telFunc, $dtnFunc, $dt_admFunc, $salario, $modalidade) 
    {
        $this->dao->atualizarFuncionarios($id_func,
        $nomeFunc,
        $cargo,
        $turno,
        $emailFunc,
        $enderecoFunc,
        $cpfFunc,
        $telFunc,
        $dtnFunc,
        $dt_admFunc,
        $salario,
        $modalidade);
    }





    // DELETE - EXCLUIR FUNCIONARIO



    public function excluir($id_func) 
    {
        return $this->dao->excluirFuncionarios
        ($id_func);
    }



    // BUSCAR - BUSCAR FUNCIOARIOS POR NOME


    public function buscarPorNome
    ($nomeFunc) {
        return $this->dao->buscarPorNome
        ($nomeFunc);
    }
    }



?>
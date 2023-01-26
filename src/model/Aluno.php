<?php 

namespace My_Web_Struct\model;

class Aluno
{

    private $idAluno;
    private $usuario;
    private $eletiva;

    public function __construct($usuario, $eletiva, $idAluno)
    {
        $this->usuario = $usuario;
        $this->eletiva = $eletiva;
        $this->idAluno = $idAluno;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getEletiva()
    {
        return $this->eletiva;
    }

    public function getIdAluno()
    {
        return $this->idAluno;
    }
}
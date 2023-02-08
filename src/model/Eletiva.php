<?php

namespace My_Web_Struct\model;

class Eletiva
{

    private $idEletiva;
    private $nome;
    private $descricao;
    private $areaConhecimento;
    private $idProfessor;
    private $vagas;


    public function __construct($nome, $descricao, $areaConhecimento, $idProfessor, $idEletiva = null, $vagas = null,)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->areaConhecimento = $areaConhecimento;
        $this->idProfessor = $idProfessor;
        $this->idEletiva = $idEletiva;
    }

    public function getId()
    {
        return $this->idEletiva;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getAreaConhecimento()
    {
        return $this->areaConhecimento;
    }

    public function getProfessor()
    {
        return $this->idProfessor;
    }

    public function getVagas()
    {
        return $this->vagas;
    }
}

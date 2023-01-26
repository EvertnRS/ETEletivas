<?php

namespace My_Web_Struct\model;

class Usuario
{

    private $id;
    private $login;
    public $senha;
    private $senhaMd5;
    private $numeroMatricula;
    private $nivel;

    public function __construct($login, $nivel, $numeroMatricula, $senhaMd5 = null, $senha = null, $id = null)
    {
        $this->login = $login;
        $this->nivel = $nivel;
        $this->numeroMatricula = $numeroMatricula;
        $this->senhaMd5 = $senhaMd5;
        $this->senha = $senha;
        $this->id = $id;
    }

    public function getSenhaMd5()
    {
        if ($this->senhaMd5 == null) {
            $this->senhaMd5 = md5($this->senha."ETE");
        }
        return $this->senhaMd5;
    }

    public function getId()
    {
        return $this->id;
    }

    public function validarSenha($senha)
    {
        return $this->senhaMd5 == md5($senha."ETE");
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getNivel()
    {
        return $this->nivel;
    }

    public function getMatricula()
    {
        return $this->numeroMatricula;
    }
}

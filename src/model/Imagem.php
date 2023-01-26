<?php

namespace My_Web_Struct\model;

class Imagem
{
    public $id;
    public $binario;
    public $nome;
    public $tipo;

    public function __construct($binario, $nome, $tipo, $id = null)
    {
        $this->binario = $binario;
        $this->nome = $nome;
        $this->tipo = $tipo;
        $this->id = $id;
    }
}

<?php

namespace My_Web_Struct\model\bancoDados;

use mysqli;

class Conexao
{
    private $endereco = "localhost";
    private $login = "root";
    private $senha = "R0drigues11235";
    private $banco = "eteletivas";
    public $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli(
            $this->endereco,
            $this->login,
            $this->senha,
            $this->banco
        );
    }

    public function __destruct()
    {
    }

    public function fecharConexao()
    {
        $this->mysqli->close();
        $this->__destruct();
    }
}

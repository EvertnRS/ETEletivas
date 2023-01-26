<?php

namespace My_Web_Struct\model\bancoDados;

use My_Web_Struct\model\Imagem;

class ImagemBinBd
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function adicionar(Imagem $imagem)
    {
        $comando = "INSERT INTO imagem (binario, nome, tipo) VALUES (?, ?, ?);";

        $binario = $imagem->binario;
        $nome = $imagem->nome;
        $tipo = $imagem->tipo;

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("sss", $binario, $nome, $tipo);

        $preparacao->execute();
        $resultado = $preparacao->get_result();

        if ($resultado == false) {
            return null;
        }

        $this->conexao->fecharConexao();
    }

    public function getListImage()
    {
        $comando = "SELECT * FROM imagem;";

        $resultado = $this->conexao->mysqli->query($comando);
        if ($resultado == false) {
            return null;
        }

        $listaImagem = [];

        while ($linha = $resultado->fetch_assoc()) {
            $listaImagem[] = new Imagem($linha["binario"], $linha["nome"], $linha["tipo"], $linha["id"]);
        }


        $this->conexao->fecharConexao();
        return $listaImagem;
    }
}

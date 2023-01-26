<?php

namespace My_Web_Struct\model\bancoDados;

use My_Web_Struct\model\bancoDados\Conexao;
use My_Web_Struct\model\Eletiva;

class EletivaBD
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function adicionar(Eletiva $eletiva)
    {
        $comando = "INSERT INTO Eletivas (nome, descricao, areaConhecimento, idProfessor) VALUES (?, ?, ?, ?);";

        $nome = $eletiva->getNome();
        $descricao = $eletiva->getDescricao();
        $areaConhecimento = $eletiva->getAreaConhecimento();
        $idProfessor = $eletiva->getProfessor();

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param(
            "ssss",
            $nome,
            $descricao,
            $areaConhecimento,
            $idProfessor
        );

        $preparacao->execute();

        $resultado = $preparacao->get_result();

        if ($resultado == false) {
            return null;
        }

        $this->conexao->fecharConexao();
    }

    public function atualizar(Eletiva $eletivaAtualizada)
    {
        $comando = "UPDATE Eletivas SET nome = ?, descricao = ?, areaConhecimento = ? WHERE idEletiva = ?;";

        $id = $eletivaAtualizada->getId();
        $nome = $eletivaAtualizada->getNome();
        $descricao = $eletivaAtualizada->getDescricao();
        $areaConhecimento = $eletivaAtualizada->getAreaConhecimento();

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param(
            "sssi",
            $nome,
            $descricao,
            $areaConhecimento,
            $id
        );
        $preparacao->execute();

        $resultado = $preparacao->get_result();

        if ($resultado == false) {
            return null;
        }
        $this->conexao->fecharConexao();
    }

    public function remover($idEletiva)
    {
        $comando = "DELETE FROM Eletivas WHERE idEletiva = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $idEletiva);
        $preparacao->execute();

        $resultado = $preparacao->get_result();

        if ($resultado == false) {
            return null;
        }

        $this->conexao->fecharConexao();
    }

    public function getListaEletiva()
    {
        $comando = "SELECT e.*, u.usuario FROM Eletivas e LEFT JOIN Usuarios u on u.id = e.idProfessor;";

        $resultado = $this->conexao->mysqli->query($comando);
        if ($resultado == false) {
            return null;
        }

        $listaEletivas = [];

        while ($linha = $resultado->fetch_assoc()) {
            $listaEletivas[] = $linha; //new Eletiva($linha["nome"], $linha["descricao"], $linha["areaConhecimento"], $linha["idProfessor"], $linha["idEletiva"]);
        }

        $this->conexao->fecharConexao();
        return $listaEletivas;
    }

    public function getEletiva($id)
    {
        $comando = "SELECT * FROM Eletivas WHERE idEletiva = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $id);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }


        $linha = $resultado->fetch_assoc();
        $usuario = new Eletiva($linha["nome"], $linha["descricao"], $linha["areaConhecimento"], null, $linha["idEletiva"]);
        $this->conexao->fecharConexao();
        return $usuario;
    }

    public function getIdProfessor($id)
    {
        $comando = "SELECT * FROM Eletivas WHERE idProfessor = '$id';";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $id);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }
    }

    // public function getNomeAluno() 
    // {
    //     $comando = "SELECT a.*, u.usuario FROM Alunos e LEFT JOIN Usuarios u on u.id = a.idUsuario";

    //     $resultado = $this->conexao->mysqli->query($comando);
    //     if ($resultado == false) {
    //         return null;
    //     }
    // }

    public function getListaAlunos()
    {
        $comando = "SELECT a.idAluno, u.usuario, e.nome FROM Alunos a INNER JOIN Usuarios u on (a.idAluno = u.id) INNER JOIN Eletivas e on (a.eletiva = e.idEletiva);";

        $resultado = $this->conexao->mysqli->query($comando);
        if ($resultado == false) {
            return null;
        }

        $listaAlunos = [];

        while ($linha = $resultado->fetch_assoc()) {
            $listaAlunos[] = $linha; //new Eletiva($linha["nome"], $linha["descricao"], $linha["areaConhecimento"], $linha["idProfessor"], $linha["idEletiva"]);
        }

        $this->conexao->fecharConexao();
        return $listaAlunos;
    }


    /* public function getPermissao($idProfessor)
    {
        $comando = "SELECT * FROM Eletivas WHERE idProfessor = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("s", $idProfessor);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        
        $linha = $resultado->fetch_assoc();
        $usuario = new Eletiva($linha["usuario"], $linha["nivelDeAcesso"],  $linha["numeroMatricula"], $linha["senha"], null, $linha["id"]);
        $this->conexao->fecharConexao();
        return $usuario;
    } */
}

<?php

namespace My_Web_Struct\model\bancoDados;

use My_Web_Struct\model\bancoDados\Conexao;
use My_Web_Struct\model\Aluno;

class AlunoBD
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function adicionar(Aluno $aluno)
    {
        $comando = "INSERT INTO Alunos (idAluno, usuario, eletiva) VALUES (?, ?, ?);";
        
        $idAluno = $aluno->getIdAluno();
        $usuario = $aluno->getUsuario();
        $eletiva = $aluno->getEletiva();

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param(
            "iii",
            $idAluno,
            $usuario,
            $eletiva

        );

        $preparacao->execute();

        $resultado = $preparacao->get_result();

        if ($resultado == false) {
            return null;
        }

        $this->conexao->fecharConexao();
    }

    public function getEletiva($id)
    {
        $comando = "SELECT * FROM Eletivas e INNER JOIN Alunos a on (a.eletiva = e.idEletiva) WHERE a.idAluno = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $id);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        $eletiva = [];

        while ($linha = $resultado->fetch_assoc()) {
            $eletiva[] = $linha; //new Eletiva($linha["nome"], $linha["descricao"], $linha["areaConhecimento"], $linha["idProfessor"], $linha["idEletiva"]);
        }

        $this->conexao->fecharConexao();
        return $eletiva;
    }

    /* public function atualizar(Usuario $usuairoAtualizado)
    {
        $comando = "UPDATE Usuarios SET usuario = ?, senha = ?, nivelDeAcesso = ?, numeroMatricula = ? WHERE id = ?;";

        $id = $usuairoAtualizado->getId();
        $login = $usuairoAtualizado->getLogin();
        $senha = $usuairoAtualizado->getSenhaMd5();
        $nivel = $usuairoAtualizado->getNivel();
        $matricula = $usuairoAtualizado->getMatricula();

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param(
            "sssii",
            $login,
            $senha,
            $nivel,
            $matricula,
            $id
        );
        $preparacao->execute();

        $resultado = $preparacao->get_result();

        if ($resultado == false) {
            return null;
        }
        $this->conexao->fecharConexao();
    }

    public function remover($id)
    {
        $comando = "DELETE FROM Usuarios WHERE id = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $id);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        $this->conexao->fecharConexao();
    }

    public function getLista()
    {
        $comando = "SELECT * FROM Usuarios;";

        $resultado = $this->conexao->mysqli->query($comando);
        if ($resultado == false) {
            return null;
        }

        $listaUsuario = [];

        while ($linha = $resultado->fetch_assoc()) {
            $listaUsuario[] = new Usuario($linha["usuario"], $linha["nivelDeAcesso"], $linha["numeroMatricula"], $linha["senha"], null, $linha["id"]);
        }

        $this->conexao->fecharConexao();
        return $listaUsuario;
    }*/

    // public function getListaAlunos()
    // {
    //     $comando = "SELECT * FROM Usuarios WHERE nivelDeAcesso = 'nivel1'";

    //     $resultado = $this->conexao->mysqli->query($comando);
    //     if ($resultado == false) {
    //         return null;
    //     }

    //     $listaUsuario = [];

    //     while ($linha = $resultado->fetch_assoc()) {
    //         $listaUsuario[] = new Usuario($linha["usuario"], $linha["nivelDeAcesso"], $linha["numeroMatricula"], $linha["senha"], null, $linha["id"]);
    //     }

    //     $this->conexao->fecharConexao();
    //     return $listaUsuario;
    // }

    /*public function getUsuario($id)
    {
        $comando = "SELECT * FROM Usuarios WHERE id = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $id);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        
        $linha = $resultado->fetch_assoc();
        $usuario = new Usuario($linha["usuario"], $linha["nivelDeAcesso"],  $linha["numeroMatricula"], $linha["senha"], null, $linha["id"]);
        $this->conexao->fecharConexao();
        return $usuario;
    } */
}
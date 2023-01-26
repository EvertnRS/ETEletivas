<?php

namespace My_Web_Struct\model\bancoDados;

use My_Web_Struct\model\bancoDados\Conexao;
use My_Web_Struct\model\Usuario;

class UsuarioBD
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function adicionar(Usuario $usuario)
    {
        $comando = "INSERT INTO Usuarios (usuario, senha, nivelDeAcesso, numeroMatricula) VALUES (?, ?, ?, ?);";

        $login = $usuario->getLogin();
        $senha = $usuario->getSenhaMd5();
        $nivel = $usuario->getNivel();
        $matricula = $usuario->getMatricula();

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param(
            "ssss",
            $login,
            $senha,
            $nivel,
            $matricula
        );

        $preparacao->execute();

        $resultado = $preparacao->get_result();

        if ($resultado == false) {
            return null;
        }

        $this->conexao->fecharConexao();
    }

    public function atualizar(Usuario $usuairoAtualizado)
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
    }

    public function getListaAlunos()
    {
        $comando = "SELECT * FROM Usuarios WHERE nivelDeAcesso = 'nivel1'";

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
    }

    public function getUsuario($id)
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
    }
    
    public function getUsuarioLogin($login)
    {
        $comando = "SELECT * FROM Usuarios WHERE usuario = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("s", $login);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        
        $linha = $resultado->fetch_assoc();
        $usuario = new Usuario($linha["usuario"], $linha["nivelDeAcesso"],  $linha["numeroMatricula"], $linha["senha"], null, $linha["id"]);
        $this->conexao->fecharConexao();
        return $usuario;
    }

    public function pesquisar($pesquisa)
    {
        $comando = "SELECT * FROM Usuarios WHERE usuario = ?;";
        
        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param(
            "s", 
            $pesquisa
        );
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        
        $this->conexao->fecharConexao();
    }
    

    // public function getNotas($nota)
    // {
    //     $comando = "SELECT * FROM Usuarios WHERE nota = ?;";

    //     $preparacao = $this->conexao->mysqli->prepare($comando);
    //     $preparacao->bind_param("d", $nota);
    //     $preparacao->execute();

    //     $resultado = $preparacao->get_result();
    //     if ($resultado == false) {
    //         return null;
    //     }

    //     $linha = $resultado->fetch_assoc();
    //     $usuario = new Usuario($linha["usuario"], $linha["nivelDeAcesso"],  $linha["numeroMatricula"], $linha["senha"], null, $linha["id"]);
    //     $this->conexao->fecharConexao();
    //     return $usuario;
    // }
}

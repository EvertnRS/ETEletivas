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
        $comando = "INSERT INTO Eletivas (nome, descricao, areaConhecimento, idProfessor, vagas) VALUES (?, ?, ?, ?, ?);";

        $nome = $eletiva->getNome();
        $descricao = $eletiva->getDescricao();
        $areaConhecimento = $eletiva->getAreaConhecimento();
        $idProfessor = $eletiva->getProfessor();
        $vagas = $eletiva->getVagas();

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param(
            "ssssi",
            $nome,
            $descricao,
            $areaConhecimento,
            $idProfessor,
            $vagas
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

    // public function getNomeAluno() 
    // {
    //     $comando = "SELECT a.*, u.usuario FROM Alunos e LEFT JOIN Usuarios u on u.id = a.idUsuario";

    //     $resultado = $this->conexao->mysqli->query($comando);
    //     if ($resultado == false) {
    //         return null;
    //     }
    // }

    // public function getAluno($id)
    // {
    //     $comando = "SELECT * FROM Eletivas e INNER JOIN Alunos a on (a.eletiva = e.idEletiva) WHERE a.idAluno = ?;";

    //     $preparacao = $this->conexao->mysqli->prepare($comando);
    //     $preparacao->bind_param("s", $nome);
    //     $preparacao->execute();

    //     $resultado = $preparacao->get_result();
    //     if ($resultado == false) {
    //         return null;
    //     }

    //     $aluno = [];

    //     while ($linha = $resultado->fetch_assoc()) {
    //         $aluno[] = $linha; //new Eletiva($linha["nome"], $linha["descricao"], $linha["areaConhecimento"], $linha["idProfessor"], $linha["idEletiva"]);
    //     }

    //     var_dump($aluno);
    //     exit;

    //     $this->conexao->fecharConexao();
    //     return $aluno;
    // }

    public function getListaAlunos($nome)
    {
        $comando = "SELECT a.idAluno, u.usuario, e.nome FROM Alunos a INNER JOIN Usuarios u on (a.idAluno = u.id) INNER JOIN Eletivas e on (a.eletiva = e.idEletiva) WHERE e.nome = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("s", $nome);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
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

    public function getEletivaPorId($id) {
        $comando = "SELECT nome FROM Eletivas WHERE idEletiva = ?";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $id);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        $nomes = array();
        while ($linha = $resultado->fetch_assoc()) {
            $nomes[] = $linha['nome'];
        }
    
        return $nomes;
    }

    public function getEletivaPorProfessor($id) {
        $comando = "SELECT nome FROM Eletivas WHERE idProfessor = ?";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $id);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        $nomes = array();
        while ($linha = $resultado->fetch_assoc()) {
            $nomes[] = $linha['nome'];
        }
    
        return $nomes;
    }

    public function getVagas($id) {
        $comando = "SELECT vagas FROM Eletivas WHERE idEletiva = ?";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $id);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        $vagas = array();
        while ($linha = $resultado->fetch_assoc()) {
            $vagas[] = $linha['vagas'];
        }
    
        return $vagas;
    }

    public function atualizarVagas($id) {
        $comando = "UPDATE Eletivas SET Vagas = Vagas - 1 WHERE idEletiva = ?";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $id);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }
    }

    public function getProfessor($id) {
        $comando = "SELECT u.usuario FROM Usuarios u INNER JOIN Eletivas e on (e.idProfessor = u.id) WHERE e.idEletiva = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("i", $id);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        $professor = array();
        while ($linha = $resultado->fetch_assoc()) {
            $professor[] = $linha['usuario'];
        }
    
        return $professor;
    }

    public function getDisponiveis()
    {
        $comando = "SELECT e.*, u.usuario FROM Eletivas e LEFT JOIN Usuarios u on (u.id = e.idProfessor) WHERE e.vagas != 0;";

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

    public function pesquisarEletiva($pesquisa) {
        $comando = "SELECT * FROM Eletivas WHERE nome = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("s", $pesquisa);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        $linha = $resultado->fetch_assoc();
        if (is_null($linha)) {
            die(
                "<html>" .
                    "<head>" .
                    "<link rel= 'stylesheet' href='/librares/css/reset.css'>" . 
                    "<link rel='stylesheet' href='/librares/css/styles_erro.css'>" .
                    "<title>" . "ETEletivas" . "</title>" .
                    "</head>" .
                    "<body>" .
                        "<main>" . 
                            "<div>" .
                                "<h1>Eletiva não encontrada</h1>" . 
                                "<a href = '/eletiva/lista'>Retornar</a>" . 
                            "</div>" .
                        "</main>" .
                    "</body>" .
                "</html>"
            );
        } else if (!is_null($linha)) {
            $eletiva = new Eletiva($linha["nome"], $linha["descricao"],  $linha["areaConhecimento"], $linha["idProfessor"], $linha["idEletiva"]);
            $this->conexao->fecharConexao();
            return $eletiva;
        }
    }

    public function pesquisarAluno($pesquisa) {
        $comando = "SELECT a.idAluno, u.usuario, e.nome FROM Alunos a INNER JOIN Usuarios u on (a.idAluno = u.id) INNER JOIN Eletivas e on (a.eletiva = e.idEletiva) WHERE u.usuario = ?;";

        $preparacao = $this->conexao->mysqli->prepare($comando);
        $preparacao->bind_param("s", $pesquisa);
        $preparacao->execute();

        $resultado = $preparacao->get_result();
        if ($resultado == false) {
            return null;
        }

        $linha = $resultado->fetch_assoc();
        if (is_null($linha)) {
            die(
                "<html>" .
                    "<head>" .
                    "<link rel= 'stylesheet' href='/librares/css/reset.css'>" . 
                    "<link rel='stylesheet' href='/librares/css/styles_erro.css'>" .
                    "<title>" . "ETEletivas" . "</title>" .
                    "</head>" .
                    "<body>" .
                        "<main>" . 
                            "<div>" .
                                "<h1>Eletiva não encontrada</h1>" . 
                                "<a href = '/eletiva/lista'>Retornar</a>" . 
                            "</div>" .
                        "</main>" .
                    "</body>" .
                "</html>"
            );
        } else if (!is_null($linha)) {
            $listaAlunos = [];

            while ($linha = $resultado->fetch_assoc()) {
                $listaAlunos[] = $linha; //new Eletiva($linha["nome"], $linha["descricao"], $linha["areaConhecimento"], $linha["idProfessor"], $linha["idEletiva"]);
            }

            $this->conexao->fecharConexao();
            return $listaAlunos;
        }
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

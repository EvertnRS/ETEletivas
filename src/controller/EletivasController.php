<?php

namespace My_Web_Struct\controller;

use My_Web_Struct\model\Eletiva;
use My_Web_Struct\model\Aluno;

use My_Web_Struct\model\bancoDados\EletivaBD;
use My_Web_Struct\model\bancoDados\AlunoBD;
use My_Web_Struct\model\bancoDados\UsuarioBD;

use My_Web_Struct\controller\inheritance\Controller;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EletivasController extends Controller implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $path_info = $request->getServerParams()["PATH_INFO"];
        $response = null;

        if (strpos($path_info, "cadastro")) {
            $response = $this->create();
        } else if (strpos($path_info, "add")) {
            $response = $this->addEletiva($request);
        } else if (strpos($path_info, "lista")) {
            $response = $this->list($request);
        } else if (strpos($path_info, "delete")) {
            $response = $this->delete($request);
        } else if (strpos($path_info, "atualizar")) {
            $response = $this->atualizar($request);
        } else if (strpos($path_info, "update")) {
            $response = $this->update($request);
        } else if (strpos($path_info, "escolher")) {
            $response = $this->escolher();
        } else if (strpos($path_info, "choice")) {
            $response = $this->choice($request);
        } else if (strpos($path_info, "escolhida")) {
            $response = $this->escolhida($request);
        } else if (strpos($path_info, "alunos")) {
            $response = $this->listaAlunos($request);
        } else {
            $bodyHttp = $this->getHTTPBodyBuffer("/erro/Erro_404.php",);
            $response = new Response(200, [], $bodyHttp);
        }
        return $response;
    }

    public function create(): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm"]);
        if (!is_null($validate)) {
            return $validate;
        }
        $bodyHttp = $this->getHTTPBodyBuffer("/eletiva/cadastroEletiva.php");
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }

    public function addEletiva(ServerRequestInterface $request): ResponseInterface
    {

        $validate = $this->validateCredentials(["adm"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $eletiva = new Eletiva(
            $request->getParsedBody()["nome_eletiva"],
            $request->getParsedBody()["descricao"],
            $request->getParsedBody()["area_conhecimento"],
            $request->getParsedBody()["idProfessor"],
            null
        );

        $eletivaBD = new EletivaBD();
        $eletivaBD->adicionar($eletiva);

        $response = new Response(302, ["Location" => "/eletiva/lista"], null);

        return $response;
    }

    public function list(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm", "nivel2"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $pesquisa = (isset($request->getQueryParams()['search'])) ? $request->getQueryParams()['search'] : null;

        if (is_null($pesquisa)) {

            $eletivaBD = new EletivaBD();
    
            $dados = ["listaEletivas" => $eletivaBD->getListaEletiva()];

        } else if (!is_null($pesquisa)) {

            $eletivaBD = new EletivaBD();

            $dados = ["listaEletivas" => $eletivaBD->pesquisarEletiva($pesquisa)];

        }
        
        $bodyHttp = $this->getHTTPBodyBuffer("/eletiva/listaEletiva.php", $dados);
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }

    public function delete(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm"]);

        if (!is_null($validate)) {
            return $validate;
        }

        $eletivaBD = new EletivaBD();
        $eletivaBD->remover($request->getQueryParams()["id"]);

        $response = new Response(302, ["Location" => "/eletiva/lista"], null);
        return $response;
    }

    public function update(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $eletivaBD = new EletivaBD();
        $eletiva = new Eletiva(
            $request->getParsedBody()["nome"],
            $request->getParsedBody()["descricao"],
            $request->getParsedBody()["areaConhecimento"],
            null,
            $request->getQueryParams()["id"]
        );


        $eletivaBD->atualizar($eletiva);

        $response = new Response(302, ["Location" => "/eletiva/lista"], null);
        return $response;
    }
    public function atualizar(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $eletivaBD = new EletivaBD();
        $eletiva = $eletivaBD->getEletiva($request->getQueryParams()["id"]);
        $bodyHttp = $this->getHTTPBodyBuffer("/eletiva/atualizar.php", ["eletiva" => $eletiva]);
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }

    public function escolher(): ResponseInterface
    {
        $validate = $this->validateCredentials(["nivel1"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $listaBD = new EletivaBD();
        $listaEletivas = $listaBD->getDisponiveis();
        

        $bodyHttp = $this->getHTTPBodyBuffer("/eletiva/escolher.php", ["listaEletivas" => $listaEletivas]);
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }

    public function escolhida(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["nivel1"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $eletivaBD = new EletivaBD();
        $eletiva = $eletivaBD->getEletiva($request->getQueryParams()["id"]);

        $eletivaBD = new EletivaBD();
        $professor = $eletivaBD->getProfessor($request->getQueryParams()["id"]);

        $dados = [
            "id" => $eletiva->getId(),
            "nome" => $eletiva->getNome(),
            "resumo" => $eletiva->getDescricao(),
            "professor" => $professor[0],
            "area" => $eletiva->getAreaConhecimento(),
        ];

        $bodyHttp = $this->getHTTPBodyBuffer("/eletiva/escolhida.php", ["dados" => $dados]);
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }

    public function choice(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["nivel1"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $idEletiva = $request->getQueryParams()["id"];

        $eletivaBD = new EletivaBD();
        $nome = $eletivaBD->getEletivaPorId($idEletiva);

        $eletivaBD = new EletivaBD();
        $listaAlunos = $eletivaBD->getListaAlunos($nome[0]);
        
        $qntAlunos = count($listaAlunos);
        
        $eletivaBD = new EletivaBD();
        $vagas = $eletivaBD->getVagas($idEletiva);

        if ($qntAlunos < $vagas[0]) {
            $alunoBD = new AlunoBD();
            $aluno = new Aluno(
                $_SESSION["id"],                        /* ID DO USUARIO LOGADO */
                $request->getQueryParams()["id"],   /* ELETIVA SELECIONADA */
                $_SESSION["id"]                         /* IDALUNO - AUTO_INCREMENT PELO BANCO */
            );

            $alunoBD->adicionar($aluno);

            $eletivaBD = new EletivaBD();
            $eletivaBD = $eletivaBD->atualizarVagas($idEletiva);
    
            $response = new Response(302, ["Location" => "/main_page"], null);
            return $response;
        } else {
            $bodyHTTP = $this->getHTTPBodyBuffer("/erro/Erro_404.php");
            $response = new Response(404, ["Serve" => "Matheus Server"], $bodyHTTP);
            return $response;
        }

    }

    public function listaAlunos(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["nivel2"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $pesquisa = (isset($request->getQueryParams()['search'])) ? $request->getQueryParams()['search'] : null;

        $id = $_SESSION["id"];

        if (is_null($pesquisa)) {

            $eletivaNome = new EletivaBD();
            $eletivaNome = $eletivaNome->getEletivaPorProfessor($id);
    
            $listaAlunos = new EletivaBD();
            $listaAlunos = $listaAlunos->getListaAlunos($eletivaNome[0]);

            $dados = ["listaAlunos" => $listaAlunos];

        } else if (!is_null($pesquisa)) {

            $eletivaBD = new EletivaBD();

            $dados = ["listaAlunos" => $eletivaBD->pesquisarAluno($pesquisa)];
        }

        
        $bodyHttp = $this->getHTTPBodyBuffer("/eletiva/listaAlunos.php", $dados);
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }
}


/* public function list(): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm", "nivel2"]);
        if (!is_null($validate)) {
            return $validate;
        }
        $eletivaBD = new EletivaBD();

        $dados = ["listaEletivas" => $eletivaBD->getListaEletiva()];

        $bodyHttp = $this->getHTTPBodyBuffer("/eletiva/listaEletiva.php", $dados);
        $response = new Response(200, [], $bodyHttp);
        return $response;
    } */
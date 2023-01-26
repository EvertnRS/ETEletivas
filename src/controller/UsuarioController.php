<?php

namespace My_Web_Struct\controller;

use My_Web_Struct\controller\inheritance\Controller;
use My_Web_Struct\model\bancoDados\UsuarioBD;
use My_Web_Struct\model\Usuario;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;


class UsuarioController extends Controller implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $path_info = $request->getServerParams()["PATH_INFO"];
        $response = null;

        if (strpos($path_info, "cadastro")) {
            $response = $this->create();
        } else if (strpos($path_info, "add")) {
            $response = $this->addUsuario($request);
        } else if (strpos($path_info, "lista")) {
            $response = $this->list();
        } else if (strpos($path_info, "atualizar")) {
            $response = $this->atualizar($request);
        } else if (strpos($path_info, "update")) {
            $response = $this->update($request);
        } else if (strpos($path_info, "delete")) {
            $response = $this->delete($request);
        } else if (strpos($path_info, "search")) {
            $response = $this->search($request);
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
        $bodyHttp = $this->getHTTPBodyBuffer("/usuario/cadastro.php");
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }

    public function addUsuario(ServerRequestInterface $request): ResponseInterface
    {

        $validate = $this->validateCredentials(["adm"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $usuario = new Usuario(
            $request->getParsedBody()["login"],
            $request->getParsedBody()["nivel"],
            $request->getParsedBody()["matricula"],
            null,
            $request->getParsedBody()["password"],
            null
        );

        $usuarioBD = new UsuarioBD();
        $usuarioBD->adicionar($usuario);

        $response = new Response(302, ["Location" => "/main_page"], null);
        
        return $response;
    }
    
    public function list(): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm"]);
        if (!is_null($validate)) {
            return $validate;
        }
        $usuarioBD = new UsuarioBD();

        $dados = ["listaUsuarios" => $usuarioBD->getLista()];

        $bodyHttp = $this->getHTTPBodyBuffer("/usuario/lista.php", $dados);
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }
    public function atualizar(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $usuarioBD = new UsuarioBD();
        $usuario = $usuarioBD->getUsuario($request->getQueryParams()["id"]);
        $bodyHttp = $this->getHTTPBodyBuffer("/usuario/atualizar.php", ["usuario" => $usuario]);
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }
    public function update(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm"]);
        if (!is_null($validate)) {
            return $validate;
        }

        $usuarioBD = new UsuarioBD();
        $usuario = new Usuario(
            $request->getParsedBody()["login"],
            $request->getParsedBody()["nivel"],
            $request->getParsedBody()["matricula"],
            null,
            $request->getParsedBody()["password"],
            $request->getQueryParams()["id"]
        );

        $usuarioBD->atualizar($usuario);

        $response = new Response(302, ["Location" => "/usuario/lista"], null);
        return $response;
    }

    public function delete(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm"]);
        
        if (!is_null($validate)) {
            return $validate;
        }
        
        $usuarioBD = new UsuarioBD();
        $usuarioBD->remover($request->getQueryParams()["id"]);

        $response = new Response(302, ["Location" => "/usuario/lista"], null);
        return $response;
    }

    public function search(ServerRequestInterface $request): ResponseInterface
    {
        $validate = $this->validateCredentials(["adm"]);
        
        if (!is_null($validate)) {
            return $validate;
        }

        $pesquisa = (isset($request->getQueryParams()['search'])) ? $request->getQueryParams()['search'] : null;
        
        $usuarioBD = new UsuarioBD();
        $usuarioBD->pesquisar($pesquisa);

        $response = new Response(302, ["Location" => "/usuario/lista"], null);
        return $response;
    }
}
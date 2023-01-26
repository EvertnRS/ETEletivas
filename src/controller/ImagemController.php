<?php

namespace My_Web_Struct\controller;

use My_Web_Struct\controller\inheritance\Controller;
use My_Web_Struct\model\bancoDados\ImagemBinBd;
use My_Web_Struct\model\Imagem;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;


class ImagemController extends Controller implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $path_info = $request->getServerParams()["PATH_INFO"];
        $response = null;

        if (strpos($path_info, "cadastro")) {
            $response = $this->create();
        } else if (strpos($path_info, "add")) {
            $response = $this->addImagem($request);
        } else if (strpos($path_info, "lista")) {
            $response = $this->list();
        } else if (strpos($path_info, "atualizar")) {
            // $response = $this->atualizar($request);
        } else if (strpos($path_info, "update")) {
            // $response = $this->update($request);
        } else if (strpos($path_info, "delete")) {
            // $response = $this->delete($request);
        } else {
            $bodyHttp = $this->getHTTPBodyBuffer("/erro/Erro_404.php",);
            $response = new Response(200, [], $bodyHttp);
        }
        return $response;
    }

    public function create()
    {
        $validate = $this->validateCredentials(["adm", "nivel2", "nivel1"]);
        if (!is_null($validate)) {
            return $validate;
        }
        $bodyHttp = $this->getHTTPBodyBuffer("/imagem/cadastro.php");
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }

    public function addImagem(ServerRequestInterface $request)
    {
        $binario =  file_get_contents($_FILES["foto"]['tmp_name']);
        $nome = $_FILES["foto"]['name'];
        $tipo = $_FILES["foto"]['type'];
        $tamanho = $_FILES["foto"]['size'];

        if ($tamanho <= (3 * 1024 * 1024)) {
            $imagem = new Imagem($binario, $nome, $tipo);
            $imagemBinBd = new ImagemBinBd();
            $imagemBinBd->adicionar($imagem);

            $response = new Response(302, ["Location" => "/imagem/lista"], null);
            return $response;
        }

        $response = new Response(302, ["Location" => "/imagem/cadastro"], null);
        return $response;
    }

    public function list()
    {
        $imagemBinBd = new ImagemBinBd();
        $listaImagens = $imagemBinBd->getListImage();

        $bodyHttp = $this->getHTTPBodyBuffer("/imagem/lista.php", ["listaImagens" => $listaImagens]);
        $response = new Response(200, [], $bodyHttp);
        return $response;
    }
}

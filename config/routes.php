<?php

use My_Web_Struct\controller\MainPageController;
use My_Web_Struct\controller\UsuarioController;
use My_Web_Struct\controller\ErroController;
use My_Web_Struct\controller\LoginController;
use My_Web_Struct\controller\EletivasController;

/* use My_Web_Struct\controller\ImagemController; */
/* use My_Web_Struct\controller\lista_eletivasController; */

return [
    "/" => MainPageController::class,
    "/main_page" => MainPageController::class,
    "/erro" => ErroController::class,
    "/erro/acesso_negado" => ErroController::class,
    "/login" => LoginController::class,
    "/login/logar" => LoginController::class,
    "/login/deslog" => LoginController::class,
    "/usuario/lista" => UsuarioController::class,
    "/usuario/search" => UsuarioController::class,
    "/usuario/cadastro" => UsuarioController::class,
    "/usuario/add" => UsuarioController::class,
    "/usuario/delete" => UsuarioController::class,
    "/usuario/atualizar" => UsuarioController::class,
    "/usuario/update" => UsuarioController::class,
    "/eletiva/cadastro" => EletivasController::class,
    "/eletiva/add" => EletivasController::class,
    "/eletiva/lista" => EletivasController::class,
    "/eletiva/delete" => EletivasController::class,
    "/eletiva/atualizar" => EletivasController::class,
    "/eletiva/update" => EletivasController::class,
    "/eletiva/escolher" => EletivasController::class,
    "/eletiva/choice" => EletivasController::class,
    "/eletiva/escolhida" => EletivasController::class,
    "/eletiva/alunos" => EletivasController::class
    
    
    /* "/eletiva/nota" => EletivasController::class, */
    /* "/imagem/cadastro" => ImagemController::class, */
    /* "/imagem/add" => ImagemController::class, */
    /* "/imagem/atualizar" => ImagemController::class, */
    /* "/imagem/update" => ImagemController::class, */
    /* "/imagem/delete" => ImagemController::class, */
    /* "/imagem/lista" => ImagemController::class, */
    
    /* "/CadastrarEletiva" => EletivasController::class, */
    /* "/main_page/lista_eletivas" => lista_eletivasController::class,
    "/main_page/lista_eletivas/item" => lista_eletivasController::class,
    "/main_page/cadastro_eletiva" => lista_eletivasController::class */
];
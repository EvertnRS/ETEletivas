<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="/librares/css/reset.css">
    <link rel="stylesheet" href="/librares/css/styles_cadastroeletiva.css">
    <title>ETEletivas</title>
</head>

<body>
    <header>
        <a href="/main_page" class="link">
            <h1>Tela de Cadastro de Eletiva</h1>
        </a>
    </header>
    <main>
        <div class="visual">
            <img src="/images/livro.png" alt="livro" class="imagem">
        </div>
        <div class="conteudo">
            <form class="form" action="/eletiva/add" method="post">
                <input type="text" class="nome" name="nome_eletiva" id="nome_eletiva" placeholder="Nome">
                <input type="number" class="idProfessor" name="idProfessor" id="idProfessor" placeholder="Id do Prof">
                <select name="area_conhecimento" id="area_conhecimento">
                    <option value="area_conhecimento" disabled selected>Área do Conhecimento</option>
                    <option value="livre">Livre</option>
                    <option value="humanas">Humanas</option>
                    <option value="exatas">Exatas</option>
                    <option value="linguagens">Linguagens</option>
                    <option value="natureza">Natureza</option>
                </select>
                <textarea name="descricao" id="descricao" cols="30" rows="10" placeholder="Descrição"></textarea>
            
                <button type="submit" class="btn">Criar Eletiva</button>
            </form>
        </div>
    </main>
    
</body>
<script src="/librares/js/script.js"></script>
</html> 
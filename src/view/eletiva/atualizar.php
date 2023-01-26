<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/librares/css/reset.css">
    <link rel="stylesheet" href="/librares/css/styles_navbar.css">
    <link rel="stylesheet" href="/librares/css/styles_cadastroeletiva.css">
    <title>ETEletivas</title>
</head>
<body>
    <?php require __DIR__ . "/../share/head.php"; ?>
    <h1>Tela de Atualização de Eletiva</h1>
    
    <form class="form" action="/eletiva/update?id=<?php echo $eletiva->getId() ?>" method="post">
        <label for="nome">Nome da Eletiva:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $eletiva->getNome(); ?>">
        <label for="areaConhecimento">Área do Conhecimento:</label>
        <select name="areaConhecimento" id="areaConhecimento">
            <option value="livre">Livre</option>
            <option value="humanas">Humanas</option>
            <option value="exatas">Exatas</option>
            <option value="linguagens">Linguagens</option>
            <option value="natureza">Natureza</option>
        </select>
        <label for="descricao">Descrição da Eletiva</label>
        <input type="text" name="descricao" id="descricao" value="<?php echo $eletiva->getDescricao(); ?>">
    
        <button type="submit">Atualizar</button>
    </form>

</body>
<script src="/librares/js/script.js"></script>
</html>
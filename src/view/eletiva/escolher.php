<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/librares/css/reset.css">
    <link rel="stylesheet" href="/librares/css/styles_navbar.css">
    <link rel="stylesheet" href="/librares/css/styles_cadastro.css">
    <title>ETEletivas</title>
</head>

<body>
    <?php require __DIR__ . "/../share/head.php"; ?>
    <main>
        <h1>Tela de Escolha da Eletiva</h1>
        <form class="form" action="/eletiva/escolhida" method="post">
            <select name="eletiva" id="eletiva">
                <?php foreach ($listaEletivas as $valor) { ?>
                    <option value="<?php echo $valor["idEletiva"] ?>"><?php echo $valor["nome"]; ?></option>
                <?php } ?>
            </select>
            <button type="submit">Escolher</button>
        </form>
    </main>

</body>
<script src="/librares/js/script.js"></script>

</html>
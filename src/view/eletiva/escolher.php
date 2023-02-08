<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/librares/css/reset.css">
    <link rel="stylesheet" href="/librares/css/styles_navbar.css">
    <link rel="stylesheet" href="/librares/css/styles_listaeletivas.css">
    <title>ETEletivas</title>
</head>

<body>
    <?php require __DIR__ . "/../share/head.php"; ?>
    <main>
        <div class="container">
            <?php foreach ($listaEletivas as $valor) { ?>
                <?php echo "<a href = '/eletiva/escolhida?id=" . $valor["idEletiva"] . "'>";?>
                    <div class="corpo">
                        <?php if ($valor["areaConhecimento"] == "exatas") { ?>
                            <div>
                                <img src="/images/exatas.jpg" alt="logo das eletivas de exatas" class="visual">
                            </div>
                        <?php } else if ($valor["areaConhecimento"] == "linguagens") { ?>
                            <div>
                                <img src="/images/linguagens.jpg" alt="logo das eletivas de linguagens" class="visual">
                            </div>
                        <?php } else if ($valor["areaConhecimento"] == "humanas") { ?>
                            <div>
                                <img src="/images/humanas.jpg" alt="logo das eletivas de humanas" class="visual">
                            </div>
                        <?php } else if ($valor["areaConhecimento"] == "natureza") { ?>
                            <div>
                                <img src="/images/natureza.jpg" alt="logo das eletivas de natureza" class="visual">
                            </div>
                        <?php } else { ?>
                            <div>
                                <img src="/images/livre.jpg" alt="logo das eletivas livre" class="visual">
                            </div>
                        <?php } ?>
                        <div class="textual">
                            <h2><?php echo $valor["nome"]; ?></h2>
                            <div class="info">
                                <div>
                                    <h3>Professor: </h3>
                                    <p><?php echo $valor["usuario"]; ?></p>
                                </div>
                                <div>
                                    <h3>Vagas: </h3>
                                    <p><?php echo $valor["vagas"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php } ?> 
        </div>
    </main>

</body>
<script src="/librares/js/script.js"></script>

</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="/librares/css/reset.css">
    <link rel="stylesheet" href="/librares/css/styles_navbar.css">
    <link rel="stylesheet" href="/librares/css/styles_eletiva.css">
    <title>Nome da Eletiva</title>
</head>
<body>
    <?php require __DIR__ . "/../share/head.php"; ?>
    <main>
        <h1><?php echo $dados["nome"]; ?></h1>
        <h2>Resumo:</h2>
        <p class="resumo"><?php echo $dados["resumo"];?></p>
        <div class="info">
            <div>
                <h2>Professor:</h2>
                <p><?php echo $dados["professor"];?></p>
            </div>
            <div>
                <h2>Área do conhecimento:</h2>
                <p><?php echo $dados["area"];?></p>
            </div>
        </div>
        <div class="div_btn">
            <?php echo "<a href = '/eletiva/choice?id=" . $dados["id"] ."' class='btn'>Escolher</a>";?>        
        </div>
    </main>
</body>
</html>
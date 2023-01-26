<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/librares/css/reset.css">
    <link rel="stylesheet" href="/librares/css/styles_navbar.css">
    <link rel="stylesheet" href="/librares/css/styles_tabelas.css">
    <title>ETEletivas</title>
</head>

<body>
    <?php require __DIR__ . "/../share/head.php"; ?>
    <main>
        <div class="alinhar">
            <h1>Lista de Eletivas</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col" colspan="3">ID</th>
                        <th scope="col" colspan="3">Nome</th>
                        <th scope="col" colspan="3">Descrição</th>
                        <th scope="col" colspan="3">Área do Conhecimento</th>
                        <th scope="col" colspan="3">Professor</th>
                        <th scope="col" colspan="3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaEletivas as $eletiva) { ?>
                        <tr>
                            <td scope="row" colspan="3"> <?php echo $eletiva["idEletiva"]; ?></td>
                            <td colspan="3"> <?php echo $eletiva["nome"]; ?></td>
                            <td colspan="3"> <?php echo $eletiva["descricao"]; ?></td>
                            <td colspan="3"> <?php echo $eletiva["areaConhecimento"]; ?></td>
                            <td colspan="3"> <?php echo $eletiva["usuario"]; ?></td>
                            <td colspan="3">
                                <?php echo "<a class='acoes atualizar' href='/eletiva/atualizar?id=" .  $eletiva["idEletiva"] . "'>Atualizar</a>"; ?>
                                <?php echo "<a class='acoes excluir' href='/eletiva/delete?id=" . $eletiva["idEletiva"] . "'>Excluir</a>"; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
<script src="/librares/js/script.js"></script>
</html>
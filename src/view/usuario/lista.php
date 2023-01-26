<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="/librares/css/reset.css">
    <link rel="stylesheet" href="/librares/css/styles_navbar.css">
    <link rel="stylesheet" href="/librares/css/styles_tabelas.css">
    <title>ETEletivas</title>
</head>
<?php require __DIR__ . "/../share/head.php"; ?>
<body>
    <main>
        <div class="alinhar">
            <h1>Lista de Usuarios</h1>
            <form action="/usuario/search" method="GET">
                <div>
                    <input type="search" placeholder="Pesquisa" id="search" name="search">
                    <button type="submit" style="width: 50px; heigth:150px;">
                    </button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th scope="col" colspan="3">Id</th>
                        <th scope="col" colspan="3">Login</th>
                        <th scope="col" colspan="3">Nivel</th>
                        <th scope="col" colspan="3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaUsuarios as $usuario) { ?>
                        <tr>
                            <td scope="row" colspan="3"> <?php echo $usuario->getId(); ?></td>
                            <td colspan="3"> <?php echo $usuario->getLogin(); ?></td>
                            <td colspan="3"> <?php echo $usuario->getNivel(); ?></td>
                            <td colspan="3">
                                <?php echo "<a class='acoes atualizar' href='/usuario/atualizar?id=" .  $usuario->getId() . "'>Atualizar</a>"; ?>
                                <?php echo "<a class='acoes excluir' href='/usuario/delete?id=" . $usuario->getId() . "'>Excluir</a>"; ?>
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
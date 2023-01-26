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
            <h1>Lista de Alunos</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col" colspan="3">ID</th>
                        <th scope="col" colspan="3">Nome</th>
                        <th scope="col" colspan="3">Eletiva</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaAlunos as $aluno) { ?>
                        <tr>
                            <td scope="row" colspan="3"> <?php echo $aluno["idAluno"]; ?></td>
                            <td colspan="3"> <?php echo $aluno["usuario"]; ?></td>
                            <td colspan="3"> <?php echo $aluno["nome"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
<script src="/librares/js/script.js"></script>
</html>
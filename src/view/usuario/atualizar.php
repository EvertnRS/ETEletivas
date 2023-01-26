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

<?php require __DIR__ . "/../share/head.php"; ?>

<body>
    <main>
        <h1>Tela de Cadastro de Usuario</h1>
        
        <form class="form" action="/usuario/update?id=<?php echo $usuario->getId() ?>" method="post">
            <div>
                <label for="login">Login:</label>
                <input type="text" name="login" id="login" value="<?php echo $usuario->getLogin(); ?>">
            </div>
            <div>
                <label for="password">Nova senha:</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <label for="matricula">Número de Matrícula</label>
                <input type="text" name="matricula" id="matricula" value="<?php echo $usuario->getMatricula(); ?>">
            </div>
            <select name="nivel" id="nivel">
                <option value="adm">ADM</option>
                <option value="nivel2">Professor</option>
                <option value="nivel1">Aluno</option>
            </select>
            <button type="submit">Atualizar</button>
        </form>
    </main>
</body>
</html>
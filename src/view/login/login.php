<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/librares/css/reset.css">
    <link rel="stylesheet" href="/librares/css/styles_login.css">
    <title>ETEletivas</title>
</head>

<body>
    <main>
        <form action="/login/logar" method="POST">
            <h1>ETEletivas</h1>
            <div>
                <input type="text" id="login" name="login">
                <label for="login">Login</label>
            </div>
            <div>
                <input type="password" id="password" name="password">
                <label for="password">Senha</label>
            </div>
            <button type="submit">Logar</button>
            <p>© ETE - MFL 2022</p>
        </form>
    </main>
</body>
<script src="/librares/js/script.js"></script>
</html>
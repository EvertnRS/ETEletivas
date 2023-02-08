<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/librares/css/reset.css">
    <link rel="stylesheet" href="/librares/css/styles_navbar.css">
    <link rel="stylesheet" href="/librares/css/styles_mainpage.css">
    <title>ETEletivas</title>
</head>

<body>
    <header>
        <div class="cabecalho">
            <h1 class="titulo">Eletivas</h1>
            <div>
                <div class="usuario" onclick="sair()">
                    <?php if ($_SESSION["credential"] == "nivel1") { ?>
                        <img src="/images/usuario-aluno.jpg" alt="mdo">
                    <?php } ?>
                    <?php if ($_SESSION["credential"] == "nivel2") { ?>
                        <img src="/images/usuario-professor.jpg" alt="mdo">
                    <?php } ?>
                    <?php echo $_SESSION["usuario"]; ?>
                </div>
                <div class="sair">
                    <ul>
                        <li><a href="/login/deslog" class="link">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <main class="corpo">
        <h2 class="bem_vindo">Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h2>
        <div class="content">
            <?php if ($_SESSION["credential"] == "nivel1" && $_SESSION["eletiva"] == null) { ?>
                <a href="/eletiva/escolher" class="link">
                    <div class="item">
                        <p>Entrar na Eletiva</p>
                    </div>
                </a>
            <?php } ?>
            <?php if ($_SESSION["credential"] == "nivel2") { ?>
                <a href="/eletiva/alunos" class="link">
                    <div class="item">
                        <p>Lista de Alunos</p>
                    </div>
                </a>
            <?php } ?>
            <?php if ($_SESSION["credential"] == "adm") { ?>
                <a href="/usuario/cadastro" class="link">
                    <div class="item">
                        <p>Cadastrar Usuários</p>
                    </div>
                </a>
                <a href="/eletiva/cadastro" class="link">
                    <div class="item">
                        <p>Cadastrar Eletiva</p>
                    </div>
                </a>
                <a href="/usuario/lista" class="link">
                    <div class="item">
                        <p>Lista de Usuários</p>
                    </div>
                </a>
                <a href="/eletiva/lista" class="link">
                    <div class="item">
                        <p>Lista de Eletivas</p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </main>
</body>
<script src="/librares/js/script.js"></script>

</html>
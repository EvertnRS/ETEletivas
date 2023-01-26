<header>
        <nav>
            <div class="cabecalho">
                <a href="/main_page" class="link">
                    <h1 class="titulo">ETEletivas</h1>
                </a>
                <div>
                    <button class="btn" onclick="usuario_aparecer()">usuario</button>
                    <div class="lista_usuario">
                        <ul>
                            <?php if ($_SESSION["credential"] != "nivel1") { ?>
                            <li><a href="/usuario/lista"  class="link">Lista</a></li>
                            <?php } ?>
                            <?php if ($_SESSION["credential"] == "adm") { ?>
                            <li><a href="/usuario/cadastro" class="link">Cadastrar</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div>
                    <button class="btn" onclick="eletiva_aparecer()">eletivas</button>
                    <div class="lista_eletiva">
                        <ul>
                            <?php if ($_SESSION["credential"] != "nivel1") { ?>
                            <li><a href="/eletiva/lista"  class="link">Lista</a></li>
                            <?php } ?>
                            <?php if ($_SESSION["credential"] == "adm") { ?>
                            <li><a href="/eletiva/cadastro" class="link">Cadastrar</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
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
        </nav>
    </header>
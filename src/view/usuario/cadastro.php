<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/librares/css/reset.css">
    <link rel="stylesheet" href="/librares/css/styles_cadastro.css">
    <title>ETEletivas</title>
</head>

<body>
    <main>
        <h1>Tela de Cadastro de Usuário</h1>

        <?php 
            if(isset($_POST['acao'])){
                $arquivo = $_FILES['file'];

                $arquivoNovo = explode('.',$arquivo['name']);

                if($arquivoNovo[sizeof($arquivoNovo)-1] != 'pdf'){
                    die("Você não pode fazer upload deste tipo de arquivo");
                } else {
                    move_uploaded_file($arquivo['tmp_name'], 'public/uploads/'.$arquivo['name']);
                }
            }
        ?>
        
        <form class="form" action="/usuario/add" method="post">
            <div>
                <input type="text" name="login" id="login">
                <label for="login">Nome Completo</label>
            </div>
            <div>
                <input type="password" name="password" id="password">
                <label for="password">Senha</label>
            </div>
            <div>
                <input type="text" name="matricula" id="matricula">
                <label for="matricula">Número de Matricula</label>
            </div>
        
            <select name="nivel" id="nivel">
                <option value="nivel" selected disabled>Nível</option>
                <!-- <option value="adm">ADM</option> -->
                <option value="nivel2">Professor</option>
                <option value="nivel1">Aluno</option>
            </select>
            <button type="submit">Cadastrar</button>

        </form>
    </main>
</body>
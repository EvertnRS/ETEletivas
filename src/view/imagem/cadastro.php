<?php require __DIR__ . "/../share/head.php"; ?>

<form enctype="multipart/form-data" action="/imagem/add" method="post">
    <input type="file" name="foto" id="foto">
    <button type="submit">Cadastrar imagem</button>
</form>

<?php require __DIR__ . "/../share/footer.php"; ?>
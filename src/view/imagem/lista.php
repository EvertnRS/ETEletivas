<?php require __DIR__ . "/../share/head.php"; ?>

<h1>Lista de Imagens</h1>
<br>
<table class="table text-aling center">
    <thead>
        <tr>
            <th scope="col" colspan="3">Id</th>
            <th scope="col" colspan="3">Nome</th>
            <th scope="col" colspan="3">Tipo</th>
            <th scope="col" colspan="3">Imagem</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach ($listaImagens as $imagem) { ?>
            <tr>
                <td scope="row" colspan="3"> <?php echo $imagem->id; ?></td>
                <td colspan="3"> <?php echo $imagem->nome; ?></td>
                <td colspan="3"> <?php echo $imagem->tipo; ?></td>
                <td colspan="3">
                    <img src="data:<?php echo $imagem->tipo; ?>;base64,<?php echo base64_encode($imagem->binario); ?>" alt="<?php echo $imagem->nome ?>" height="100" width="100">
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php require __DIR__ . "/../share/footer.php"; ?>
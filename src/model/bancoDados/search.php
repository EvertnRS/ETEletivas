<?php

namespace My_Web_Struct\model\bancoDados;

use My_Web_Struct\model\bancoDados\Conexao;

function search($query){
    $conn = mysqli_connect("root", "username", "password", "database");
    $result = mysqli_query($conn, "SELECT * FROM tabela WHERE campo LIKE '%$query%'");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

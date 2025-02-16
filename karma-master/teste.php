<?php

include 'connect.php';
// Valores de exemplo
$id_user = 4;
$endereco = "Rua Principal, 123";
$morada = "Apartamento 4B";
$outras_info = "Próximo ao supermercado";
$pais = "Portugal";
$cod_post = "1234-567";
$cidade = "Lisboa";

// Query de inserção
$query_insert_morada = "INSERT INTO morada (id_user, endereco, morada, outras_info, pais, cod_post, cidade) 
    VALUES ($id_user, '$endereco', '$morada', '$outras_info', '$pais', '$cod_post', '$cidade')";

// Executar a query
if (mysqli_query($cn, $query_insert_morada)) {
    echo "Dados inseridos com sucesso!";
} else {
    echo "Erro ao inserir dados: " . mysqli_error($cn);
}
?>
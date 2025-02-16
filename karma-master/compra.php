<?php
include 'connect.php';
session_start();

$id_user = $_SESSION['id_utilizador'];
$morada = $_POST['id_morada'];

$sql_morada = "SELECT * FROM morada WHERE id_morada = '$morada' AND id_user = '$id_user'";
$resultado_morada = mysqli_query($cn, $sql_morada);
$row_morada = mysqli_fetch_array($resultado_morada);
$nome = $row_morada['morada'];
$endereco = $row_morada['endereco'];
$info = $row_morada['outras_info'];
$pais = $row_morada['pais'];
$cidade = $row_morada['cidade'];
$cod_postal = $row_morada['cod_post'];

$total = 10;
$sub_total = 0;

$sql_carrinho = "SELECT * FROM carrinho WHERE id_user = '$id_user'";
$resultado_carrinho = mysqli_query($cn, $sql_carrinho);
while ($row = mysqli_fetch_array($resultado_carrinho)) {
    $id_produto = $row['id_prod'];
    $quantidade = $row['qtd_cart'];

    $sql_produto = "SELECT preco_uni FROM produto WHERE id_prod = '$id_produto'";
    $resultado_produto = mysqli_query($cn, $sql_produto);
    $row_produto = mysqli_fetch_array($resultado_produto);
    $preco = $row_produto['preco_uni'];

    $total += $preco * $quantidade;
}

$iva = $total * 0.23;
$sub_total = $total + $iva;

$sql_venda = "INSERT INTO venda (id_user, total) VALUES ('$id_user', '$sub_total')";
$resultado_venda = mysqli_query($cn, $sql_venda);

$id_venda = mysqli_insert_id($cn);

$sql_carrinho = "SELECT * FROM carrinho WHERE id_user = '$id_user'";
$resultado_carrinho = mysqli_query($cn, $sql_carrinho);
while ($row = mysqli_fetch_array($resultado_carrinho)) {
    $id_produto = $row['id_prod'];
    $quantidade = $row['qtd_cart'];

    $sql_update_stock = "UPDATE produto SET stock = stock - $quantidade WHERE id_prod = '$id_produto'";
    mysqli_query($cn, $sql_update_stock);


    $sql_produto = "SELECT preco_uni FROM produto WHERE id_prod = '$id_produto'";
    $resultado_produto = mysqli_query($cn, $sql_produto);
    $row_produto = mysqli_fetch_array($resultado_produto);
    $preco_venda = $row_produto['preco_uni'];

    $sql_detalhe = "INSERT INTO detalhe_venda (id_venda, id_prod, quantidade, preco_venda, nome_morada, endereco, outras_info, pais, cod_post, cidade) 
                    VALUES ('$id_venda', '$id_produto', '$quantidade', '$preco_venda', '$nome', '$endereco', '$info', '$pais', '$cod_postal', '$cidade')";
    mysqli_query($cn, $sql_detalhe);
    
}

$sql_limpar_carrinho = "DELETE FROM carrinho WHERE id_user = '$id_user'";
mysqli_query($cn, $sql_limpar_carrinho);

header('Location: confirmation.php?id_venda=' . $id_venda);
exit();
?>
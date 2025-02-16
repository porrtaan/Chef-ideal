<?php
include 'connect.php';

$id_categoria = $_GET['id'];

$check_associacoes = "SELECT * FROM Produto_Categoria WHERE id_categoria = '$id_categoria'";
$result = mysqli_query($cn, $check_associacoes);
if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Não é possível eliminar a categoria, pois existem produtos associados à mesma!'); window.location='listar_categorias.php';</script>";
    exit();
}

// Apagar todas as associações na tabela Produto_Categoria
$apagar_associacoes = "DELETE FROM Produto_Categoria WHERE id_categoria = '$id_categoria'";
mysqli_query($cn, $apagar_associacoes);

// Apagar a categoria
$apagar_categoria = "DELETE FROM Categoria WHERE id_categoria = '$id_categoria'";
if (mysqli_query($cn, $apagar_categoria)) {
    echo "<script>alert('Categoria eliminada com sucesso!'); window.location='listar_categorias.php';</script>";
} else {
    echo "<script>alert('Erro ao eliminar a categoria!'); window.location='listar_categorias.php';</script>";
}

?>
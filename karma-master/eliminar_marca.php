<?php

include 'connect.php';

$id_marca = $_GET['id'];

$check_associacoes = "SELECT * FROM Produto WHERE id_marca = '$id_marca'";
$result = mysqli_query($cn, $check_associacoes);
if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Não é possível eliminar a marca, pois existem produtos associados à mesma!'); window.location='listar_marca.php';</script>";
    exit();
}


$apagar_marca = "DELETE FROM marca WHERE id_marca = '$id_marca'";
if (mysqli_query($cn, $apagar_marca)) {
    echo "<script>alert('Marca eliminada com sucesso!'); window.location='listar_marca.php';</script>";
} else {
    echo "<script>alert('Erro ao eliminar a marca!'); window.location='listar_marca.php';</script>";
}
?>
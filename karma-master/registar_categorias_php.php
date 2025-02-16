<?php 

include 'connect.php'; 

$nome = $_POST['nome'];
$descricao = $_POST['desc'];

$sql = "INSERT INTO categoria (nome_categoria, descricao) VALUES ('$nome', '$descricao')";
$result = mysqli_query($cn, $sql);

if ($result) {
    echo "<script>alert('Categoria registada com sucesso!');</script>";
    echo "<script>location.href='listar_categorias.php';</script>";
} else {
    echo "<script>alert('Erro ao registar categoria!');</script>";
    echo "<script>location.href='regicateg.php';</script>";
}

?>
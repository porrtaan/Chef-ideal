<?php 

include 'connect.php'; 

$nome = $_POST['nome'];
$descricao = $_POST['desc'];

$sql = "INSERT INTO marca (nome_marca, descricao) VALUES ('$nome', '$descricao')";
$result = mysqli_query($cn, $sql);

if ($result) {
    echo "<script>alert('Marca registada com sucesso!');</script>";
    echo "<script>location.href='listar_marca.php';</script>";
} else {
    echo "<script>alert('Erro ao registar marca!');</script>";
    echo "<script>location.href='introduzir_marca.php';</script>";
}

?>
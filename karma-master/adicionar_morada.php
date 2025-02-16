<?php

include 'connect.php'; // Inclui a conexão com o banco de dados

$nome = $_POST['nome'];
$id_utilizador = $_POST['id_utilizador'];
$check_out = $_POST['check_out'];
$endereco = $_POST['endereco']; 
$outras_info = $_POST['outras'];
$pais = $_POST['pais'];
$cod_post = $_POST['postal'];
$cidade = $_POST['cidade'];
$adicionar = 1;

// Verifica se a morada já existe para o utilizador específico
$check_sql = "SELECT * FROM morada WHERE morada = '$nome' AND id_user = '$id_utilizador'";
$check_result = mysqli_query($cn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // Morada já existe para este utilizador
    echo "<script>alert('Erro: Esta morada já está registrada para este utilizador!');</script>";
    echo "<form id='redirectForm' action='adicionar_morada_formulario.php' method='POST'>
            <input type='hidden' name='adicionar' value='$adicionar'>
            <input type='hidden' name='endereco' value='$endereco'>
            <input type='hidden' name='outras' value='$outras_info'>
            <input type='hidden' name='pais' value='$pais'>
            <input type='hidden' name='postal' value='$cod_post'>
            <input type='hidden' name='cidade' value='$cidade'>
          </form>
          <script>document.getElementById('redirectForm').submit();</script>";
    exit();
}

// Insere a nova morada
$sql = "INSERT INTO morada (id_user, endereco, morada, outras_info, pais, cod_post, cidade) 
        VALUES ('$id_utilizador', '$endereco', '$nome', '$outras_info', '$pais', '$cod_post', '$cidade')";

$result = mysqli_query($cn, $sql); // Executa a query

if ($result && $check_out == 1) {
    echo "<script>alert('Morada adicionada com sucesso!');</script>";
    echo "<script>location.href='checkout.php';</script>";
} elseif ($result) {
    echo "<script>alert('Morada adicionada com sucesso!');</script>";
    echo "<script>location.href='morada.php';</script>";
} else {
    echo "<script>alert('Erro ao adicionar morada!');</script>";
    echo "<script>location.href='adicionar_morada_formulario.php';</script>";
}

?>
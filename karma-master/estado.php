<?php
include 'connect.php';

$id = isset($_GET['id_user']) ? intval($_GET['id_user']) : 0;
$flag = isset($_GET['flag']) ? intval($_GET['flag']) : 0;

if ($id > 0) {
    // Define o estado com base na flag
    $estado = ($flag == 1) ? 'A' : 'D';

    // Usa prepared statements para evitar SQL Injection
    $sql = "UPDATE utilizador SET estado = ? WHERE id_user = ?";
    $stmt = mysqli_prepare($cn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $estado, $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $mensagem = ($flag == 1) ? "O utilizador foi ativado!" : "O utilizador foi desativado!";
            echo "<script>alert('$mensagem');</script>";
            echo "<script>location.href='clients-list.php';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar o utilizador.');</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Erro na preparação da query.');</script>";
    }
} else {
    echo "<script>alert('ID inválido!');</script>";
}

mysqli_close($cn);
?>

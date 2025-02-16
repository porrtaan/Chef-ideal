<?php
    include("connect.php");

    $id_morada = $_GET["id"];

    $sql = "DELETE FROM morada WHERE id_morada = '$id_morada'";
    $resultado = mysqli_query($cn, $sql);

    if ($resultado) {
        echo "<script>alert('Morada eliminada com sucesso!'); window.location = 'morada.php';</script>";
    } else {
        echo "<script>alert('Erro ao eliminar morada!'); window.location = 'morada.php';</script>";
    }
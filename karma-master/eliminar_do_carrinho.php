<?php
session_start();
include("connect.php");

if (isset($_GET['id_prod'])) {
    $id_prod = $_GET['id_prod'];

    if (isset($_SESSION['id_utilizador'])) {
        $id_user = $_SESSION['id_utilizador'];

        $sql_remover = "DELETE FROM carrinho WHERE id_user = $id_user AND id_prod = $id_prod";
        mysqli_query($cn, $sql_remover);

    } else {
        if (isset($_SESSION['carrinho'][$id_prod])) {
            unset($_SESSION['carrinho'][$id_prod]);
        }
    }

    header("Location: carrinho.php");
    exit(); 
} else {
    echo "Produto inválido.";
}
?>
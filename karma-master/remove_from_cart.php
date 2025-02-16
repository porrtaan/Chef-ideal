<?php
session_start();
include 'connect.php';

$id_prod = $_GET['id_prod'];

if (!isset($_SESSION['id_utilizador'])) {
    if (isset($_SESSION['carrinho'][$id_prod])) {
        unset($_SESSION['carrinho'][$id_prod]);
    }
} else {
    $id_user = $_SESSION['id_utilizador'];
    $delete = "DELETE FROM carrinho WHERE id_user = $id_user AND id_prod = $id_prod";
    mysqli_query($cn, $delete);
}

header("Location: cart.php");
exit();
?>
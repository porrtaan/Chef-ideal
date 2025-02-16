<?php
session_start();
include 'connect.php';

$id_prod = $_POST['id_prod'];
$qtd = $_POST['qtd'];

if (!isset($_SESSION['id_utilizador'])) {
    if (isset($_SESSION['carrinho'][$id_prod])) {
        $_SESSION['carrinho'][$id_prod] = $qtd;
    }
} else {
    $id_user = $_SESSION['id_utilizador'];
    $update = "UPDATE carrinho SET qtd_cart = $qtd WHERE id_user = $id_user AND id_prod = $id_prod";
    mysqli_query($cn, $update);
}

echo "Quantity updated successfully!";
?>


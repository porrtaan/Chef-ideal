<?php
session_start();
include 'connect.php'; // Inclui o arquivo de conexão com o banco de dados

// Verifique se o formulário foi submetido via POST ou se os dados foram passados via GET
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_prod'], $_POST['qty'])) {
    $id_prod = intval($_POST['id_prod']); // Sanitiza o ID do produto
    $qty = intval($_POST['qty']); // Sanitiza a quantidade
} elseif (isset($_GET['id_prod'])) {
    $id_prod = intval($_GET['id_prod']);  // Sanitiza o ID do produto vindo via GET
    $qty = 1; // Quantidade padrão para inserção via GET
} else {
    // Se o id_prod ou qty não foi passado, redirecione com uma mensagem de erro
    header("Location: produtos.php?error=missing_product_data");
    exit();
}

// Verifique se a quantidade é válida
if ($qty <= 0) {
    header("Location: produtos.php?error=invalid_quantity");
    exit();
}

// Verifique se o usuário está logado
if (isset($_SESSION['id_utilizador'])) {
    $id_user = $_SESSION['id_utilizador'];

    // Verifique se o produto já está no carrinho do usuário
    $query = "SELECT * FROM carrinho WHERE id_user = $id_user AND id_prod = $id_prod";
    $result = mysqli_query($cn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Se o produto já estiver no carrinho, aumente a quantidade
        $update = "UPDATE carrinho SET qtd_cart = qtd_cart + $qty WHERE id_user = $id_user AND id_prod = $id_prod";
        mysqli_query($cn, $update);
    } else {
        // Se o produto não estiver no carrinho, adicione-o com a quantidade correta
        $insert = "INSERT INTO carrinho (id_user, id_prod, qtd_cart) VALUES ($id_user, $id_prod, $qty)";
        mysqli_query($cn, $insert);
    }
} else {
    // Se o usuário não estiver logado, use a sessão para armazenar o carrinho
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    if (isset($_SESSION['carrinho'][$id_prod])) {
        // Se o produto já estiver no carrinho, aumente a quantidade
        $_SESSION['carrinho'][$id_prod] += $qty;
    } else {
        // Se o produto não estiver no carrinho, adicione-o com a quantidade correta
        $_SESSION['carrinho'][$id_prod] = $qty;
    }
}

// Redirecione de volta para a página de produtos ou para o carrinho
header("Location: category.php"); // Altere para a página desejada
exit();
?>

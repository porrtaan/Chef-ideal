<?php
session_start();
include 'connect.php';

$cart_items = [];

if (isset($_SESSION['id_utilizador'])) {
    $id_user = $_SESSION['id_utilizador'];
    $query = "SELECT p.id_prod, p.nome, p.preco_uni, p.imagem_principal, c.qtd_cart 
              FROM carrinho c 
              JOIN Produto p ON c.id_prod = p.id_prod 
              WHERE c.id_user = $id_user";
    $result = mysqli_query($cn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $cart_items[] = [
            'id_prod' => $row['id_prod'],
            'nome' => $row['nome'],
            'preco' => $row['preco_uni'],
            'qtd' => $row['qtd_cart'],
            'imagem' => $row['imagem_principal']
        ];
    }
} else {
    if (isset($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $id_prod => $qtd) {
            $query = "SELECT * FROM Produto WHERE id_prod = $id_prod";
            $result = mysqli_query($cn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $product = mysqli_fetch_assoc($result);
                $cart_items[] = [
                    'id_prod' => $id_prod,
                    'nome' => $product['nome'],
                    'preco' => $product['preco_uni'],
                    'qtd' => $qtd,
                    'imagem' => $product['imagem_principal']
                ];
            }
        }
    }
}

if (isset($_GET['indisponivel']) && $_GET['indisponivel'] == 1 && isset($_GET['mensagem'])) {
    $messages[] = htmlspecialchars($_GET['mensagem']);
}
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/fav.png">
    <meta name="author" content="CodePixar">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta charset="UTF-8">
    <title>Karma Shop</title>

    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="cart_area">
    <div class="container">
    <?php if (!empty($messages)) : ?>
        <div class="alert alert-warning">
            <ul>
                <?php foreach ($messages as $msg) : ?>
                    <li><?php echo $msg; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Produto</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Total</th>
                            <th scope="col">Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $subtotal = 0;
                        foreach ($cart_items as $item) {
                            $total = $item['preco'] * $item['qtd'];
                            $subtotal += $total;
                            ?>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="uploads/<?php echo $item['imagem']; ?>" alt="" style="width: 200px; height: 150px;">
                                        </div>
                                        <div class="media-body">
                                            <p><?php echo $item['nome']; ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h5>$<?php echo number_format($item['preco'], 2); ?></h5>
                                </td>
                                <td>
                                    <div class="product_count">
                                        <input type="text" name="qty" id="sst<?php echo $item['id_prod']; ?>" maxlength="12" value="<?php echo $item['qtd']; ?>" title="Quantity:" class="input-text qty">
                                        <button onclick="updateQuantity(<?php echo $item['id_prod']; ?>, 1)" class="increase items-count" type="button">
                                            <i class="lnr lnr-chevron-up"></i>
                                        </button>
                                        <button onclick="updateQuantity(<?php echo $item['id_prod']; ?>, -1)" class="reduced items-count" type="button">
                                            <i class="lnr lnr-chevron-down"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <h5>€<?php echo number_format($total, 2); ?></h5>
                                </td>
                                <td>
                                    <a href="remove_from_cart.php?id_prod=<?php echo $item['id_prod']; ?>" class="btn btn-danger">Remover</a>
                                </td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>€<?php echo number_format($subtotal, 2); ?></h5>
                            </td>
                            <td></td>
                        </tr>
                        <tr class="out_button_area">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="loja.php">Continuar a comprar</a>
                                    <a class="primary-btn" href="validar_carrinho.php">Continuar para o checkout</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function updateQuantity(id_prod, change) {
            var qtyInput = document.getElementById('sst' + id_prod);
            var newQty = parseInt(qtyInput.value) + change;
            if (newQty < 1) newQty = 1;
            qtyInput.value = newQty;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send("id_prod=" + id_prod + "&qtd=" + newQty);
        }
    </script>
</body>
</html>
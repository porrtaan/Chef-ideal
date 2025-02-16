

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Karma Shop</title>

    <!--
            CSS
            ============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">

    <style>
        /* Estilo da Tabela de Pedidos */
.order-table {
    width: 100%;
    border-collapse: collapse;
    background-color: #f9fafb;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.order-table th, .order-table td {
    padding: 20px;
    text-align: center;
    font-size: 1rem;
    color: #111827;
    border-bottom: 1px solid #e5e7eb;
}

.order-table th {
    background-color:rgb(233, 233, 233);
    font-weight: 600;
    color:rgb(226, 137, 77);
    text-transform: uppercase;
}

.order-table tbody tr:hover {
    background-color:rgb(255, 239, 224);
    transition: background-color 0.3s ease;
}

/* Estilo das Informações do Produto */
.product-info {
    display: flex;
    align-items: center;
    gap: 15px;
    text-align: left;
}

.product-info img {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    object-fit: cover;
}

.product-info h5 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
    color: #111827;
}

.product-info p {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 4px 0 0;
}

/* Estilo para Preço, Quantidade e Data de Entrega */
.price, .qty, .delivery {
    font-weight: 600;
    font-size: 1rem;
}

.qty {
    color:rgb(122, 117, 113);
}

/* Responsividade */
@media (max-width: 768px) {
    .order-table th, .order-table td {
        padding: 10px;
        font-size: 0.875rem;
    }

    .product-info img {
        width: 50px;
        height: 50px;
    }

    .product-info h5 {
        font-size: 1rem;
    }
}

    </style>

</head>

<body>

    <?php include 'header.php'?> 

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Historico de compras</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Historico de compras</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->

   

    <?php

include 'connect.php';

if (isset($_SESSION['id_utilizador'])) {
    $id_user = $_SESSION['id_utilizador'];

    // Consulta SQL com ORDER BY e verificação de erros
    $sql_vendas = "SELECT * FROM venda WHERE id_user = '$id_user' ORDER BY data_venda DESC";
    $resultado_vendas = mysqli_query($cn, $sql_vendas);

    if (!$resultado_vendas) {
        die("Erro na consulta: " . mysqli_error($cn));
    }

    // Verificação do número de registros retornados
    $quantidade_vendas = mysqli_num_rows($resultado_vendas);
} else {
    die("Usuário não está logado.");
}
?>

<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <h2>Histórico de Compra</h2>
            <p>Total de compras encontradas: <?php echo $quantidade_vendas; ?></p> <!-- Para depuração -->

            <table class="order-table">
                <thead>
                    <tr>
                        <th>ID da Compra</th>
                        <th>Total</th>
                        <th>Data da Venda</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($quantidade_vendas > 0) {
                        while ($row_vendas = mysqli_fetch_assoc($resultado_vendas)) { ?>
                            <tr class="order-row">
                                <td><?php echo $row_vendas['id_venda']; ?></td>
                                <td><?php echo "€ " . number_format($row_vendas['total'], 2, ',', '.'); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row_vendas['data_venda'])); ?></td>
                                <td><a style="color:rgb(122, 117, 113);" href="detalhes_venda.php?id=<?php echo $row_vendas['id_venda']; ?>">Ver Detalhes</a></td>
                            </tr>
                        <?php } 
                    } else { ?>
                        <tr>
                            <td colspan="4">Nenhuma compra encontrada.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>



                                            
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

  <?php include 'footer.php'?>

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
    <script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>
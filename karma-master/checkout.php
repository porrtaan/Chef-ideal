<?php
session_start();
include 'connect.php';

$id = $_SESSION['id_utilizador'];

// Verifica se o $id é nulo
if (empty($id)) {
    echo "<script type='text/javascript'>alert('Utilizador não autenticado! Será levado para o login'); window.location.href = 'login.php';</script>";
}

$sql = "SELECT * from Utilizador where id_user = $id";
$result = mysqli_query($cn, $sql);

$campo = mysqli_fetch_array($result);
?>
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
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

  <?php include 'header.php' ?>

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

   <!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="row">
            <!-- Detalhes do Checkout -->
            <div class="col-lg-8">
                <div class="billing_details">
                    <h3>Detalhes do checkout</h3>
                    <div class="row">
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="first" name="name" value="<?php echo $campo['nome'] ?>" readonly>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="number" value="<?php echo $campo['telefone'] ?>" readonly>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="compemailany" value="<?php echo $campo['email'] ?>" readonly>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="nif" name="compemailany" value="<?php echo $campo['nif'] ?>" readonly>
                        </div>
                        <select class="form-control" id="saved_addresses" name="saved_addresses">
                            <option value="default">Selecione um endereço</option>
                            <?php
                            // Consulta para buscar os endereços do usuário logado
                            $sql_moradas = "SELECT id_morada, endereco, morada, cidade FROM morada WHERE id_user = '" . $campo['id_user'] . "'";
                            $resultado_moradas = mysqli_query($cn, $sql_moradas);

                            // Verifica se existem endereços salvos
                            if (mysqli_num_rows($resultado_moradas) > 0) {
                                while ($linha_moradas = mysqli_fetch_assoc($resultado_moradas)) {
                                    echo '<option value="' . $linha_moradas['id_morada'] . '">' . $linha_moradas['morada'] . '</option>';
                                }
                            }
                            ?>
                            <option value="new">Adicionar novo endereço</option>
                        </select>

                    </div>
                </div>
            </div>

            <!-- Order Box -->
            <div class="col-lg-4">
                <div class="order_box">
                    <h2>Seu pedido</h2>
                    <ul class="list">
                                <li><a href="#">Produto <span>Total</span></a></li>
                        
                        <?php 
                            $subtotal = 0;
                            $iva = 0;
                            $total = 0;
                            $total_prod = 0; 

                          

                            $sql_carrinho = "SELECT * FROM carrinho WHERE id_user = '$id'";
                            $resultado_carrinho = mysqli_query($cn, $sql_carrinho);

                            $sql_produtos = "SELECT * FROM produto where id_prod in (SELECT id_prod FROM carrinho WHERE id_user = '$id')";
                            $resultado_produtos = mysqli_query($cn, $sql_produtos);

                            while ($prod = mysqli_fetch_array($resultado_produtos)) {

                                $sql_qntd = "SELECT qtd_cart FROM carrinho WHERE id_prod = " . $prod['id_prod']; 
                                $qntd_resultado = mysqli_query($cn, $sql_qntd); 

                                $qtd = mysqli_fetch_array($qntd_resultado); 

                                $total_prod = $prod['preco_uni'] * $qtd['qtd_cart'];
                                $subtotal += $total_prod; 

                                $nome_limitado = strlen($prod['nome']) > 15 ? substr($prod['nome'], 0, 15) . '...' : $prod['nome'];

                                echo '<li><a href="single-product.php?id_prod='.$prod['id_prod'].'">'.$nome_limitado.'<span class="middle">x '.$qtd['qtd_cart'].' </span> <span class="last">'.number_format($subtotal, 2).' €</span></a></li>';
                               
                            }
                            $iva = $subtotal * 0.23; 
                            $total = $subtotal + $iva;
                        ?>
                        <br>
                    <ul class="list list_2">
                        <li><a>Subtotal <span><?= number_format($subtotal, 2) ?> €</span></a></li>
                        <li><a>IVA <span><?= number_format($iva, 2) ?> €</span></a></li>
                        <li><a>Total <span><?= number_format($total, 2) ?> €</span></a></li>
                    </ul>

                    <br>
                    <form id="checkoutForm" action="compra.php" method="POST">
                        <input type="hidden" name="id_morada" id="id_morada" value="">
                        <a class="primary-btn" href="#" id="comprarLink">Comprar</a>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

 <?php include 'footer.php' ?>


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

    <script>
    $(document).ready(function () {
        $('#comprarLink').click(function (e) {
            e.preventDefault(); // Impede o comportamento padrão do link
            var selected = $('#saved_addresses').val();

            if (selected === 'default') {
                alert('Selecione um endereço para entrega!');
                return false;
            } else {
                // Define o valor do id_morada no input oculto
                $('#id_morada').val(selected);
                // Envia o formulário via POST
                $('#checkoutForm').submit();
            }
        });

        $('#saved_addresses').change(function () {
            var selected = $(this).val();
            if (selected === 'new') {
                alert('Você será redirecionado para o formulário de adicionar morada.');
                window.location.href = 'adcionar_morada_formulario.php?flag=1';
            }
        });
    });
</script>


</body>

</html>
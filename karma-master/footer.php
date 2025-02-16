<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .footer-area {
            background-color: #222;
            color: #d3d3d3;
            padding: 50px 0;
        }
        .single-footer-widget h6 {
            color: #ffffff;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .single-footer-widget ul {
            list-style: none;
            padding: 0;
        }
        .single-footer-widget ul li {
            margin-bottom: 10px;
        }
        .single-footer-widget ul li a {
            color: #d3d3d3;
            text-decoration: none;
            transition: color 0.3s;
        }
        .single-footer-widget ul li a:hover {
            color: #f1c40f;
        }
        .footer-bottom {
            border-top: 1px solid #444;
            padding-top: 20px;
            text-align: center;
        }
        .footer-social a {
            color: #d3d3d3;
            margin: 0 10px;
            font-size: 18px;
            transition: color 0.3s;
        }
        .footer-social a:hover {
            color: #f1c40f;
        }
    </style>
</head>

<!-- Start Footer Area -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Sobre nós</h6>
                    <p>Chef Ideal - Utensílios de cozinha com qualidade e entrega com segurança.</p>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Loja</h6>
                    <ul>
                        <li><a href="index.php">Início</a></li>
                        <li><a href="loja.php">Loja</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Carrinho</h6>
                    <ul>
                        <li><a href="cart.php">Ver Carrinho</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="single-footer-widget">
                    <h6>Conta</h6>
					<ul class="quicklink">
                        <?php 
                            if(isset($_SESSION['nome'])){
                                echo '<li><a href="detalhe_da_conta.php?id_user='.$_SESSION['id_utilizador'].'">Editar Perfil</a></li>'; 
                                echo '<li><a href="morada.php">Morada</a></li>';
                                echo '<li><a href="historico_compra.php">As Minhas Encomendas</a></li>';
                            }
                            else {
                               echo '<li><a href="pagina_registar.php">Registar</a></li>';
                               echo '<li><a href="pagina_login.php">Login</a></li>';
                            }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
            <p class="footer-text m-0">&copy; 2025. João Machado</p>
            <div class="footer-social mt-3">
                <a href="https://www.instagram.com/chef.ideal/"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->

<?php
include("connect.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Consulta para buscar os últimos produtos adicionados à loja
$sql = "SELECT id_prod, nome, descricao, preco_uni, imagem_principal FROM Produto where estado = 'A' ORDER BY data_insert DESC LIMIT 8";
$resultado = mysqli_query($cn, $sql);

if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($cn));
}

$produtos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

mysqli_close($cn);
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->

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
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

	<style>
		.owl-nav button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
}

.owl-prev {
    left: 10px;
}

.owl-next {
    right: 10px;
}
	</style>

</head>

<body>

	<?php include 'header.php'; ?>
	<!-- start banner Area -->
	<section class="banner-area">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="active-banner-slider owl-carousel">
                    <!-- single-slide -->
                    <div class="row single-slide align-items-center d-flex">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1 style="color: rgb(240, 248, 255);">Chef <br>Ideal</h1>
                                <p style="color: rgb(209, 211, 212);">Seu destino ideal para utensílios de cozinha</p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="uploads/tacho1.png" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- single-slide -->
                    <div class="row single-slide align-items-center d-flex">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1 style="color: rgb(240, 248, 255);">Chef<br>Ideal</h1>
                                <p style="color: rgba(209, 211, 212, 0.918);">Seu destino ideal para utensílios de cozinha.</p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="uploads/frigideira.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
	<!-- End banner Area -->

	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon1.png" alt="">
						</div>
						<h6>Entrega grátis</h6>
						
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon2.png" alt="">
						</div>
						<h6>Troca em caso de dano</h6>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon3.png" alt="">
						</div>
						<h6>Suporte 24 horas</h6>
						
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon4.png" alt="">
						</div>
						<h6>Pagamento seguro
						</h6>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->



	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
	<!-- single product slide -->
<div class="single-product-slider">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Últimos Produtos</h1>
                    <p>Estes são os últimos produtos adicionados à loja.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($produtos as $produto): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" src="uploads/<?= htmlspecialchars($produto['imagem_principal']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>">
                        <div class="product-details">
                            <h6><?= htmlspecialchars($produto['nome']) ?></h6>
                            <div class="price">
                                <h6>€<?= number_format($produto['preco_uni'], 2, ',', '.') ?></h6>
                            </div>
                            <div class="prd-bottom">
                                <a href="single-product.php?id_prod=<?= $produto['id_prod'] ?>" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">Ver Mais</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Disponivel brevemente</h1>
							<p>Estes produtos estarão disponiveis bremente na nossa loja</p>
						</div>
					</div>
				</div>
				<div class="row">
					<p>Nenhum produto encontrado</p>
				</div>
		
	</section>
	<!-- end product Area -->



<?php include 'footer.php'; ?>

	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/countdown.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
	<!-- Adicione o script para inicializar o Owl Carousel com navegação -->
<script>
    $(document).ready(function(){
        $(".active-banner-slider").owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            navText: ["<span class='owl-prev'>‹</span>", "<span class='owl-next'>›</span>"],
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });
    });
</script>
</body>

</html>
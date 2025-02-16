<?php
include 'connect.php';

$id = $_GET['id_prod'];

$sql = "SELECT * FROM Produto WHERE id_prod = $id";
$resultado = mysqli_query($cn, $sql);

$produto = mysqli_fetch_array($resultado); 

$id_prod = $produto['id_prod'];
$nome = $produto['nome'];
$preco = $produto['preco_uni'];
$imagem = $produto['imagem_principal'];
$imagem2 = $produto['imagem_2'];
$imagem3 = $produto['imagem_3'];
$stock = $produto['stock'];
$descricao = $produto['descricao'];

$sql_categoria = "SELECT nome_categoria FROM categoria, produto, produto_categoria 
                  WHERE categoria.id_categoria =  produto_categoria.id_categoria AND produto.id_prod = produto_categoria.id_prod 
                  AND produto.id_prod = $id_prod";
$resultado_categoria = mysqli_query($cn, $sql_categoria);
$categoria_array = array();

$sql_marca = "SELECT nome_marca FROM marca, produto WHERE marca.id_marca = produto.id_marca AND produto.id_prod = $id_prod";
$resultado_marca = mysqli_query($cn, $sql_marca);
$marca = mysqli_fetch_array($resultado_marca);

while ($categoria = mysqli_fetch_array($resultado_categoria)) {
    $categoria_array[] = $categoria['nome_categoria'];
}
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
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="css/main.css">
</head>

<body>

	<?php include 'header.php'; ?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Product Details Page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="single-product.html">product-details</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_Product_carousel">
						<div class="single-prd-item">
							<img class="img-fluid" src="uploads/<?= $imagem ?>" alt="">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="uploads/<?= $imagem2 ?>" alt="">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="uploads/<?= $imagem3 ?>" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3><?= $nome ?></h3>
						<h2>€<?=$preco?></h2>
						<ul class="list">
							<li><a  href="#"><span>Categoria</span>: <?php echo implode(", ", $categoria_array); ?></a></li>
							<li><a href="#"><span>Stock</span>   :<?php if ($produto['stock'] == 0) {
														echo '<td style="color: red; font-weight: bold;">Esgotado</td>';
													} elseif ($produto['stock'] >= 50) {
														echo '<td style="color: green; font-weight: bold;"> Muitas unidades</td>';
													} elseif ($produto['stock'] < 15) {
														echo '<td style="color: #ff6f00; font-weight: bold;"> Poucas unidades</td>';
													} ?></a></li>
							<li><a  href="#"><span>Marca</span>: <?php echo $marca['nome_marca'] ?></a></li>
						</ul>
						<p></p>
						<form action="add_to_cart.php" method="post">
    <div class="product_count">
        <label for="qty">Quantidade:</label>
		<input 
    type="number" 
    name="qty" 
    id="sst" 
    maxlength="12" 
    value="1" 
    title="Quantidade:" 
    class="input-text qty"
    max="<?= $stock ?>" 
    min="1" 
    step="1">

    </div>
    
    <div class="card_area d-flex align-items-center">
        <?php if ($produto['stock'] == 0) : ?>
            <a class="primary-btn" href="category.php">Esgotado</a>
        <?php else : ?>
            <input type="hidden" name="acao" value="adicionar">
            <input type="hidden" name="id_prod" value="<?= $produto['id_prod'] ?>">
            <button type="submit" class="primary-btn">Adicionar ao Carrinho</button>
    </div>
</form>

								<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Descrição</a>
				</li>
				
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p><?= $descricao?></p>
				</div>
	
				
			</div>	
		</div>
	</section>
	<?php include'footer.php'; ?>

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
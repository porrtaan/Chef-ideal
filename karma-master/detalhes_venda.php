<?php
include 'connect.php';
session_start(); 

$id = $_SESSION['id_utilizador'];
$id_venda = $_GET['id'];

// Consulta da venda
$sql_venda = "SELECT * FROM venda WHERE id_user = ?";
$stmt_venda = mysqli_prepare($cn, $sql_venda);
mysqli_stmt_bind_param($stmt_venda, "i", $id);
mysqli_stmt_execute($stmt_venda);
$result_venda = mysqli_stmt_get_result($stmt_venda);
$campo_venda = mysqli_fetch_array($result_venda);

// Consulta dos detalhes da venda
$sql_morada = "SELECT * FROM detalhe_venda WHERE id_venda = ?";
$stmt_morada = mysqli_prepare($cn, $sql_morada);
mysqli_stmt_bind_param($stmt_morada, "i", $id_venda);
mysqli_stmt_execute($stmt_morada);
$result_morada = mysqli_stmt_get_result($stmt_morada);
$campo_detalhe = mysqli_fetch_array($result_morada);

// Consulta do cliente
$sql_cliente = "SELECT * FROM utilizador WHERE id_user = ?";
$stmt_cliente = mysqli_prepare($cn, $sql_cliente);
mysqli_stmt_bind_param($stmt_cliente, "i", $id);
mysqli_stmt_execute($stmt_cliente);
$result_cliente = mysqli_stmt_get_result($stmt_cliente);
$campo_cliente = mysqli_fetch_array($result_cliente);

$total_geral = 0;
$subtotal_geral = 0;
$iva_geral = 0;
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

	<style>
		/* From Uiverse.io by nikk7007 */ 
.button {
 --color:rgb(255, 174, 0);
 padding: 0.8em 1.7em;
 background-color: transparent;
 border-radius: .3em;
 position: relative;
 overflow: hidden;
 cursor: pointer;
 transition: .5s;
 font-weight: 400;
 font-size: 17px;
 border: 1px solid;
 font-family: inherit;
 text-transform: uppercase;
 color: var(--color);
 z-index: 1;
}

.button::before, .button::after {
 content: '';
 display: block;
 width: 50px;
 height: 50px;
 transform: translate(-50%, -50%);
 position: absolute;
 border-radius: 50%;
 z-index: -1;
 background-color: var(--color);
 transition: 1s ease;
}

.button::before {
 top: -1em;
 left: -1em;
}

.button::after {
 left: calc(100% + 1em);
 top: calc(100% + 1em);
}

.button:hover::before, .button:hover::after {
 height: 410px;
 width: 410px;
}

.button:hover {
 color: rgb(10, 25, 30);
}

.button:active {
 filter: brightness(.8);
}

	</style>

</head>

<body>

	<?php include 'header.php' ?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Detalhe da venda</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Detalhe da venda</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Order Details Area =================-->
	<section class="order_details section_gap">
		<div class="container">
			<div class="row order_d_inner">
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Informações do pedido</h4>
						<ul class="list">
							<li><a href="#"><span>Numero da venda</span> : <?=$id_venda?></a></li>
							<li><a href="#"><span>Data</span> : <?= date('d/m/Y', strtotime($campo_venda['data_venda'])) ?></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Informações do cliente</h4>
						<ul class="list">
							<li><a href="#"><span>Nome</span> : <?= $campo_cliente['nome']?></a></li>
							<li><a href="#"><span>NIF</span> : <?= $campo_cliente['nif']?></a></li>
							<li><a href="#"><span>Nº telefone</span> : <?= $campo_cliente['telefone']?></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Endereço</h4>
						<ul class="list">
							<li><a href="#"><span>Endereço</span> : <?=strlen($campo_detalhe['endereco']) > 20 ? substr($campo_detalhe['endereco'], 0, 20) . '...' : $campo_detalhe['endereco']?></a></li>
							<li><a href="#"><span>Cidade</span> : <?=$campo_detalhe['cidade']?></a></li>
							<li><a href="#"><span>País</span> : <?=$campo_detalhe['pais']?></a></li>
							<li><a href="#"><span>Codigo postal </span> : <?=$campo_detalhe['cod_post']?></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="order_details_table">
				<h2>Detalhes do produto</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Produto</th>
								<th scope="col">Quantidade</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
						<?php
                    $sql_detalhes = "SELECT * FROM detalhe_venda WHERE id_venda = ?";
                    $stmt_detalhes = mysqli_prepare($cn, $sql_detalhes);
                    mysqli_stmt_bind_param($stmt_detalhes, "i", $id_venda);
                    mysqli_stmt_execute($stmt_detalhes);
                    $result_detalhes = mysqli_stmt_get_result($stmt_detalhes);

                    while ($detalhe = mysqli_fetch_array($result_detalhes)) {
                        $sql_produto = "SELECT nome FROM produto WHERE id_prod = ?";
                        $stmt_produto = mysqli_prepare($cn, $sql_produto);
                        mysqli_stmt_bind_param($stmt_produto, "i", $detalhe['id_prod']);
                        mysqli_stmt_execute($stmt_produto);
                        $result_produto = mysqli_stmt_get_result($stmt_produto);
                        $produto = mysqli_fetch_array($result_produto);

                        $subtotal = $detalhe['preco_venda'] * $detalhe['quantidade'];
                        $iva = $subtotal * 0.23;
                        $total = $subtotal + $iva;

                        $subtotal_geral += $subtotal;
                        $iva_geral += $iva;
                        $total_geral += $total;
                    ?>
					 <tr>
                            <td><?= htmlspecialchars($produto['nome']) ?></td>
                            <td>X <?= $detalhe['quantidade'] ?></td>
                            <td>€ <?= number_format($total, 2, ',', '.') ?></td>
                        </tr>
                    <?php } ?>
							<tr>
								<td>
									<h4>Subtotal</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>€ <?= number_format($subtotal_geral, 2, ',', '.') ?></p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>IVA</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>€ <?= number_format($iva_geral, 2, ',', '.') ?></p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>Total</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>€ <?= number_format($total_geral, 2, ',', '.') ?></p>
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<a href="pdf.php?id_venda=<?= $id_venda ?>"><button class="button">Download</button></a>
					</div>
			</div>
		</div>
	</section>

	

	
	<!--================End Order Details Area =================-->

	<?php include'footer.php' ?>




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
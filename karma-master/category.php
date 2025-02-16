<?php
include 'connect.php';
$sql_produtos = "SELECT nome FROM produto";
$resultado_produtos = mysqli_query($cn, $sql_produtos);

$nomes_produtos = [];
while ($row = mysqli_fetch_array($resultado_produtos)) {
	$nomes_produtos[] = $row['nome'];
}
?>

<?php
include 'connect.php';

// Valores padrão
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$results_per_page = isset($_GET['limite']) ? intval($_GET['limite']) : 12; // Agora usa "limite"
$offset = ($page - 1) * $results_per_page;

// Filtros recebidos
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$marca = isset($_GET['marca']) ? $_GET['marca'] : '';
$ordem = isset($_GET['ordenacao']) ? $_GET['ordenacao'] : '';

// Consulta para contar total de produtos
$count_sql = "SELECT COUNT(DISTINCT p.id_prod) as total 
              FROM Produto p
              JOIN Produto_Categoria pc ON p.id_prod = pc.id_prod 
              WHERE p.estado = 'A'";

if ($categoria) {
    $count_sql .= " AND pc.id_categoria = '$categoria'";
}

if ($marca) {
    $count_sql .= " AND p.id_marca = '$marca'";
}

$count_result = mysqli_query($cn, $count_sql);
$total_products = mysqli_fetch_assoc($count_result)['total'];

// Calcular total de páginas
$total_pages = ceil($total_products / $results_per_page);

// Certificar que a página está dentro do intervalo válido
$page = max(1, min($page, $total_pages));

// Consulta principal
$sql = "SELECT DISTINCT p.* 
        FROM Produto p
        JOIN Produto_Categoria pc ON p.id_prod = pc.id_prod 
        WHERE p.estado = 'A'";

if ($categoria) {
    $sql .= " AND pc.id_categoria = '$categoria'";
}

if ($marca) {
    $sql .= " AND p.id_marca = '$marca'";
}

// Ordenação
switch ($ordem) {
    case 'preco_asc':
        $sql .= " ORDER BY p.preco_uni ASC";
        break;
    case 'preco_desc':
        $sql .= " ORDER BY p.preco_uni DESC";
        break;
    case 'recentes':
        $sql .= " ORDER BY p.data_insert DESC";
        break;
    case 'antigos':
        $sql .= " ORDER BY p.data_insert ASC";
        break;
    default:
        $sql .= " ORDER BY p.id_prod ASC"; // Ordem padrão
        break;
}

// Paginação
$sql .= " LIMIT $results_per_page OFFSET $offset";

// Executar consulta
$resultado = mysqli_query($cn, $sql);
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
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
	<style>
    .apply-filters-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 10px;
        transition: background 0.3s ease;
    }

    .apply-filters-btn:hover {
        background-color: #0056b3;
    }
</style>
</head>

<body id="category">

	<?php include'header.php'; ?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Produtos</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.php">Produtos</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-filter mt-50">
					<form action="category.php" method="get">
					<div class="top-filter-head">Filtros</div>
					<div class="common-filter">
        <div class="head">Categoria</div>
		<select name="categoria" class="form-control">
    <option value="">Selecione uma Categoria</option>
    <?php
    $sql = "SELECT * FROM Categoria";
    $resultado = mysqli_query($cn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $selected = ($row['id_categoria'] == $categoria) ? 'selected' : '';
            echo "<option value='" . $row['id_categoria'] . "' $selected>" . $row['nome_categoria'] . "</option>";
        }
    }
    ?>
</select>
    </div>
	<div class="common-filter">
        <div class="head">Marca</div>
        <select name="marca" class="form-control">
    <option value="">Selecione uma Marca</option>
    <?php
    $sql = "SELECT * FROM Marca";
    $resultado = mysqli_query($cn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $selected = ($row['id_marca'] == $marca) ? 'selected' : '';
            echo "<option value='" . $row['id_marca'] . "' $selected>" . $row['nome_marca'] . "</option>";
        }
    }
    ?>
</select>

    </div>
	<div class="common-filter">
        <div class="head">Ordenação</div>
        <select name="ordenacao" class="form-control">
    <option value="0" <?= $ordem == '' ? 'selected' : '' ?>>Sem ordem</option>
    <option value="preco_asc" <?= $ordem == 'preco_asc' ? 'selected' : '' ?>>Preço: Baixo-Alto</option>
    <option value="preco_desc" <?= $ordem == 'preco_desc' ? 'selected' : '' ?>>Preço: Alto-Baixo</option>
    <option value="recentes" <?= $ordem == 'recentes' ? 'selected' : '' ?>>Mais Recentes</option>
    <option value="antigos" <?= $ordem == 'antigos' ? 'selected' : '' ?>>Mais Antigos</option>
</select>

    </div>
	<div class="common-filter">
        <div class="head">Itens por Página</div>
        <select name="limite" class="form-control">
    <option value="12" <?= $results_per_page == 12 ? 'selected' : '' ?>>Mostrar 12</option>
    <option value="8" <?= $results_per_page == 8 ? 'selected' : '' ?>>Mostrar 8</option>
    <option value="4" <?= $results_per_page == 4 ? 'selected' : '' ?>>Mostrar 4</option>
</select>
    </div>

	<div class="common-filter">
        <div class="price-range-area">
            <div class="value-wrapper d-flex">
                <button class="apply-filters-btn" type="submit">Aplicar Filtros</button>
            </div>
        </div>
    </div>
</form>
				</div>
			</div>


			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					
					
					<div class="pagination">
					<?php
						// Links de paginação
						for ($i = 1; $i <= $total_pages; $i++) {
							$active = ($i == $page) ? 'active' : '';
							echo "<a class='$active' href='?page=$i&limite=$results_per_page&categoria=$categoria&marca=$marca&ordenacao=$ordem'>$i</a>";
						}
					?>
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
                <?php
include 'connect.php';

// Valores padrão
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$results_per_page = isset($_GET['limite']) ? intval($_GET['limite']) : 12;
$offset = ($page - 1) * $results_per_page;
$pesquisa = isset($_GET['pesquisa']) ? mysqli_real_escape_string($cn, $_GET['pesquisa']) : null;
$categoria = isset($_GET['categoria']) ? mysqli_real_escape_string($cn, $_GET['categoria']) : '';
$marca = isset($_GET['marca']) ? mysqli_real_escape_string($cn, $_GET['marca']) : '';
$ordem = isset($_GET['ordenacao']) ? $_GET['ordenacao'] : '';

// Consulta para contar total de produtos
$count_sql = "SELECT COUNT(DISTINCT p.id_prod) as total 
              FROM Produto p
              JOIN Produto_Categoria pc ON p.id_prod = pc.id_prod 
              WHERE p.estado = 'A'";

if ($pesquisa) {
    $count_sql .= " AND (p.nome LIKE '%$pesquisa%' OR p.descricao LIKE '%$pesquisa%' 
        OR p.id_marca IN (SELECT id_marca FROM Marca WHERE nome_marca LIKE '%$pesquisa%') 
        OR p.id_prod IN (SELECT id_prod FROM Produto_Categoria 
            WHERE id_categoria IN (SELECT id_categoria FROM Categoria 
            WHERE nome_categoria LIKE '%$pesquisa%')))";
}

if ($categoria) {
    $count_sql .= " AND pc.id_categoria = '$categoria'";
}

if ($marca) {
    $count_sql .= " AND p.id_marca = '$marca'";
}

// Executar a consulta de contagem
$count_result = mysqli_query($cn, $count_sql);
if (!$count_result) {
    die("Erro na consulta de contagem: " . mysqli_error($cn));
}

$total_products = mysqli_fetch_assoc($count_result)['total'];
$total_pages = max(1, ceil($total_products / $results_per_page));
$page = max(1, min($page, $total_pages));

// Consulta principal
$sql = "SELECT DISTINCT p.* 
        FROM Produto p
        JOIN Produto_Categoria pc ON p.id_prod = pc.id_prod 
        WHERE p.estado = 'A'";

if ($categoria) {
    $sql .= " AND pc.id_categoria = '$categoria'";
}

if ($marca) {
    $sql .= " AND p.id_marca = '$marca'";
}

if ($pesquisa) {
    $sql .= " AND (p.nome LIKE '%$pesquisa%' OR p.descricao LIKE '%$pesquisa%' 
        OR p.id_marca IN (SELECT id_marca FROM Marca WHERE nome_marca LIKE '%$pesquisa%') 
        OR p.id_prod IN (SELECT id_prod FROM Produto_Categoria 
            WHERE id_categoria IN (SELECT id_categoria FROM Categoria 
            WHERE nome_categoria LIKE '%$pesquisa%')))";
}

// Ordenação
switch ($ordem) {
    case 'preco_asc':
        $sql .= " ORDER BY p.preco_uni ASC";
        break;
    case 'preco_desc':
        $sql .= " ORDER BY p.preco_uni DESC";
        break;
    case 'recentes':
        $sql .= " ORDER BY p.data_insert DESC";
        break;
    case 'antigos':
        $sql .= " ORDER BY p.data_insert ASC";
        break;
    default:
        $sql .= " ORDER BY p.id_prod ASC";
        break;
}

// Paginação
$sql .= " LIMIT $results_per_page OFFSET $offset";

// Executar consulta principal
$resultado = mysqli_query($cn, $sql);
if (!$resultado) {
    die("Erro na consulta principal: " . mysqli_error($cn));
}
?>

<section class="lattest-product-area pb-40 category-list">
    <div class="row">
        <?php
        if (mysqli_num_rows($resultado) > 0) {
            while ($produto = mysqli_fetch_array($resultado)) {
                $id_prod = $produto['id_prod'];
                $nome = $produto['nome'];
                $preco = $produto['preco_uni'];
                $imagem = $produto['imagem_principal'];

                echo '<div class="col-lg-4 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="uploads/' . htmlspecialchars($imagem) . '" alt="">
                            <div class="product-details">
                                <h6>' . htmlspecialchars($nome) . '</h6>
                                <div class="price">
                                    <h6>' . htmlspecialchars($preco) . '€</h6>
                                </div>
                                <div class="prd-bottom">
                                    <a href="add_to_cart.php?id_prod=' . $id_prod . '" class="social-info">
                                        <span class="ti-bag"></span>
                                        <p class="hover-text">carrinho</p>
                                    </a>

                                    <a href="single-product.php?id_prod=' . $id_prod . '" class="social-info">
                                        <span class="lnr lnr-move"></span>
                                        <p class="hover-text">ver mais</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';
            }
        } else {
            echo '<div class="col-12">
                    <h4 class="text-center">Nenhum produto encontrado.</h4>
                  </div>';
        }
        ?>
    </div>
</section>


				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="pagination">
					<?php
						// Links de paginação
						for ($i = 1; $i <= $total_pages; $i++) {
							$active = ($i == $page) ? 'active' : '';
							echo "<a class='$active' href='?page=$i&limite=$results_per_page&categoria=$categoria&marca=$marca&ordenacao=$ordem'>$i</a>";
						}
					?>
					</div>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>

<br><br>	
 

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
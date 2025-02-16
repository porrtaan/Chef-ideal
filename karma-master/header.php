<?php
include 'connect.php';
$sql_produtos = "SELECT nome FROM produto";
$resultado_produtos = mysqli_query($cn, $sql_produtos);

$nomes_produtos = [];
while ($row = mysqli_fetch_array($resultado_produtos)) {
	$nomes_produtos[] = $row['nome'];
}

$sql_marcas = "SELECT nome_marca from marca"; 
$resultado_marcas = mysqli_query($cn,$sql_marcas); 

while($row = mysqli_fetch_array($resultado_marcas)){
    $nomes_produtos[] = $row['nome_marca'];

}

$sql_categorias = "SELECT nome_categoria from categoria"; 
$resultado_categorias = mysqli_query($cn,$sql_categorias);

while($row = mysqli_fetch_array($resultado_categorias)){
    $nomes_produtos[] = $row['nome_categoria'];

}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<head>
	<style>
			.autocomplete {
				position: relative;
				display: inline-block;
				width: 100%;
			}

			.autocomplete-items {
				position: absolute;
				border: 1px solid #d4d4d4;
				border-bottom: none;
				border-top: none;
				z-index: 99;
				top: 100%;
				left: 0;
				right: 0;
			}

			.autocomplete-items div {
				padding: 10px;
				cursor: pointer;
				background-color: #fff;
				border-bottom: 1px solid #d4d4d4;
				text-align: left; /* Alinha o texto à esquerda */
			}

			.autocomplete-items div:hover {
				background-color: #e9e9e9;
			}

			.autocomplete-active {
				background-color: DodgerBlue !important;
				color: #ffffff;
			}

		</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <a class="navbar-brand logo_h" href="index.php"><img src="img/logoofc (1).png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.php">Início</a></li>
                        <li class="nav-item"><a class="nav-link" href="loja.php">Loja</a></li>
                        <li class="nav-item submenu dropdown">
                            <a href="category.php" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                aria-expanded="false">Categorias</a>
                            <ul class="dropdown-menu">
                            <?php 
                                include("connect.php");
                                
                                $sql = "SELECT * FROM Categoria";
                                $resultado = mysqli_query($cn, $sql);

                                if (mysqli_num_rows($resultado) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultado)) {
                                        echo "<li class='nav-item'><a class='nav-link' style='color:black !important;' href='category.php?categoria=".$row['id_categoria']."'>".$row['nome_categoria']."</a></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a href="cart.php" class="cart"><span class="ti-bag"></span></a></li>
                        <li class="nav-item">
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <?php if (isset($_SESSION['nome'])): ?>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" style='color:black !important;' href="detalhe_da_conta.php">Detalhes da Conta</a></li>
                                    <li class="nav-item"><a class="nav-link" style='color:black !important;'href="morada.php">Morada</a></li>
                                    <li class="nav-item"><a class="nav-link" style='color:black !important;'href="historico_compra.php">Historico de compras</a></li>
                                    <li class="nav-item"><a class="nav-link" style='color:black !important;'href="logout.php">Log-out</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
							<li class="nav-item"><a class="nav-link" href="login.php"><i class="fa-solid fa-user"></i></a></li>
							<?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
		</div>
			<div class="search_input" id="search_input_box">
				<div class="container">
					<form class="d-flex justify-content-between" autocomplete="off" method="get" action="category.php" id="filtros" >
						<input type="text" class="form-control" placeholder="Pesquisa..." name="pesquisa" id="pesquisa" value="<?php echo isset($_GET['pesquisa']) ? $_GET['pesquisa'] : ''; ?>">
						<button type="submit" class="btn"></button>
						<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
					</form>
				</div>
			</div>
	</header>
	<!-- End Header Area -->

	<script>
    function autocomplete(inp, arr) {
    let currentFocus;
    inp.addEventListener("input", function () {
        let a, b, i, val = this.value;
        closeAllLists();
        if (!val) return false;
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);
        for (i = 0; i < arr.length; i++) {
            if (arr[i].toUpperCase().indexOf(val.toUpperCase()) !== -1) {
                b = document.createElement("DIV");
                let match = arr[i].toUpperCase().indexOf(val.toUpperCase());
                let before = arr[i].substr(0, match);
                let highlighted = arr[i].substr(match, val.length);
                let after = arr[i].substr(match + val.length);

                b.innerHTML = before + "<strong>" + highlighted + "</strong>" + after;
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function () {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                    document.getElementById('filtros').submit();
                });
                a.appendChild(b);
            }
        }
    });

    inp.addEventListener("keydown", function (e) {
        let x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
        } else if (e.keyCode == 38) {
            currentFocus--;
            addActive(x);
        } else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        if (!x) return false;
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        for (let i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        const x = document.getElementsByClassName("autocomplete-items");
        for (let i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

const products = <?php echo json_encode($nomes_produtos); ?>;
autocomplete(document.getElementById("pesquisa"), products);
</script>

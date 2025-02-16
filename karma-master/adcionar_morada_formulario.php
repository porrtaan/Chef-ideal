<?php
include("connect.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está autenticado
if (!isset($_SESSION['id_utilizador'])) {
    die("Acesso negado. Faça login primeiro.");
}

$id_utilizador = $_SESSION['id_utilizador'];
$flag = isset($_GET['flag']) ? $_GET['flag'] : 0;

// Verifica se o formulário está em modo de adição
$adicionar = isset($_POST['adicionar']) ? $_POST['adicionar'] : 0;
$endereco = isset($_POST['edereco']) ? $_POST['edereco'] : '';
$outras_info = isset($_POST['outras']) ? $_POST['outras'] : '';
$pais = isset($_POST['pais']) ? $_POST['pais'] : '';
$cod_post = isset($_POST['postal']) ? $_POST['postal'] : '';
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
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
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">


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
        body {
            background-color:rgb(179, 174, 170);
        }
        
    </style>
    <style>
       .btn-submit {
        background-color: orange;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
    }
    .btn-submit:hover {
        background-color: darkorange;
    }
 

</style>
</head>

<body>

   <?php include 'header.php'; ?>

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="">Utilizador<span class="lnr lnr-arrow-right"></span></a>
                        <a href="detalhe_da_conta.php">Editar utilizador</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Adiocionar morada</h3>
                    <form class="row contact_form" action="adicionar_morada.php" method="post" novalidate="novalidate" onsubmit="return validar_morada()">
    <input type="hidden" name="check_out" value="<?php echo $flag; ?>">
    <input type="hidden" name="id_utilizador" value="<?php echo $id_utilizador; ?>">
    <input type="hidden" name="adicionar" value="<?php echo $adicionar; ?>">

    <!-- Nome -->
    <div class="col-md-12 form-group">
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
        <span id="error_nome" class="text-danger"></span>
        <?php if ($adicionar == 1): ?>
            <div class="error-message" style="color:rgb(161, 132, 88);">O nome precisa ser diferente.</div>
        <?php endif; ?>
    </div>

    <!-- Endereço -->
    <div class="col-md-12 form-group">
        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" value="<?php echo $adicionar == 1 ? htmlspecialchars($endereco) : ''; ?>">
        <span id="error_endereco" class="text-danger"></span>
    </div>

    <!-- Outras Informações -->
    <div class="col-md-6 form-group p_star">
        <input type="text" class="form-control" id="outras" name="outras" placeholder="Outras informações" value="<?php echo $adicionar == 1 ? htmlspecialchars($outras_info) : ''; ?>">
        <span id="error_outras" class="text-danger"></span>
    </div>

    <!-- País -->
    <div class="col-md-6 form-group p_star">
        <input type="text" class="form-control" id="pais" name="pais" placeholder="Digite o nome do país" value="<?php echo $adicionar == 1 ? htmlspecialchars($pais) : ''; ?>">
        <span id="error_pais" class="text-danger"></span>
    </div>

    <!-- Código Postal -->
    <div class="col-md-6 form-group p_star">
        <input type="text" class="form-control" id="postal" name="postal" placeholder="Cod_postal" value="<?php echo $adicionar == 1 ? htmlspecialchars($cod_post) : ''; ?>">
        <span id="error_postal" class="text-danger"></span>
    </div>

    <!-- Cidade -->
    <div class="col-md-6 form-group p_star">
        <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?php echo $adicionar == 1 ? htmlspecialchars($cidade) : ''; ?>">
        <span id="error_cidade" class="text-danger"></span>
    </div>

    <!-- Botão de Envio -->
    <div class="col-md-12 form-group text-left">
        <button type="submit" class="btn btn-submit">Adicionar morada</button>
    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

<?php include 'footer.php'; ?>

<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
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
$(document).ready(function() {
    var countries = [
        "Afeganistão", "África do Sul", "Albânia", "Alemanha", "Andorra", "Angola", "Antígua e Barbuda", "Arábia Saudita", "Argélia", "Argentina",
        "Armênia", "Austrália", "Áustria", "Azerbaijão", "Bahamas", "Bangladesh", "Barbados", "Barein", "Bélgica", "Belize",
        "Benim", "Bielorrússia", "Bolívia", "Bósnia e Herzegovina", "Botsuana", "Brasil", "Brunei", "Bulgária", "Burquina Faso", "Burundi",
        "Butão", "Cabo Verde", "Camarões", "Camboja", "Canadá", "Catar", "Cazaquistão", "Chade", "Chile", "China",
        "Chipre", "Colômbia", "Comores", "Congo", "Coreia do Norte", "Coreia do Sul", "Costa do Marfim", "Costa Rica", "Croácia", "Cuba",
        "Dinamarca", "Djibuti", "Dominica", "Egito", "El Salvador", "Emirados Árabes Unidos", "Equador", "Eritreia", "Eslováquia", "Eslovênia",
        "Espanha", "Estados Unidos", "Estônia", "Eswatini", "Etiópia", "Fiji", "Filipinas", "Finlândia", "França", "Gabão",
        "Gâmbia", "Gana", "Geórgia", "Granada", "Grécia", "Guatemala", "Guiana", "Guiné", "Guiné Equatorial", "Guiné-Bissau",
        "Haiti", "Holanda", "Honduras", "Hungria", "Iêmen", "Ilhas Marshall", "Ilhas Salomão", "Índia", "Indonésia", "Irã",
        "Iraque", "Irlanda", "Islândia", "Israel", "Itália", "Jamaica", "Japão", "Jordânia", "Kiribati", "Kuwait",
        "Laos", "Lesoto", "Letônia", "Líbano", "Libéria", "Líbia", "Liechtenstein", "Lituânia", "Luxemburgo", "Madagáscar",
        "Malásia", "Malawi", "Maldivas", "Mali", "Malta", "Marrocos", "Maurícia", "Mauritânia", "México", "Mianmar",
        "Micronésia", "Moçambique", "Moldávia", "Mônaco", "Mongólia", "Montenegro", "Namíbia", "Nauru", "Nepal", "Nicarágua",
        "Níger", "Nigéria", "Noruega", "Nova Zelândia", "Omã", "Palau", "Panamá", "Papua-Nova Guiné", "Paquistão", "Paraguai",
        "Peru", "Polônia", "Portugal", "Quênia", "Quirguistão", "Reino Unido", "República Centro-Africana", "República Dominicana", "República Tcheca", "Romênia",
        "Ruanda", "Rússia", "Samoa", "San Marino", "Santa Lúcia", "São Cristóvão e Névis", "São Tomé e Príncipe", "São Vicente e Granadinas", "Seicheles", "Senegal",
        "Serra Leoa", "Sérvia", "Singapura", "Síria", "Somália", "Sri Lanka", "Sudão", "Sudão do Sul", "Suécia", "Suíça",
        "Suriname", "Tailândia", "Taiwan", "Tajiquistão", "Tanzânia", "Timor-Leste", "Togo", "Tonga", "Trinidad e Tobago", "Tunísia",
        "Turcomenistão", "Turquia", "Tuvalu", "Ucrânia", "Uganda", "Uruguai", "Uzbequistão", "Vanuatu", "Vaticano", "Venezuela",
        "Vietnã", "Zâmbia", "Zimbábue"
    ];

    function normalizarTexto(texto) {
        return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
    }

    $("#pais").autocomplete({
        source: function(request, response) {
            var termo = normalizarTexto(request.term);
            var resultados = countries.filter(function(pais) {
                return normalizarTexto(pais).includes(termo);
            });
            response(resultados);
        },
        select: function(event, ui) {
            $("#pais").val(ui.item.value);
            return false;
        }
    });
});
</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    function validar_morada() {
        var nome = document.getElementById("nome").value.trim();
        var endereco = document.getElementById("endereco").value.trim();
        var outras = document.getElementById("outras").value.trim();
        var pais = document.getElementById("pais").value.trim();
        var postal = document.getElementById("postal").value.trim();
        var cidade = document.getElementById("cidade").value.trim();

        // Limpar mensagens de erro
        document.getElementById("error_nome").innerHTML = "";
        document.getElementById("error_endereco").innerHTML = "";
        document.getElementById("error_outras").innerHTML = "";
        document.getElementById("error_pais").innerHTML = "";
        document.getElementById("error_postal").innerHTML = "";
        document.getElementById("error_cidade").innerHTML = "";

        // Validação do nome
        if (nome === "" || !/^[a-zA-Z\s]+$/.test(nome)) {
            document.getElementById("error_nome").innerHTML = "Introduza um nome válido. O nome não pode ser vazio nem conter números.";
            document.getElementById("nome").focus();
            return false;
        }

        // Validação do endereço
        if (endereco === "") {
            document.getElementById("error_endereco").innerHTML = "Introduza um endereço válido.";
            document.getElementById("endereco").focus();
            return false;
        }

        // Validação do campo "outras informações"
        if (outras === "") {
            document.getElementById("error_outras").innerHTML = "Introduza outras informações.";
            document.getElementById("outras").focus();
            return false;
        }

        // Validação do país
        if (pais === "" || !/^[a-zA-Z\s]+$/.test(pais)) {
            document.getElementById("error_pais").innerHTML = "Introduza um nome de país válido. O país não pode ser vazio nem conter números.";
            document.getElementById("pais").focus();
            return false;
        }

        // Validação do código postal
        if (postal === "" || !/^\d{4}-\d{3}$/.test(postal)) {
            document.getElementById("error_postal").innerHTML = "Introduza um código postal válido no formato 1234-567.";
            document.getElementById("postal").focus();
            return false;
        }

        // Validação da cidade
        if (cidade === "" || !/^[a-zA-Z\s]+$/.test(cidade)) {
            document.getElementById("error_cidade").innerHTML = "Introduza um nome de cidade válido. A cidade não pode ser vazia nem conter números.";
            document.getElementById("cidade").focus();
            return false;
        }

        return true;
    }

</script>
</body>

</html>
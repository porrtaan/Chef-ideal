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

// Uso de prepared statement para evitar SQL Injection
$sql = "SELECT nome, email, telefone, nif, pass FROM Utilizador WHERE id_user = ?";
$stmt = mysqli_prepare($cn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $id_utilizador); // "i" indica que é um número inteiro
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultado)) {
        $nome = $row['nome'];
        $email = $row['email'];
        $telefone = $row['telefone'];
        $nif = $row['nif'];
        $pass = $row['pass'];
    } else {
        die("Usuário não encontrado.");
    }

    mysqli_stmt_close($stmt);
} else {
    die("Erro na preparação da consulta.");
}

// Fecha a conexão se necessário
mysqli_close($cn);
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
                    <h3>Billing Details</h3>
                    <form class="row contact_form" action="update_utilizador.php" method="post" novalidate="novalidate" id="form_editar" onchange="return validar_editar()" onsubmit="return validar_editar()">
                        <input type="hidden" name="id_utilizador" value="<?php echo $id_utilizador; ?>">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?php echo $nome; ?>">
                            <span id="error_nome" class="text-danger"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Numero de telefone" value="<?php echo $telefone; ?>">
                            <span id="error_telefone" class="text-danger"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
                            <span id="error_email" class="text-danger"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF" value="<?php echo $nif; ?>">
                            <span id="error_nif" class="text-danger"></span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" value="<?php echo $pass; ?>">
                            <span id="error_pass" class="text-danger"></span>
                        </div>
                        <div class="col-md-12 form-group text-left">
                            <button type="button" class="btn btn-submit" id="submit_button">Confirmar alterações</button>
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
        $('#telefone').mask('000 000 000');
        $('#nif').mask('000 000 000');
    </script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('submit_button').addEventListener('click', function (event) {
        Swal.fire({
            title: "Tem a certeza?",
            text: "Deseja guardar as alterações?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, atualizar!",
            cancelButtonText: "Não, cancelar!"
        }).then((result) => {
            if (result.isConfirmed) {
                if (validar_editar()) {
                    document.getElementById('form_editar').submit();
                } else {
                    Swal.fire({
                        title: "Erro",
                        text: "Verifique os campos obrigatórios!",
                        icon: "error",
                        confirmButtonText: "Ok"
                    });
                }
            }
        });
    });
});

function validar_editar() {
    var nome = document.getElementById("nome").value;
    var telefone = document.getElementById("telefone").value;
    var telefoneLimpo = telefone.replace(/\D/g, '');
    var nif = document.getElementById("nif").value;
    var nifLimpo = nif.replace(/\D/g, '');
    var email = document.getElementById("email").value;
    var pass = document.getElementById("pass").value;

    // Limpar mensagens de erro
    document.getElementById("error_nome").innerHTML = "";
    document.getElementById("error_telefone").innerHTML = "";
    document.getElementById("error_nif").innerHTML = "";
    document.getElementById("error_email").innerHTML = "";
    document.getElementById("error_pass").innerHTML = "";

    // Validação do nome
    if (nome == "" || !isNaN(nome)) {
        document.getElementById("error_nome").innerHTML = "Introduza um nome válido. O nome não pode ser vazio nem conter números.";
        document.getElementById("nome").focus();
        return false;
    }

    // Validação do telefone
    if (telefoneLimpo == "" || telefoneLimpo.length != 9) {
        document.getElementById("error_telefone").innerHTML = "Introduza um número de telefone válido.";
        document.getElementById("telefone").focus();
        return false;
    }

    // Validação do NIF
    if (nifLimpo == "" || isNaN(nifLimpo) || nifLimpo.length != 9) {
        document.getElementById("error_nif").innerHTML = "Introduza um NIF válido.";
        document.getElementById("nif").focus();
        return false;
    }

    // Validação do email
    if (email == "" || email.indexOf('@') == -1 || email.indexOf('.') == -1) {
        document.getElementById("error_email").innerHTML = "Introduza um email válido.";
        document.getElementById("email").focus();
        return false;
    }

    // Validação da password
    if (pass == "") {
        document.getElementById("error_pass").innerHTML = "Introduza uma password válida. A password não pode ser vazia.";
        document.getElementById("pass").focus();
        return false;
    }

    return true;
}
</script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
<?php
// Captura o email enviado, se existir
$email = $_GET['email'] ?? '';
$error = isset($_GET['error']) && $_GET['error'] == 1;
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts using Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/login.css">

    <link href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons/css/all/all.css" rel="stylesheet">

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

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color:rgba(255, 145, 0, 0.71);
            border-radius: 10px 10px 0 0;
        }
        .btn-primary {
            background-color:rgba(255, 145, 0, 0.71);
            border: none;
        }
        .btn-primary:hover {
            background-color:rgba(179, 107, 0, 0.9);
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color:rgb(255, 166, 0);
            box-shadow: 0 0 5px rgba(255, 123, 0, 0.5);
        }
    </style>

    <!-- Title -->
    <title>Login</title>
</head>
<body>
    
    <?php include 'header.php'; ?>

    <br><br><br><br><br><br><br><br><br><br>
   
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white">
                        <h4 class="card-title text-center">Insira o codigo enviado por gmail</h4>
                    </div>
                    <div class="card-body">
                        <form action="validar_cod.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Codigo</label>
                                <input type="text" class="form-control" id="email" name="codigo" placeholder="Digite o codigo" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br><br><br><br><br><br>

    <?php include 'footer.php'; ?>
    
    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        $('#telefone').mask('000 000 000');
        $('#nif').mask('000 000 000');
    </script>

<script>
        // Função para alternar visibilidade da senha
        function togglePassword(inputId, iconElement) {
            const input = document.getElementById(inputId);
            const icon = iconElement.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            }
        }
    </script>
<script>
    function validar_registo() {
        var registo_nome = document.getElementById("nome").value;
        var registo_telefone = document.getElementById("telefone").value;
        registo_telefone = registo_telefone.replace(/\D/g, '');
        var registo_email = document.getElementById("email").value;
        var registo_password = document.getElementById("password").value;
        var registo_repeat_pass = document.getElementById("repeat_pass").value;
        var registo_nif = document.getElementById("nif").value;
        registo_nif = registo_nif.replace(/\D/g, '');

        // Limpar mensagens de erro
        document.getElementById("error_nome").innerHTML = "";
        document.getElementById("error_telefone").innerHTML = "";
        document.getElementById("error_email").innerHTML = "";
        document.getElementById("error_password").innerHTML = "";
        document.getElementById("error_repeat_pass").innerHTML = "";
        document.getElementById("error_nif").innerHTML = "";

        // Validação do nome
        if (registo_nome == "" || !isNaN(registo_nome)) {
            document.getElementById("error_nome").innerHTML = "Introduza um nome válido. O nome não pode ser vazio nem conter números.";
            document.getElementById("nome").focus();
            return false;
        }

        // Validação do telefone
        if (registo_telefone == "" || registo_telefone.length != 9 || isNaN(registo_telefone)) {
            document.getElementById("error_telefone").innerHTML = "O telefone deve ter 9 dígitos e apenas números.";
            document.getElementById("telefone").focus();
            return false;
        }

        // Validação do email
        if (registo_email == "" || registo_email.indexOf("@") == -1) {
            document.getElementById("error_email").innerHTML = "Introduza um email válido. O email deve conter '@'.";
            document.getElementById("email").focus();
            return false;
        }

        // Validação da password
        if (registo_password == "") {
            document.getElementById("error_password").innerHTML = "Introduza uma password.";
            document.getElementById("password").focus();
            return false;
        }

        // Validação da repetição da password
        if (registo_repeat_pass == "") {
            document.getElementById("error_repeat_pass").innerHTML = "Confirme a sua password.";
            document.getElementById("repeat_pass").focus();
            return false;
        }
        if (registo_password !== registo_repeat_pass) {
            document.getElementById("error_repeat_pass").innerHTML = "As passwords não coincidem.";
            document.getElementById("repeat_pass").focus();
            return false;
        }

        // Validação do NIF
        if (registo_nif == "" || registo_nif.length != 9 || isNaN(registo_nif)) {
            document.getElementById("error_nif").innerHTML = "O NIF deve ter 9 dígitos e apenas números.";
            document.getElementById("nif").focus();
            return false;
        }

        return true;
    }
</script>
</body>
</html>
<?php
// Captura o email enviado, se existir
$email = $_GET['email'] ?? '';
$error = isset($_GET['error']) && $_GET['error'] == 1;
$erro = isset($_GET['erro']) && $_GET['erro'] == 1;
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



    <!-- Title -->
    <title>Login</title>
</head>
<body>
    
    <?php include 'header.php'; ?>

    <br><br><br>
    <!-- Main container -->
    <main class="container d-flex justify-content-center align-items-center vh-100">

        
        <!-- Card for Sign-In Form -->
        <div class="card shadow-lg p-4 rounded-3" style="max-width: 450px; width: 100%;">
            <a href="../karma-master/index.php"><i class="fi fi-rr-arrow-left"></i></i></a>
            <h3 class="text-center mb-3">login</h3>
            <p class="text-muted mb-2 text-center">Bem vindo de volta</p>

            <!-- Exibe mensagem de erro, se houver -->
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                Email ou password incorretos!
            </div>
        <?php endif; ?>

        <?php if ($erro): ?>
            <div class="alert alert-danger" role="alert">
                A sua conta foi desativada!
            </div>
        <?php endif; ?>

        <!-- Formulário de login -->
        <form method="post" action="loginv.php">
            <!-- Campo de Email -->
            <div class="form-group mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" 
                       placeholder="Email" name="email" 
                       value="<?php echo htmlspecialchars($email); ?>" >
            </div>

            <!-- Campo de Password -->
            <div class="form-group mb-3 position-relative">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" 
                       placeholder="Password" name="pass" >
                <span class="toggle-password position-absolute end-0 me-2 mt-2" 
                      style="cursor: pointer;" onclick="togglePassword('exampleInputPassword1', this)">
                    <i class="bi bi-eye-slash-fill" data-toggle="hidden"></i>
                </span>
            </div>

            <a href="password_reset_form.php">Esqueceu-se da password?</a>
            <br>

            <!-- Botão de Envio -->
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

           
            <!-- Create Account Link -->
            <div class="text-center mt-4">
                <button class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#signUpModal">Registar</button>
            </div> <!-- End Create Account Link -->
        </div> <!-- End Card for Sign-In Form -->
    </div> <!-- End Card for Sign-In Form -->

    <!-- Sign Up Modal -->
    <div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
        <!-- Modal Dialog -->
        <div class="modal-dialog modal-dialog-centered">
            <!-- Modal Content -->
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <!-- Sign Up Title -->
                    <h5 class="modal-title" id="signUpModalLabel">Registar</h5>
                    <!-- Close Button -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- End Modal Header -->

                <!-- Modal Body -->
                <div class="modal-body">
                <form method="post" action="registar.php" id="registar" onsubmit="return validar_registo()">
    <!-- Nome -->
    <div class="mb-3 position-relative">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome">
        <span id="error_nome" class="text-danger"></span>
    </div>

    <!-- Telefone -->
    <div class="mb-3 position-relative">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone" placeholder="Telefone" name="telefone">
        <span id="error_telefone" class="text-danger"></span>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
        <span id="error_email" class="text-danger"></span>
    </div>

    <!-- Password -->
    <div class="mb-3 position-relative">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        <span id="error_password" class="text-danger"></span>
    </div>

    <!-- Repetir Password -->
    <div class="mb-3 position-relative">
        <label for="repeat_pass" class="form-label">Repetir Password</label>
        <input type="password" class="form-control" id="repeat_pass" placeholder="Repetir Password" name="repeat_pass">
        <span id="error_repeat_pass" class="text-danger"></span>
    </div>

    <!-- NIF -->
    <div class="mb-3 position-relative">
        <label for="nif" class="form-label">NIF</label>
        <input type="text" class="form-control" id="nif" placeholder="NIF" name="nif">
        <span id="error_nif" class="text-danger"></span>
    </div>

    <!-- Botão de Envio -->
    <button type="submit" class="btn btn-primary w-100">Criar conta</button>
</form>
                </div> <!-- End Modal Body -->
            </div> <!-- End Modal Content -->
        </div> <!-- End Modal Dialog -->
    </main> <!-- End Main container -->

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
        var registo_nome = document.getElementById("nome").value.trim();
        var registo_telefone = document.getElementById("telefone").value.replace(/\D/g, '');
        var registo_email = document.getElementById("email").value.trim();
        var registo_password = document.getElementById("password").value;
        var registo_repeat_pass = document.getElementById("repeat_pass").value;
        var registo_nif = document.getElementById("nif").value.replace(/\D/g, '');

        // Limpar mensagens de erro
        document.getElementById("error_nome").innerHTML = "";
        document.getElementById("error_telefone").innerHTML = "";
        document.getElementById("error_email").innerHTML = "";
        document.getElementById("error_password").innerHTML = "";
        document.getElementById("error_repeat_pass").innerHTML = "";
        document.getElementById("error_nif").innerHTML = "";

        // Validação do nome
        if (registo_nome === "" ) {
            document.getElementById("error_nome").innerHTML = "Introduza um nome válido. O nome não pode ser vazio nem conter números.";
            document.getElementById("nome").focus();
            return false;
        }

        // Validação do telefone
        if (registo_telefone === "" || registo_telefone.length !== 9 || isNaN(registo_telefone)) {
            document.getElementById("error_telefone").innerHTML = "O telefone deve ter 9 dígitos e apenas números.";
            document.getElementById("telefone").focus();
            return false;
        }

        // Validação do email
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (registo_email === "" || !emailRegex.test(registo_email)) {
            document.getElementById("error_email").innerHTML = "Introduza um email válido.";
            document.getElementById("email").focus();
            return false;
        }

        // Validação da password
        var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/;
        if (registo_password === "" || !passwordRegex.test(registo_password)) {
            document.getElementById("error_password").innerHTML = "A password deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, uma minúscula, um número e um caractere especial.";
            document.getElementById("password").focus();
            return false;
        }

        // Validação da repetição da password
        if (registo_repeat_pass === "") {
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
        if (registo_nif === "" || registo_nif.length !== 9 || isNaN(registo_nif)) {
            document.getElementById("error_nif").innerHTML = "O NIF deve ter 9 dígitos e apenas números.";
            document.getElementById("nif").focus();
            return false;
        }

        return true;
    }

  
</script>
</body>
</html>
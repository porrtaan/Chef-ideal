<?php
include("connect.php");

// Obtém o ID do usuário da URL
$id = $_GET["id_user"];

// Verifica se o ID é válido
if (!$id || !is_numeric($id)) {
    die("ID de usuário inválido.");
}

// Consulta SQL para obter os dados do usuário
$sql = "SELECT * FROM utilizador WHERE id_user = $id";
$resultado = mysqli_query($cn, $sql);

// Verifica se a consulta retornou algum resultado
if (mysqli_num_rows($resultado) > 0) {
    $produto = mysqli_fetch_array($resultado);
} else {
    die("Usuário não encontrado.");
}

// Determina os valores das variáveis com base nos dados do usuário
$status = ($produto['tipo'] == 'A') ? 'checked' : '';
$trocar = ($produto['id_user'] == 1) ? 'disabled' : '';
?>

<!DOCTYPE html>
<html class="scroll-smooth overflow-x-hidden" lang="en">
<head>
<meta charset="utf-8">
<title>Create a new account</title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="robots" content="index, follow">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
<link rel="icon" href="assets/images/icons/icon-favicon.svg" type="image/x-icon" sizes="16x16">
<link rel="stylesheet" href="assets/styles/tailwind.min.css?v=5.0">
<link rel="stylesheet" href="assets/styles/style.min.css?v=5.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Chivo:wght@400;700;900&amp;family=Noto+Sans:wght@400;500;600;700;800&amp;display=swap">
<style>
    
select {
/* Reset Select */
appearance: none;
outline: 10px red;
border: 0;
box-shadow: none;
/* Personalize */
flex: 1;
padding: 0 1em;
color: #fff;
background-color: var(--darkgray);
background-image: none;
cursor: pointer;
color: black;
}

/* Custom Select wrapper */
.select {
position: relative;
display: flex;
width: 20em;
height: 3em;
border-radius: .25em;
overflow: hidden;
}
/* Arrow */
.select::after {
content: '\25BC';
position: absolute;
top: 0;
right: 0;
padding: 1em;
background-color: #34495e;
transition: .25s all ease;
pointer-events: none;
}

/* Estilo geral para o contêiner */
.form-group {
margin-bottom: 20px;
}

/* Esconde o input de arquivo padrão */
input[type="file"] {
display: none;
}

/* Estilo para o botão de upload */
.custom-file-label {
display: inline-block;
background-color: #28a745;
color: #fff;
padding: 10px 20px;
font-size: 14px;
font-weight: bold;
border: none;
border-radius: 5px;
cursor: pointer;
text-align: center;
transition: background-color 0.3s ease;
}

/* Alteração do estilo ao passar o mouse */
.custom-file-label:hover {
background-color: #218838;
}

/* Estilo para a área de preview */
#preview, #preview2, #preview3 {
margin-top: 10px;
max-width: 100%;
height: auto;
border-radius: 5px;
padding: 5px;
text-align: center;
}

/* Botão de remover imagem */
button {
background-color: #dc3545;
color: #fff;
border: none;
padding: 8px 15px;
border-radius: 5px;
cursor: pointer;
font-size: 14px;
font-weight: bold;
transition: background-color 0.3s ease;
}

button:hover {
background-color: #c82333;
}
textarea {
font-size: 0.8rem;
letter-spacing: 1px;
}

textarea {
padding: 10px;
max-width: 100%;
line-height: 1.5;
border-radius: 5px;
border: 1px solid #ccc;
box-shadow: 1px 1px 1px #999;
overflow: auto; 
resize: vertical;
color: white !important;
}

label {
display: block;
margin-bottom: 10px;
}
.toggle-switcher {
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Posiciona o botão à esquerda */
}

.toggle-input {
    display: none; /* Esconde o checkbox padrão */
}

.toggle-label {
    width: 40px;
    height: 20px;
    background-color: #ccc;
    border-radius: 20px;
    position: relative;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.toggle-label::after {
    content: '';
    position: absolute;
    width: 18px;
    height: 18px;
    background-color: #fff;
    border-radius: 50%;
    top: 1px;
    left: 1px;
    transition: transform 0.3s ease;
}

/* Estado marcado */
.toggle-input:checked + .toggle-label {
    background-color: #4caf50;
}

.toggle-input:checked + .toggle-label::after {
    transform: translateX(20px); /* Move o círculo para a direita */
}

}



</style>

</head>
<body class="w-screen relative overflow-x-hidden min-h-screen bg-gray-100 scrollbar-hide authentication-sign-in-page dark:bg-[#000]">
  <main class="overflow-x-scroll scrollbar-hide flex flex-col justify-between pt-[42px] px-[23px] pb-[28px]">
    <div>
    <form class="rounded-2xl bg-white mx-auto p-10 text-center max-w-[440px] my-[84px] dark:bg-[#1F2128]" action="edit_utilizador.php" method="post" enctype="multipart/form-data" onsubmit="return validar()">
    <a href="dashboard.php"><img src="img/home.png" alt=""></a>
    <div class="mb-4 text-center mx-auto">
        <img class="inline-block" src="assets/images/icons/icon-landing-success-1.svg" alt="landing success">
    </div>
    <h3 class="font-bold text-2xl text-gray-1100 capitalize mb-[5px] dark:text-gray-dark-1100">Editar Utilizador</h3>
    <br>
    <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($produto['id_user']); ?>">

    <!-- Nome -->
    <div>
        <label for="nome">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Nome</p>
        </label>
        <div class="form-control mb-[20px]">
            <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442]">
                <input id="nome" class="input flex-1 bg-transparent text-gray-300 focus:outline-none dark:text-gray-dark-300" 
                       type="text" placeholder="Digite aqui..." name="nome" style="color:white;" value="<?php echo htmlspecialchars($produto['nome']); ?>">
            </div>
            <span id="error_nome" class="text-danger"></span>
        </div>

        <!-- Email -->
        <label for="email">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Email</p>
        </label>
        <div class="form-control mb-[20px]">
            <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442]">
                <input id="email" class="input flex-1 bg-transparent text-gray-300 focus:outline-none dark:text-gray-dark-300" 
                       type="text" placeholder="Digite aqui..." name="email" style="color:white;" value="<?php echo htmlspecialchars($produto['email']); ?>">
            </div>
            <span id="error_email" class="text-danger"></span>
        </div>

        <!-- Telefone -->
        <label for="telefone">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Telefone</p>
        </label>
        <div class="form-control mb-[20px]">
            <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442]">
                <input id="telefone" class="input flex-1 bg-transparent text-gray-300 focus:outline-none dark:text-gray-dark-300" 
                       type="text" placeholder="Digite aqui..." name="telefone" style="color:white;" value="<?php echo htmlspecialchars($produto['telefone']); ?>">
            </div>
            <span id="error_telefone" class="text-danger"></span>
        </div>

        <!-- NIF -->
        <label for="nif">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">NIF</p>
        </label>
        <div class="form-control mb-[20px]">
            <div class="input-group border rounded-lg border-[#E8EDF2] dark:border-[#313442]">
                <input id="nif" class="input flex-1 bg-transparent text-gray-300 focus:outline-none dark:text-gray-dark-300" 
                       type="text" placeholder="Digite aqui..." name="nif" style="color:white;" value="<?php echo htmlspecialchars($produto['nif']); ?>">
            </div>
            <span id="error_nif" class="text-danger"></span>
        </div>

        

        <!-- Administrador -->
        <label for="tipo">
            <p class="text-left text-sm mb-2 text-gray-1100 dark:text-gray-dark-1100">Administrador</p>
        </label>
        <div class="toggle-switcher">
            <input type="checkbox" id="tipo" name="tipo" class="toggle-input" value="A" <?php echo $status; ?> <?php echo $trocar; ?>>
            <label for="tipo" class="toggle-label"></label>
        </div>

        <br>

        <!-- Botão de Envio -->
        <button class="btn normal-case h-fit min-h-fit transition-all duration-300 border-4 w-full border-neutral-bg mb-[20px] py-[14px] dark:border-dark-neutral-bg">Salvar Alterações</button>
    </div>
</form>

  </main>
</div>
<script type="text/javascript" src="assets/scripts/vendors/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="assets/scripts/chart-utils.min.js"></script>
<script type="text/javascript" src="assets/scripts/chart.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/chartjs-chart-geo@3"></script>
<script src="assets/scripts/app.js?v=5.0"></script>

<script>
    function validar() {
        var nome = document.getElementById("nome").value.trim();
        var email = document.getElementById("email").value.trim();
        var telefone = document.getElementById("telefone").value.replace(/\D/g, '');
        var nif = document.getElementById("nif").value.replace(/\D/g, '');
        var pass = document.getElementById("pass").value;
        var tipo = document.getElementById("tipo").checked;

        // Limpar mensagens de erro
        document.getElementById("error_nome").innerHTML = "";
        document.getElementById("error_email").innerHTML = "";
        document.getElementById("error_telefone").innerHTML = "";
        document.getElementById("error_nif").innerHTML = "";
        document.getElementById("error_pass").innerHTML = "";

        // Validação do nome
        if (nome === "" || !/^[a-zA-Z\s]+$/.test(nome)) {
            document.getElementById("error_nome").innerHTML = "Introduza um nome válido. O nome não pode ser vazio nem conter números.";
            document.getElementById("nome").focus();
            return false;
        }

        // Validação do email
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "" || !emailRegex.test(email)) {
            document.getElementById("error_email").innerHTML = "Introduza um email válido.";
            document.getElementById("email").focus();
            return false;
        }

        // Validação do telefone
        if (telefone === "" || telefone.length !== 9 || isNaN(telefone)) {
            document.getElementById("error_telefone").innerHTML = "O telefone deve ter 9 dígitos e apenas números.";
            document.getElementById("telefone").focus();
            return false;
        }

        // Validação do NIF
        if (nif === "" || nif.length !== 9 || isNaN(nif)) {
            document.getElementById("error_nif").innerHTML = "O NIF deve ter 9 dígitos e apenas números.";
            document.getElementById("nif").focus();
            return false;
        }


        return true;
    }

</script>
</body>
</html>
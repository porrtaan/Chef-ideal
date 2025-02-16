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

// Consulta para buscar as moradas do usuário
$sql = "SELECT * FROM morada WHERE id_user = ?";
$stmt = mysqli_prepare($cn, $sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . mysqli_error($cn));
}

// Vincula os parâmetros corretamente
mysqli_stmt_bind_param($stmt, "i", $id_utilizador);

if (!mysqli_stmt_execute($stmt)) {
    die("Erro na execução da consulta: " . mysqli_error($cn));
}

$resultado = mysqli_stmt_get_result($stmt);
$moradas = [];
$id_moradas = []; // Array para armazenar os IDs das moradas

while ($row = mysqli_fetch_assoc($resultado)) {
    $moradas[] = $row; // Mantém todas as informações da morada
    $id_moradas[] = $row['id_morada']; // Adiciona o ID ao array separado
}

mysqli_stmt_close($stmt);
mysqli_close($cn);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morada de Faturação</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            background-color: rgb(179, 174, 170);
        }
        .morada-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            justify-content: center;
            padding: 20px;
        }
        .morada-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 16px;
            position: relative;
        }
        .close-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background-color: transparent;
            border: none;
            font-size: 16px;
            color: #aaa;
            cursor: pointer;
        }
        .edit-btn {
            display: flex;
            align-items: center;
            background-color:rgb(255, 145, 0);
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 12px;
        }
        .add-button {
        width: 50px;
        height: 50px;
        font-size: 24px;
        font-weight: bold;
        border: none;
        border-radius: 50%;
        background-color:rgb(255, 145, 0);
        color: white;
        cursor: pointer;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .add-button:hover {
        background-color:rgb(187, 106, 0);
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
                    <h1>Morada</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="detalhe_da_conta.php">Utilizador<span class="lnr lnr-arrow-right"></span></a>
                        <a href="morada.php">Morada</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout_area section_gap">
        <div class="container">
            <div class="morada-container">
                <?php foreach ($moradas as $morada) : ?>
                    <div class="morada-card">
                    <button class="close-btn" id="delete_button">&times;</button>
                    <h2><?=$morada['morada']?></h2>
                        <p><strong><?= htmlspecialchars($morada['endereco']) ?></strong></p>
                        <p><?= htmlspecialchars($morada['outras_info']) ?></p>
                        <p><?= htmlspecialchars($morada['cod_post']) ?>, <?= htmlspecialchars($morada['cidade']) ?></p>
                        <p><?= htmlspecialchars($morada['pais']) ?></p>
                        <button class="edit-btn" onclick="window.location.href='editar_morada_formulario.php?id=<?= $morada['id_morada'] ?>';">EDITAR</button>
                        </div>
                <?php endforeach; ?>
                <div class="morada-card add-card">
                <button class="add-button" onclick="window.location.href='adcionar_morada_formulario.php'">+</button>
                </div>
            </div>
        </div>
    </section>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('delete_button').addEventListener('click', function () {
        Swal.fire({
            title: "Tem a certeza?",
            text: "Deseja eliminar esta morada?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, eliminar!",
            cancelButtonText: "Não, cancelar!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireciona para a página PHP
                window.location.href = "deletar_morada.php?id=<?= $morada['id_morada'] ?>";
            }
        });
    });
});
</script>


</body>
</html>

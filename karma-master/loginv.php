<?php
session_start();
include("connect.php");

$email = $_POST["email"] ?? '';
$password = $_POST["pass"] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepara a consulta SQL segura
    $sql = "SELECT * FROM Utilizador WHERE email = ? AND pass = ?";
    $stmt = mysqli_prepare($cn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_assoc($resultado);
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['id_utilizador'] = $row['id_user'];

        if ($row['tipo'] == 'U' && $row['estado'] == 'A') {
            header("Location: category.php");
            exit();
        } elseif ($row['tipo'] == 'U' && $row['estado'] == 'D') {
            header("Location: login.php?email=" . urlencode($email) . "&erro=1");
            exit();
        } elseif ($row['tipo'] == 'A' && $row['estado'] == 'A') {
            header("Location: dashboard.php");
            exit();
        } elseif ($row['tipo'] == 'A' && $row['estado'] == 'D') {
            header("Location: login.php?email=" . urlencode($email) . "&erro=1");
            exit();
        }
    } else {
        header("Location: login.php?email=" . urlencode($email) . "&error=1");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

?>
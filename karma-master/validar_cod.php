<?php

include('connect.php');

$codigo = $_POST['codigo'];

$sql = "SELECT * FROM utilizador WHERE codigo = '$codigo'"; 
$result = mysqli_query($cn, $sql); 

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email']; // Obtém o e-mail do utilizador

    echo "<form id='redirectForm' action='trocar_pass.php' method='POST'>
            <input type='hidden' name='email' value='" . htmlspecialchars($email) . "'>
          </form>
          <script>document.getElementById('redirectForm').submit();</script>";
    exit(); // Garante que o script pare aqui
} else {
    echo "<script>alert('Código errado!'); window.location.href='validar_rec.php';</script>";
    exit(); // Para garantir que o script pare após o redirecionamento
}

?>

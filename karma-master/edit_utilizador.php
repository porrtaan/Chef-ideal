<?php 
include 'connect.php';

$id = $_POST['id_user'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$nif = $_POST['nif'];
$pass = $_POST['pass'];
$admin = $_POST['tipo'];

if($id == 1){
    $tipo = 'A';
} else{
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 'U';
}

$sql = "UPDATE Utilizador SET nome = '$nome', email = '$email', telefone = '$telefone', nif = '$nif', tipo = '$tipo' WHERE id_user = $id";
$resultado = mysqli_query($cn, $sql);

if($resultado){
    if($tipo == 'A'){
        header('Location: adm-list.php');
    }
    else{
            
    header('Location: clients-list.php');
    }

} else {
    echo 'Erro!';
}
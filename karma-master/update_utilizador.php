<?php 
    include 'connect.php';

    $id = $_POST['id_utilizador'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $nif = $_POST['nif'];

    $sql = "UPDATE Utilizador SET nome = '$nome', email = '$email', telefone = '$telefone', nif = '$nif', pass = '$pass' WHERE id_user = $id";
    $resultado = mysqli_query($cn, $sql);
    

    if($resultado){
        echo "<script>alert('Perfil atualizado com sucesso!'); window.location='detalhe_da_conta.php';</script>";
    }else{
        echo "<script>alert('Erro ao atualizar o perfil!'); window.location='detalhe_da_conta.php';</script>";
    }

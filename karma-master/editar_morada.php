<?php

    include 'connect.php'; 

    $morada = $_POST['morada'];
    $id_morada = $_POST['id_morada'];
    $endereco = $_POST['endereco'];
    $outras = $_POST['outras'];
    $codigo_postal = $_POST['postal'];
    $pais = $_POST['pais'];
    $cidade = $_POST['cidade'];

    $sql = "UPDATE morada SET endereco = '$endereco', outras_info = '$outras', cod_post = '$codigo_postal', pais = '$pais', cidade = '$cidade',morada ='$morada' WHERE id_morada = '$id_morada'";
    $result = mysqli_query($cn, $sql);

    if($result){
        echo "<script>alert('Morada atualizada com sucesso!'); window.location='morada.php';</script>";
    }else{
        echo "<script>alert('Erro ao atualizar morda!'); window.location='product-list.php?id = $morada';</script>";
    }

<?php
    include 'connect.php';
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['desc'];

    $sql = "UPDATE marca SET nome_marca = '$nome', descricao = '$descricao' WHERE id_marca = '$id'";
    $resultado = mysqli_query($cn, $sql);

    if($resultado){
        echo "<script>
                alert('Marca editada com sucesso!');
                window.location.href = 'listar_marca.php';
            </script>";
    } else {
        echo "<script>
                alert('Erro ao editar categoria!');
window.location.href = 'listar_categorias.php';</script>";
    }
?>
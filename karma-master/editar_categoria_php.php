<?php
    include 'connect.php';
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['desc'];

    $sql = "UPDATE categoria SET nome_categoria = '$nome', descricao = '$descricao' WHERE id_categoria = '$id'";
    $resultado = mysqli_query($cn, $sql);

    if($resultado){
        echo "<script>
                alert('Categoria editada com sucesso!');
                window.location.href = 'listar_categorias.php';
            </script>";
    } else {
        echo "<script>
                alert('Erro ao editar categoria!');
window.location.href = 'listar_categorias.php';            </script>";
    }
?>
<?php
    include("connect.php");

    $id_prod = $_POST["id_prod"];
    $nome = $_POST["nome"];
    $descricao = $_POST["desc"];
    $preco = $_POST["preco"];
    $stock = $_POST["stock"];
    $marca = $_POST["marca"];
    $categorias = isset($_POST["categ"]) ? (is_array($_POST["categ"]) ? $_POST["categ"] : [$_POST["categ"]]) : [];

    // Para as fotos
    $foto_principal = isset($_FILES["foto_principal"]["name"]) ? $_FILES["foto_principal"]["name"] : null;
    $foto_principal_temp = isset($_FILES["foto_principal"]["tmp_name"]) ? $_FILES["foto_principal"]["tmp_name"] : null;
    $foto_2 = isset($_FILES["foto_2"]["name"]) ? $_FILES["foto_2"]["name"] : null;
    $foto_2_temp = isset($_FILES["foto_2"]["tmp_name"]) ? $_FILES["foto_2"]["tmp_name"] : null;
    $foto_3 = isset($_FILES["foto_3"]["name"]) ? $_FILES["foto_3"]["name"] : null;
    $foto_3_temp = isset($_FILES["foto_3"]["tmp_name"]) ? $_FILES["foto_3"]["tmp_name"] : null;

    // Diretório para armazenar as imagens
    $target_dir = "uploads/";

    // Movendo as imagens para o diretório
    if ($foto_principal && $foto_principal_temp) {
        $target_file_principal = $target_dir . basename($foto_principal);
        move_uploaded_file($foto_principal_temp, $target_file_principal);
    }
    if ($foto_2 && $foto_2_temp) {
        $target_file_2 = $target_dir . basename($foto_2);
        move_uploaded_file($foto_2_temp, $target_file_2);
    }
    if ($foto_3 && $foto_3_temp) {
        $target_file_3 = $target_dir . basename($foto_3);
        move_uploaded_file($foto_3_temp, $target_file_3);
    }

    // Atualizando os dados do produto
    $sql_atualizar = "UPDATE Produto SET nome = '$nome', descricao = '$descricao', preco_uni = '$preco', stock = '$stock', id_marca = '$marca'";

    // Adiciona as fotos à consulta se forem fornecidas
    if ($foto_principal) {
        $sql_atualizar .= ", imagem_principal = '$foto_principal'";
    }
    if ($foto_2) {
        $sql_atualizar .= ", imagem_2 = '$foto_2'";
    }
    if ($foto_3) {
        $sql_atualizar .= ", imagem_3 = '$foto_3'";
    }

    // Conclui a consulta
    $sql_atualizar .= " WHERE id_prod = '$id_prod'";

    // Executa a consulta
    $resultado = mysqli_query($cn, $sql_atualizar);

    // Obter categorias associadas ao produto no banco de dados
    $query_categorias_atual = "SELECT id_categoria FROM Produto_Categoria WHERE id_prod = '$id_prod'";
    $resultado_categorias_atual = mysqli_query($cn, $query_categorias_atual);

    $categorias_atual = [];
    while ($row = mysqli_fetch_assoc($resultado_categorias_atual)) {
        $categorias_atual[] = $row['id_categoria'];
    }

    // Determinar categorias a serem adicionadas e removidas
    $categorias_a_adicionar = array_diff($categorias, $categorias_atual);
    $categorias_a_remover = array_diff($categorias_atual, $categorias);

    // Adicionar novas categorias
    foreach ($categorias_a_adicionar as $categoria) {
        $insert_categoria = "INSERT INTO Produto_Categoria (id_prod, id_categoria) VALUES ('$id_prod', '$categoria')";
        $resultado_insert_categoria = mysqli_query($cn, $insert_categoria);

        if (!$resultado_insert_categoria) {
            echo "<script>alert('Erro ao adicionar nova categoria!'); window.location='product-list.php';</script>";
            exit;
        }
    }

    // Remover categorias que não são mais necessárias
    foreach ($categorias_a_remover as $categoria) {
        $delete_categoria = "DELETE FROM Produto_Categoria WHERE id_prod = '$id_prod' AND id_categoria = '$categoria'";
        $resultado_delete_categoria = mysqli_query($cn, $delete_categoria);

        if (!$resultado_delete_categoria) {
            echo "<script>alert('Erro ao remover categoria antiga!'); window.location='product-list.php';</script>";
            exit;
        }
    }

    // Obter estado atualizado do produto
    $sql_produto = "SELECT estado FROM Produto WHERE id_prod = '$id_prod'";
    $resultado_produto = mysqli_query($cn, $sql_produto);
    $produto = mysqli_fetch_array($resultado_produto);
    $estado = isset($produto['estado']) ? $produto['estado'] : 'A';

    if ($resultado) {
        if ($estado == 'A') {
            echo "<script>alert('Produto atualizado com sucesso!'); window.location='product-list.php';</script>";
        } elseif ($estado == 'D') {
            echo "<script>alert('Produto atualizado com sucesso!'); window.location='ver_produtos_desativados.php';</script>";
        }
    } else {
        echo "<script>alert('Erro ao atualizar produto!'); window.location='product-list.php';</script>";
    }
    exit;
?>

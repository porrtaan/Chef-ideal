<?php

include 'connect.php';

$nome = $_POST['nome'];
$desc = $_POST['desc'];
$preco = $_POST['preco'];
$stock = $_POST['stock'];
$marca = $_POST['marca'];
$categ = $_POST['categ'];

// Definir os arquivos obrigatórios e não obrigatórios
$required_files = ['foto_principal'];
$optional_files = ['foto_2', 'foto_3'];
$mime_types = ["image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/jpg", "image/x-png", "image/bmp", "image/webp","image/avif"];
$upload_directory = __DIR__ . "/uploads/";
$max_file_size = 10048576; // 1MB

$file_paths = [];

// Criar o diretório de uploads se não existir
if (!file_exists($upload_directory)) {
    mkdir($upload_directory, 0755, true);
}

// Verificação de arquivos obrigatórios
foreach ($required_files as $file_key) {

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->file($_FILES[$file_key]["tmp_name"]);

    if (!in_array($mime_type, $mime_types)) {
        exit("Tipo de arquivo inválido para '$file_key'");
    }

    list($width, $height) = getimagesize($_FILES[$file_key]["tmp_name"]);
    if ($width < 300 || $height < 300) {
        exit("A imagem '$file_key' deve ter pelo menos 300x300 pixels.");
    }

    $pathinfo = pathinfo($_FILES[$file_key]["name"]);
    $base = preg_replace("/[^\w-]/", "_", $pathinfo["filename"]);
    $filename = $base . "." . $pathinfo["extension"];
    $destination = $upload_directory . $filename;

    $i = 1;
    while (file_exists($destination)) {
        $filename = $base . "($i)." . $pathinfo["extension"];
        $destination = $upload_directory . $filename;
        $i++;
    }

    if (!move_uploaded_file($_FILES[$file_key]["tmp_name"], $destination)) {
        exit("Não foi possível mover o arquivo '$file_key'");
    }

    $file_paths[$file_key] = $filename;
}

// Verificação de arquivos opcionais (foto 2 e foto 3)
foreach ($optional_files as $file_key) {
    if (isset($_FILES[$file_key]) && $_FILES[$file_key]["error"] === UPLOAD_ERR_OK) {
        if ($_FILES[$file_key]["size"] > $max_file_size) {
            exit("Arquivo '$file_key' muito grande (máximo 1MB)");
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo->file($_FILES[$file_key]["tmp_name"]);

        if (!in_array($mime_type, $mime_types)) {
            exit("Tipo de arquivo inválido para '$file_key'");
        }

        list($width, $height) = getimagesize($_FILES[$file_key]["tmp_name"]);
        if ($width < 300 || $height < 300) {
            exit("A imagem '$file_key' deve ter pelo menos 300x300 pixels.");
        }

        $pathinfo = pathinfo($_FILES[$file_key]["name"]);
        $base = preg_replace("/[^\w-]/", "_", $pathinfo["filename"]);
        $filename = $base . "." . $pathinfo["extension"];
        $destination = $upload_directory . $filename;

        $i = 1;
        while (file_exists($destination)) {
            $filename = $base . "($i)." . $pathinfo["extension"];
            $destination = $upload_directory . $filename;
            $i++;
        }

        if (!move_uploaded_file($_FILES[$file_key]["tmp_name"], $destination)) {
            exit("Não foi possível mover o arquivo '$file_key'");
        }

        $file_paths[$file_key] = $filename;
    }
}

$imagem_principal = $file_paths['foto_principal'];
$imagem_2 = $file_paths['foto_2'] ?? null; //verifica se existe a foto 2, se não existir, atribui null 
$imagem_3 = $file_paths['foto_3'] ?? null; //verifica se existe a foto 3, se não existir, atribui null

// Inserir o produto
$sql = "INSERT INTO Produto (nome, descricao, preco_uni, stock, id_marca,  imagem_principal, imagem_2, imagem_3, estado) 
        VALUES ('$nome', '$desc', '$preco', '$stock', '$marca',  '$imagem_principal', '$imagem_2', '$imagem_3',  'A')";

$resultado = mysqli_query($cn, $sql);

if ($resultado) {
    // Obter o ID do produto inserido
    $produto_id = mysqli_insert_id($cn);

    // Inserir a associação na tabela Produto_Categoria
    if (is_array($categ)) {
        foreach ($categ as $categoria_id) {
            $sql_categoria = "INSERT INTO Produto_Categoria (id_prod, id_categoria) VALUES ('$produto_id', '$categoria_id')";
            $resultado_categoria = mysqli_query($cn, $sql_categoria);
            if (!$resultado_categoria) {
                echo "Erro ao associar produto à categoria: " . mysqli_error($cn);
                exit();
            }
        }
    } else {
        // Caso categ não seja um array, inserir uma única associação
        $sql_categoria = "INSERT INTO Produto_Categoria (id_prod, id_categoria) VALUES ('$produto_id', '$categ')";
        $resultado_categoria = mysqli_query($cn, $sql_categoria);
        if (!$resultado_categoria) {
            echo "Erro ao associar produto à categoria: " . mysqli_error($cn);
            exit();
        }
    }

    

    echo "<script>alert('Produto adicionado com sucesso!'); window.location='dashboard.php';</script>";
    exit();
} else {
    echo "Erro ao inserir produto: " . mysqli_error($cn);
}
?>
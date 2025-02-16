<?php
// Conexão com o banco de dados
include 'connect.php';
session_start();

// Verifica se houve erro na conexão
if (!$cn) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Captura e sanitiza os dados do formulário
$nome = trim(mysqli_real_escape_string($cn, $_GET['nome']));
$endereco = trim(mysqli_real_escape_string($cn, $_GET['endereco']));
$cidade = trim(mysqli_real_escape_string($cn, $_GET['cidade']));
$pais = trim(mysqli_real_escape_string($cn, $_GET['pais']));
$zip = trim(mysqli_real_escape_string($cn, $_GET['zip']));
$saved_address = $_GET['saved_address'];

if ($saved_address === 'default'){

    echo'Nenhuma morada selecionada';
}



// Se o saved_address for 'new', insere um novo endereço
if ($saved_address === 'new') {
    $id_utilizador = $_SESSION['id_utilizador']; // ID do usuário logado
    $outras_info = "";

    
// Validação dos campos obrigatórios
if (empty($nome) || empty($endereco) || empty($cidade) || empty($pais) || empty($zip)) {
    die("Todos os campos obrigatórios devem ser preenchidos.");
}

// Validação do código postal (formato 1234-567)
if (!preg_match('/^\d{4}-\d{3}$/', $zip)) {
    die("Código postal inválido. Formato esperado: 1234-567.");
}


    // Verifica se o nome do endereço já existe para o mesmo usuário
    $check_sql = "SELECT COUNT(*) AS total FROM morada WHERE morada = '$nome' AND id_user = '$id_utilizador'";
    $check_result = mysqli_query($cn, $check_sql);
    $row = mysqli_fetch_assoc($check_result);

    if ($row['total'] > 0) {
        die("Já existe um endereço com este nome cadastrado.");
    }


    // Prepara e executa a query de inserção
    $sql = "INSERT INTO morada (id_user, endereco, morada, outras_info, pais, cod_post, cidade) 
            VALUES ('$id_utilizador', '$endereco', '$nome', '$outras_info', '$pais', '$zip', '$cidade')";

    if (mysqli_query($cn, $sql)) {
        echo "Novo endereço inserido com sucesso!";
    } else {
        die("Erro ao inserir o endereço: " . mysqli_error($cn));
    }
} else {
    echo "Endereço selecionado: " . htmlspecialchars($saved_address);
}

// Fecha a conexão
mysqli_close($cn);
?>

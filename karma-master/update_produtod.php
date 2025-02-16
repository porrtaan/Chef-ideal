<?php
// Inclua sua conexão com o banco de dados
include 'connect.php'; // Substitua pelo arquivo correto

// Verifique se o ID do produto foi passado
if (isset($_GET['id_prod'])) {
    $id_prod = intval($_GET['id_prod']); // Converta para inteiro para segurança

    // Atualize o estado do produto no banco de dados
    $sql = "UPDATE Produto SET estado = 'A' WHERE id_prod = ?";
    $stmt = $cn->prepare($sql);
    $stmt->bind_param('i', $id_prod);

    if ($stmt->execute()) {
        // Redirecione de volta para a página principal com mensagem de sucesso
        header('Location: product-list.php');
        exit();
    }

    $stmt->close();
} else {
    // Redirecione se o ID do produto não foi passado
    header('Location: index.php?msg=ID do produto não fornecido');
    exit();
}

$conn->close();
?>

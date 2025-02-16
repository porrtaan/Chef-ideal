<?php
// fetch_morada.php
include 'connect.php'; // Inclui o arquivo de conexão

if (isset($_POST['id_morada'])) {
    $id_morada = mysqli_real_escape_string($cn, $_POST['id_morada']); // Previne SQL injection
    $sql = "SELECT * FROM morada WHERE id_morada = '$id_morada'";
    $result = mysqli_query($cn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode([
            'status' => 'success',
            'endereco' => $row['endereco'],
            'outras_info' => $row['outras_info'],
            'cod_post' => $row['cod_post'],
            'cidade' => $row['cidade'], 
            'pais' => $row['pais']
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Morada não encontrada.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID da morada não fornecido.']);
}
?>
<?php
include("connect.php");
session_start();

// Recupera os dados do formulário
$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$password = $_POST["password"];
$nif = $_POST["nif"];
$telefone = str_replace(' ', '', $_POST['telefone']);
$nif = str_replace(' ', '', $_POST['nif']);
$code = rand(999999, 111111);

// Verifica se o email já está em uso
$sql_verificar_email = "SELECT email FROM Utilizador WHERE email = '$email'";
$resultado_email = mysqli_query($cn, $sql_verificar_email);

// Verifica se o NIF já está em uso
$sql_verificar_nif = "SELECT nif FROM Utilizador WHERE nif = '$nif'";
$resultado_nif = mysqli_query($cn, $sql_verificar_nif);

if (mysqli_num_rows($resultado_email) > 0) {
    echo "<script type='text/javascript'>
        alert('O email já está a ser utilizado, por favor use outro!');
        window.location.href = 'login.php';
        </script>";
    exit();
} elseif (mysqli_num_rows($resultado_nif) > 0) {
    echo "<script type='text/javascript'>
        alert('O NIF já está a ser utilizado, por favor use outro!');
        window.location.href = 'login.php';
        </script>";
    exit();
} else {
    // Insere o novo utilizador no banco de dados
    $sql = "INSERT INTO Utilizador (nome, telefone, email, pass, nif, tipo,codigo,estado) 
            VALUES ('$nome', '$telefone', '$email', '$password', '$nif', 'U',$code,'A')";
    $resultado = mysqli_query($cn, $sql);

    if ($resultado) {
        // Busca o usuário recém-criado para armazenar informações na sessão
        $sql2 = "SELECT * FROM Utilizador WHERE email = '$email'";
        $resultado2 = mysqli_query($cn, $sql2);
        $row = mysqli_fetch_assoc($resultado2);

        // Configura variáveis de sessão
        $_SESSION['nome_utilizador'] = $nome;
        $_SESSION['id_utilizador'] = $row['id_user'];

        echo "<script type='text/javascript'>
            alert('Registo feito com sucesso!');
            window.location.href = 'index.php';
            </script>";
        exit();
    } else {
        echo "<script type='text/javascript'>
            alert('O registo falhou, tente novamente!');
            window.location.href = 'pagina_registar.php';
            </script>";
        exit();
    }
}
?>
    
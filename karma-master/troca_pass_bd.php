<?php
include 'connect.php';

$pass = $_POST['password']; 
$email = $_POST['email'];

$sql = "UPDATE utilizador SET pass = '$pass' WHERE email = '$email'";
$result = mysqli_query($cn, $sql);

    header('Location: login.php');
    exit();

?>

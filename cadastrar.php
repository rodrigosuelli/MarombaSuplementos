<?php
require_once 'init.php';
$PDO = db_connect();
session_start();

$nome = trim($_POST['nome']);
$sobrenome = trim($_POST['sobrenome']);
$email = trim($_POST['email']);
$senha = trim($_POST['senha']);
$rg = trim($_POST['rg']);
$cpf = trim($_POST['cpf']);
$endereco = trim($_POST['endereco']);

$sql = "SELECT * FROM Clientes where email='$email'";
$stmt = $PDO->prepare($sql);
$stmt->execute();

if ($Clientes = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($email == $Clientes['email']) {
        echo "<script>alert('Este email já está cadastrado no nosso banco de dados, por favor use outro email!')</script>";
        echo "<script>window.location = 'cadastro.php'</script>";
    }
} else {
    $sql2 = "INSERT INTO Clientes(nome, sobrenome, email, senha, RG, endereco, CPF) 
        VALUES('$nome', '$sobrenome', '$email', '$senha', '$rg', '$endereco', '$cpf')";
    $stmt2 = $PDO->prepare($sql2);
    if ($stmt2->execute()) {
        header('Location: index.php');
    } else {
        echo "Erro ao cadastrar";
        print_r($stmt2->errorInfo());
    }
}
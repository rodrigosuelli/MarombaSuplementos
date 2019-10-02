<?php
require_once 'init.php';
$PDO = db_connect();
session_start();

$email=trim($_POST['email']);
$senha=trim($_POST['senha']);

$sql = "SELECT * FROM Clientes where email='$email' and senha='$senha'";
$stmt = $PDO->prepare($sql);
$stmt->execute();

if ($Clientes = $stmt->fetch(PDO::FETCH_ASSOC)){
    if ($Clientes['email']==$email){
        $_SESSION['logado']['id']=$Clientes['id'];
        $_SESSION['logado']['nome']=$Clientes['nome'];
        $_SESSION['logado']['sobrenome']=$Clientes['sobrenome'];
        $_SESSION['logado']['email']=$Clientes['email'];
        $_SESSION['logado']['cpf']=$Clientes['CPF'];
        $_SESSION['logado']['rg']=$Clientes['RG'];
        $_SESSION['logado']['endereco']=$Clientes['endereco'];
        header('Location: index.php');
    }else{
        echo "<script>alert('Email/senha incorretos ou usuario nao cadastrado!')</script>";
        echo "<script>window.location = 'index.php'</script>";
    }
}

echo "<script>alert('Email/senha incorretos ou usuario nao cadastrado!')</script>";
echo "<script>window.location = 'index.php'</script>";

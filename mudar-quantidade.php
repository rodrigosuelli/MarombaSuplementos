<?php
require_once 'init.php';
session_start();
$valor=$_GET['valor'];
$id=$_GET['id'];

$PDO = db_connect();
$sql = "SELECT * FROM Produtos WHERE id=$id";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$Produtos = $stmt->fetch(PDO::FETCH_ASSOC);

$key = array_search($id, $_SESSION['cart']['id']);

if ($_SESSION['cart']['qtd'][$key]==1 && $valor==-1){
    header('Location: carrinho.php');
}elseif ($valor==-1){
    if($key!==false){
        $_SESSION['cart']['qtd'][$key]--;
        $_SESSION['cart']['preco'][$key] = $Produtos['preco'] * $_SESSION['cart']['qtd'][$key];
    }
}elseif ($valor==1) {
    if($key!==false){
        $_SESSION['cart']['qtd'][$key]++;
        $_SESSION['cart']['preco'][$key] = $Produtos['preco'] * $_SESSION['cart']['qtd'][$key];
    }
}
header('Location: carrinho.php');


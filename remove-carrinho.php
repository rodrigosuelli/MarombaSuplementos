<?php
require_once 'init.php';
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : null;

$key = array_search($id, $_SESSION['cart']['id']);
if($key!==false){
    unset($_SESSION['cart']['id'][$key]);
    unset($_SESSION['cart']['qtd'][$key]);
    unset($_SESSION['cart']['preco'][$key]);
}

if(!empty($_SESSION['cart']['id'])){
    header('Location: carrinho.php');
}else{
    header('Location: index.php');
} ?>


<?php
require_once 'init.php';
session_start();
print_r($_SESSION['carrinho']);

$id = isset($_GET['id']) ? $_GET['id'] : null;

$key = array_search($id, $_SESSION['carrinho']);
if($key!==false){
    unset($_SESSION['carrinho'][$key]);
}

if(!empty($_SESSION['carrinho'])){
    header('Location: carrinho.php');
}else{
    header('Location: index.php');
} ?>


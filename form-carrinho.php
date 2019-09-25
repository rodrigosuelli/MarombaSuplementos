<?php
require_once 'init.php'; 
// SESSAO
session_start();

if (empty($_SESSION['carrinho'])) {
    $_SESSION['carrinho']=array();
}

array_push($_SESSION['carrinho'], $_GET['id']);

if(!empty($_SESSION['carrinho'])){
    header('Location: carrinho.php');
}else{
    echo "Erro ao adicionar ao carrinho";
    print_r($stmt->errorInfo());
} ?>
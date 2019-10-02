<?php
require_once 'init.php';
session_start();
$PDO = db_connect();

unset($_SESSION['cart']);

if(empty($_SESSION['cart'])){
    header('Location: index.php');
}else{
    echo "Erro ao finalizar pedido";
}
<?php
require_once 'init.php';

session_start();

    if(isset($_SESSION['cart'])){

        $itens_id = array_values($_SESSION['cart']['id']);

        if(in_array($_GET['id'], $itens_id)){
            echo "<script>alert('O Produto já foi adicionado no carrinho')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{
            $count_id = count($_SESSION['cart']['id']);
            $count_qtd = count($_SESSION['cart']['qtd']);
            $count_qtd = count($_SESSION['cart']['preco']);

            $_SESSION['cart']['id'][$count_id] = $_GET['id'];
            $_SESSION['cart']['qtd'][$count_qtd]= $_GET['qtd_pedida'];
            $_SESSION['cart']['preco'][$count_qtd]= $_GET['preco'];
            header('Location: carrinho.php');
        }
    }else{
        // Create new session variable
        $_SESSION['cart']=array();
        $_SESSION['cart']['id']=array();
        $_SESSION['cart']['qtd']=array();
        $_SESSION['cart']['preco']=array();

        array_push($_SESSION['cart']['id'], $_GET['id']);
        array_push($_SESSION['cart']['qtd'], $_GET['qtd_pedida']);
        array_push($_SESSION['cart']['preco'], $_GET['preco']);
        header('Location: carrinho.php');
    }







<?php
require 'init.php';
session_start();
//VERIFICAR SE ESTÁ LOGADO
if (!$_SESSION['logado']['email']=="rodrigosuelli@gmail.com"){
    echo "<script>alert('Email/senha incorretos ou usuario nao cadastrado!')</script>";
    echo "<script>window.location = 'index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Icones -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Meu CSS -->
    <link rel="stylesheet" href="css/estilo.css">

    <title>Cadastro de Produtos</title>
    <!--Fav icon -->
    <link rel="icon" href="https://images2.imgbox.com/84/a1/MTumKAVt_o.png">
</head>

<body>
    <!--HEADER-->
    <?php require_once("componentes/header.php"); ?>
    <!--CORPO-->
    <div class="container">
        <h1 class="mb-2 mt-3 text-center">Cadastro de Produtos</h1>


        <form action="add.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="nome">Nome: </label>
                    <input placeholder="Nome" required="required" class="form-control" type="text" name="nome"
                        id="nome">
                </div>


                <div class="form-group col-md-2">
                    <label for="preco">Preço: </label>
                    <input required="required" class="form-control" type="number" step="0.01" min="0" max="10000"
                        name="preco" id="preco">
                </div>


                <div class="form-group col-md-2">
                    <label for="quantidade">Quantidade: </label>
                    <input required="required" class="form-control" type="number" name="quantidade" id="quantidade">
                </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="imagem">Link da Imagem:</label>
                        <input placeholder="Link" required="required" class="form-control" type="text" name="imagem"
                            id="imagem">
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="col-md-12">
                        <p>Categoria:</p>
                        <input value="Proteínas" class="" type="radio" name="categoria" id="categoria1"> 
                        <label for="categoria1">Proteínas</label>
                        <input value="Aminoácidos" class="ml-3" type="radio" name="categoria" id="categoria2">
                        <label for="catego3ria2">Aminoácidos</label>
                        <input value="Carboidratos" class="ml-3" type="radio" name="categoria" id="categoria3">
                        <label for="categoria3">Carboidratos</label>
                        <input value="Vegetarianos" class="ml-3" type="radio" name="categoria" id="categoria4">
                        <label for="categoria4">Vegetarianos</label>
                        <input value="Vegano" class="ml-3" type="radio" name="categoria" id="categoria5">
                        <label for="categoria5">Vegano</label>
                        <input value="Termogênico" class="ml-3" type="radio" name="categoria" id="categoria6">
                        <label for="categoria6">Termogênico</label>
                        <input value="Vitaminas" class="ml-3" type="radio" name="categoria" id="categoria7">
                        <label for="categoria7">Vitaminas</label>
                    </div>
                    </div>

            
            <div class="form-row mt-2">
                <div class="form-group col-md-12">
                    <label for="descricao">Descrição: </label>
                    <textarea wrap="soft" placeholder="Digite sua descrição aqui" required="required" class="form-control"
                        name="descricao" id="descricao" cols="100" rows="10"></textarea>
                </div>
            </div>
            <div class="form-row justify-content-center">
                <div class="form-group col-md-9">

                    <input class="form-control btn btn-success" type="submit" value="Cadastrar">
                </div>
            </div>

        </form>


    </div>
    <!--Footer-->
    <?php require_once("componentes/footer.php"); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
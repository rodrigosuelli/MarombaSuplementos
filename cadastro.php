<?php
require 'init.php';
session_start();
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

    <title>Cadastro de Clientes</title>
    <!--Fav icon -->
    <link rel="icon" href="https://images2.imgbox.com/84/a1/MTumKAVt_o.png">
</head>

<body>
<!--HEADER-->
<?php require_once("componentes/header.php"); ?>
<!--CORPO-->
<div class="container">
    <h1 class="mb-2 mt-3 text-center">Cadastro de Cliente</h1>


    <form action="cadastrar.php" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome: </label>
                <input placeholder="Nome" required="required" class="form-control" type="text" name="nome">
            </div>

            <div class="form-group col-md-6">
                <label for="nome">Sobrenome: </label>
                <input placeholder="Sobrenome" class="form-control" type="text" name="sobrenome">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="imagem">Email:</label>
                <input placeholder="Email" required="required" class="form-control" type="email" name="email">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="senha">Senha: </label>
                <input placeholder="Senha" required="required" class="form-control" type="password" minlength="6" name="senha">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="rg">RG: </label>
                <input placeholder="RG" class="form-control" type="text" name="rg">
            </div>

            <div class="form-group col-md-6">
                <label for="cpf">CPF: </label>
                <input placeholder="CPF" class="form-control" type="text" name="cpf">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="imagem">Endereço:</label>
                <input placeholder="Endereço" class="form-control" type="text" name="endereco">
            </div>
        </div>

        <div class="form-row justify-content-center">
            <div class="form-group col-md-9">
                <input class="form-control btn btn-success mt-3" type="submit" value="Criar Conta">
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
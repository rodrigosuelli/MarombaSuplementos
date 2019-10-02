<?php
require 'init.php';
session_start();
// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
// valida o ID
if (empty($id)) {
    echo "ID para alteração não definido";
    exit;
}
// busca os dados do usuário a ser editado
$PDO = db_connect();
$sql = "SELECT nome, descricao, preco, quantidade, categoria, imagem FROM Produtos WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$Produtos = $stmt->fetch(PDO::FETCH_ASSOC);
// se o método fetch() não retornar um array, significa que o ID não corresponde 
// a um usuário válido
if (!is_array($Produtos)) {
    echo "Nenhum produto encontrado";
    exit;
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

    <title>Edição de Produtos</title>
    <!--Fav icon -->
    <link rel="icon" href="https://images2.imgbox.com/84/a1/MTumKAVt_o.png">
</head>

<body>
    <!--HEADER-->
    <?php require_once("componentes/header.php"); ?>
    <!--CORPO-->
    <div class="container">
        <h1 class="mb-2 mt-3 text-center">Edição de Produtos</h1>


        <form action="edit.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="nome">Nome: </label>
                    <input value="<?php echo $Produtos['nome'] ?>" placeholder="Nome" required="required"
                        class="form-control" type="text" name="nome" id="nome">
                </div>


                <div class="form-group col-md-2">
                    <label for="preco">Preço: </label>
                    <input value="<?php echo $Produtos['preco']?>" required="required" class="form-control"
                        type="number" step="0.01" min="0" max="10000" name="preco" id="preco">
                </div>


                <div class="form-group col-md-2">
                    <label for="quantidade">Quantidade: </label>
                    <input value="<?php echo $Produtos['quantidade'] ?>" required="required" class="form-control"
                        type="number" name="quantidade" id="quantidade">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="imagem">Link da Imagem:</label>
                    <input value="<?php echo $Produtos['imagem'] ?>" placeholder="Link" required="required"
                        class="form-control" type="text" name="imagem" id="imagem">
                </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <p>Categoria:</p>
                        <input <?php if ($Produtos['categoria']=="Proteínas"){echo "checked";}?> value="Proteínas" class="" type="radio" name="categoria" id="categoria1"> 
                        <label for="categoria1">Proteínas</label>
                        <input <?php if ($Produtos['categoria']=="Aminoácidos"){echo "checked";}?>value="Aminoácidos" class="ml-3" type="radio" name="categoria" id="categoria2">
                        <label for="catego3ria2">Aminoácidos</label>
                        <input <?php if ($Produtos['categoria']=="Carboidratos"){echo "checked";}?> value="Carboidratos" class="ml-3" type="radio" name="categoria" id="categoria3">
                        <label for="categoria3">Carboidratos</label>
                        <input <?php if ($Produtos['categoria']=="Vegetarianos"){echo "checked";}?> value="Vegetarianos" class="ml-3" type="radio" name="categoria" id="categoria4">
                        <label for="categoria4">Vegetarianos</label>
                        <input <?php if ($Produtos['categoria']=="Vegano"){echo "checked";}?> value="Vegano" class="ml-3" type="radio" name="categoria" id="categoria5">
                        <label for="categoria5">Vegano</label>
                        <input <?php if ($Produtos['categoria']=="Termogênico"){echo "checked";}?> value="Termogênico" class="ml-3" type="radio" name="categoria" id="categoria6">
                        <label for="categoria6">Termogênico</label>
                        <input <?php if ($Produtos['categoria']=="Vitaminas"){echo "checked";}?> value="Vitaminas" class="ml-3" type="radio" name="categoria" id="categoria7">
                        <label for="categoria7">Vitaminas</label>
                    </div>
                    </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="descricao">Descrição: </label>
                        <textarea wrap="soft" placeholder="Digite sua descrição aqui" required="required" class="form-control"
                            name="descricao" id="descricao" cols="100" rows="10"><?php echo $Produtos['descricao'];?></textarea>
                    </div>
                </div>

                <div class="form-row justify-content-center">
                    <div class="form-group col-md-9">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input class="form-control btn btn-success" type="submit" value="Alterar">
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
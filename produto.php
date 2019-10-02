<?php
require_once 'init.php';
session_start();
// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
// valida o ID
if (empty($id)) {
    echo "ID para alteração não definido";
    exit;
}

$PDO = db_connect();
$sql = "SELECT id, nome, preco, quantidade, descricao, imagem FROM Produtos WHERE id=:id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$Produtos = $stmt->fetch(PDO::FETCH_ASSOC);
// se o método fetch() não retornar um array, significa que o ID não corresponde 
// a um usuário válido
//CONVERTER PONTO EM VÍRGULA
$preco_convertido = str_replace('.', ',', $Produtos['preco']); ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="css/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="css/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">

    <!--SEMANTIC DIVIDER-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/divider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/rating.min.css">
    <link rel="stylesheet" href="">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Icones -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Meu CSS -->
    <link rel="stylesheet" href="css/estilo.css">

    <title>Maromba Suplementos</title>
    <!--Fav icon -->
    <link rel="icon" href="https://images2.imgbox.com/84/a1/MTumKAVt_o.png">
</head>

<body>
    <!--HEADER-->
    <?php require_once("componentes/header.php"); ?>
    <!--CORPO-->
    <div class="mt-3 container-fluid" id="card-produto">
        <div class="card semborda mb-5">
            <div class="row no-gutters">
           
                <div class="col-sm-5 text-center">
                    <img class="card-img mt-2 mb-2 rounded"
                        src="<?php echo $Produtos['imagem']?>"
                        alt="...">
                </div>
                <div class="col-sm-7">
                    <h4 class="mt-2"><?php echo $Produtos['nome']?></h4>
                    <div class="ui divider"></div>
                    <div class="ui massive star rating" data-rating="4" data-max-rating="5"></div>
                    <h5 class="mt-3">Vendido e entregue por <b id="roxo">Maromba Suplementos</b></h5>
                    <h4 class="mt-3 mb-3">Por apenas: <b class="text-success">R$ <?php echo $preco_convertido?></b> à vista</h4>

                    <form action="form-carrinho.php" method="get">
                    <div class="form-row align-items-center">
                    <div class="form-group col-sm-2">
                    <label for="quantidade">Quantidade: </label>
                    <input required="required" class="form-control" type="number" value="1" min="1" max="10" name="qtd_pedida" id="qtd_pedida">
                    </div>
                    <div class="form-group col">
                    
                    <!-- <a id="a-comprar" href="form-carrinho.php?id=<?php //echo $Produtos['id']?>">
                     <button id="comprar" class="mt-4 btn btn-success btn-lg">
                    <b>COMPRAR</b>
                    </button></a> -->
                    <input type="hidden" name="id" id="id" value="<?php echo $id?>">
                        <input type="hidden" name="preco" id="preco" value="<?php echo $Produtos['preco']?>">
                    <input class="form-control mt-4 ml-2 btn btn-success btn-lg" id="a-comprar" type="submit" value="COMPRAR">
                    </div>
                </div>
                </div>
                </form>
            </div>
        </div>   
        <!--DESCRIÇÃO-->
        <div class="card comborda">
  <h5 class="card-header" id="descricao">DESCRIÇÃO</h5>
  <div class="card-body">
    <h5 class="card-text">
    <textarea id="areadesc" wrap="soft" maxlength="5" class="form-control-plaintext" readonly name="descricao" cols="125" rows="10" ><?php echo $Produtos['descricao'];?></textarea>
    </h5>
  </div>
</div>
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
    <script src="css/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/rating.min.js"></script>
    <!--------------------------------------------------------------------->
    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                margin: 0,
                loop: true,
                items: 1,
                singleItem: true

            });
        });

        $('.ui.rating')
            .rating();
    </script>
</body>

</html>
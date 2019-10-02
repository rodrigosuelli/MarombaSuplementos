<?php
require_once 'init.php';
session_start();
// pega o ID da URL
$query = isset($_GET['query']) ? $_GET['query'] : null;

$query = htmlspecialchars($query); 
// valida o ID
if (empty($query)) {
    echo "pesquisa não definida";
    exit;
}

$PDO = db_connect();
$sql = "SELECT id, nome, preco, quantidade, imagem FROM Produtos 
WHERE nome LIKE '%$query%' ORDER BY nome ASC" 
or die(mysql_error());

$stmt = $PDO->prepare($sql);
$stmt->execute();
?>
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Icones -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Meu CSS -->
    <link rel="stylesheet" href="css/estilo.css">

    <title>Pesquisa <?php echo $query?></title>
    <!--Fav icon -->
    <link rel="icon" href="https://images2.imgbox.com/84/a1/MTumKAVt_o.png">
</head>

<body>
    <!--HEADER-->
    <?php require_once("componentes/header.php"); ?>
    <!--CORPO-->
    <div class="container">
        <h3 class="mb-4 mt-2 text-center">Exibindo Resultados Para "<?php echo $query;?>"</h3>
        <div class="row card-group">
        <?php while ($Produtos = $stmt->fetch(PDO::FETCH_ASSOC)){
        $Produtos['preco'] = str_replace('.', ',', $Produtos['preco']); ?>

        <div class="col-sm-4">
            <div class="card text-center semborda" style="width: 16rem;">
                <a href="produto.php?id=<?php echo $Produtos['id']?>">
                    <img src="<?php echo $Produtos['imagem']?>" class="card-img-top rounded" alt="">
                    <div class="card-body">
                        <h5 class="meu-title card-title text-center"><?php echo $Produtos['nome'] ?></h5>
                        <h4 class="card-title text-center text-success"><b>R$<?php echo $Produtos['preco'] ?> à
                                vista</b></h4>

                        <button class="btn btn-success btn-block"><b>COMPRAR</b></button>
                    </div>
                </a>
            </div>
            <br>
        </div>
        <?php }?>
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
    </script>
</body>

</html>
<?php
require_once 'init.php';
session_start();
// pega o ID da URL
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;
// valida o ID
if (empty($categoria)) {
    echo "categoria não definida";
    exit;
}

$PDO = db_connect();
$sql = "SELECT id, nome, preco, quantidade, imagem FROM Produtos WHERE categoria=:categoria ORDER BY nome ASC";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':categoria', $categoria);
$stmt->execute();
$Produtos = $stmt->fetch(PDO::FETCH_ASSOC);

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

    <title>Suplementos <?php echo $categoria?></title>
    <!--Fav icon -->
    <link rel="icon" href="https://images2.imgbox.com/84/a1/MTumKAVt_o.png">
</head>

<body>
    <!--HEADER-->
    <?php require_once("componentes/header.php"); ?>
    <!--CORPO-->
    <div id="owl-demo" class="owl-carousel owl-theme">

        <div class="item"><img src="https://www.gsuplementos.com.br/upload/banner/280fbc700486c45d5a07720fed461c04.jpg"
                alt=""></div>
        <div class="item"><img src="https://www.gsuplementos.com.br/upload/banner/39bb1faace27c538f829d576172c95c8.jpg"
                alt=""></div>
        <div class="item"><img src="https://www.gsuplementos.com.br/upload/banner/ba550ca9601e43e7a118fb6d4b58f6fa.jpg"
                alt=""></div>
        <div class="item"><img src="https://www.gsuplementos.com.br/upload/banner/4f3812034d4e783cd57a911d4b62934d.jpg"
                alt=""></div>
        <div class="item"><img src="https://www.gsuplementos.com.br/upload/banner/79a8c20fe4cfde5a5e680fc433709963.jpg"
                alt=""></div>
    </div>

    <div class="container">
        <h3 class="mb-4 mt-2 text-center"><?php echo $categoria?></h3>



        <div class="row card-group">
            <?php for ($i=0; $i <= 12; $i++) { 
            if ($Produtos = $stmt->fetch(PDO::FETCH_ASSOC)){ 
                //CONVERTER PONTO EM VÍRGULA
                $Produtos['preco'] = str_replace('.', ',', $Produtos['preco']);?>


            <div class="col-sm-4">
                <div class="card semborda text-center" style="width: 16rem;">
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
            <?php }
        }; ?>

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
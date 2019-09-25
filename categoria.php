<?php
require_once 'init.php'; 
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
    <header>
        <nav class="navbar navbar-expand navbar-light" id="nav">
            <div class="row align-items-center">
                <div class="col-2">
                    <a class="navbar-brand pulse animated" href="index.php" id="logo">
                        <img src="https://images2.imgbox.com/41/d0/ivqOnSg2_o.png" width="85%"
                            class="d-inline-block align-top ml-5" alt="logo">
                    </a>
                </div>

                <div class="col-6">
                <form class="form-inline" action="pesquisa.php" method="GET">
                        <div class="input-group ml-4">
                            <input name="query" id="search" class="form-control" type="search"
                                placeholder="Pesquisar produtos" aria-label="Search">
                            <div class="input-group-append">
                                <button value="Search" type="submit" class="btn btn-light" id="searchbtn"><a href=""
                                        id="search-icon"><i class="material-icons md-24">search</i></a>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col ml-5">
                    <a id="login" href=""><i class="material-icons md-36">emoji_people</i><b>Faça login</b></a>
                </div>
                <div class="col">
                    <a href="carrinho.php" id="cart"><i class="material-icons md-36">shopping_cart</i></a>
                </div>
        </nav>
        <nav class="navbar navbar-expand navbar-light" id="nav2">
            <div class="row justify-content-center">
                <div class="col"><a class="nav-link" href="categoria.php?categoria=Proteínas">Proteínas</a></div>
                <div class="col"><a class="nav-link" href="categoria.php?categoria=Aminoácidos">Aminoácidos</a></div>
                <div class="col"><a class="nav-link" href="categoria.php?categoria=Carboidratos">Carboidratos</a></div>
                <div class="col"><a class="nav-link" href="categoria.php?categoria=Vegetarianos">Vegetarianos</a></div>
                <div class="col"><a class="nav-link" href="categoria.php?categoria=Vegano">Vegano</a></div>
                <div class="col"><a class="nav-link" href="categoria.php?categoria=Termogênico">Termogênico</a></div>
                <div class="col"><a class="nav-link" href="categoria.php?categoria=Vitaminas">Vitaminas</a></div>
            </div>
        </nav>
    </header>
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
    <footer class="py-5 mt-4">
        <div class="container text-white">
            <div class="row" id="footer-row">
                <div class="col-3">
                    <h6>Produtos</h6>
                    <ul class="list-group">
                        <li><a href="categoria.php?categoria=Proteínas">Proteínas</a></li>
                        <li><a href="categoria.php?categoria=Aminoácidos">Aminoácidos</a></li>
                        <li><a href="categoria.php?categoria=Carboidratos">Carboidratos</a></li>
                        <li><a href="categoria.php?categoria=Vegetarianos">Vegetarianos</a></li>
                        <li><a href="categoria.php?categoria=Vegano">Vegano</a></li>
                        <li><a href="categoria.php?categoria=Termogênico">Termogênico</a></li>
                        <li><a href="categoria.php?categoria=Vitaminas">Vitaminas</a></li>
                    </ul>
                </div>
                <div class="col-3 divided">
                    <h6>Alunos</h6>
                    <ul class="list-group">
                        <li>Rodrigo</li>
                        <li>Eusébio</li>
                        <li>Lucas</li>
                        <li>Gabriel Santim</li>
                    </ul>
                </div>
                <div class="col-6 divided">
                    <h6 class="text-center">Copyright © Maromba Suplementos 2019</h6><br>
                    <p class="text-center">Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>
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
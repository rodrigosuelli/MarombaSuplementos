<?php
session_start();
$conn=mysqli_connect("localhost","root","","bd_maromba");
        // Check connection
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 12;
$offset = ($pageno-1) * $no_of_records_per_page;
$total_pages_sql = "SELECT COUNT(*) FROM Produtos";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM Produtos ORDER BY nome ASC LIMIT $offset, $no_of_records_per_page";

$res_data = mysqli_query($conn,$sql);

$stmt = $conn->prepare($sql);
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

    <title>Maromba Suplementos</title>
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
        <h3 class="mb-4 mt-2 text-center" id="tit">NOSSOS PRODUTOS (A-Z)</h3>

        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-md justify-content-center">
                <li class="<?php if($pageno <= 1) echo 'disabled'; else echo 'page-item'; ?>">
                    <a style="background-color: #4b0d77" id="pagelink" class="page-link" href="<?php if($pageno <= 1){ echo '#'; }
    else { echo "?pageno=".($pageno - 1); } ?>#tit">Previous</a></li>


                <li class="page-item"><a <?php if ($pageno==1) echo "style=\"background-color: #4b0d77;\""?> class="page-link" href="?pageno=1#tit">1</a></li>
                <li class="page-item"><a <?php if ($pageno==2) echo "style=\"background-color: #4b0d77;\""?> class="page-link" href="?pageno=2#tit">2</a></li>
                <li class="page-item"><a <?php if ($pageno==3) echo "style=\"background-color: #4b0d77;\""?> class="page-link" href="?pageno=3#tit">3</a></li>
                <li class="page-item"><a <?php if ($pageno==4) echo "style=\"background-color: #4b0d77;\""?> class="page-link" href="?pageno=4#tit">4</a></li>
                <li class="page-item"><a <?php if ($pageno==5) echo "style=\"background-color: #4b0d77;\""?> class="page-link" href="?pageno=5#tit">5</a></li>
                <li class="page-item"><a <?php if ($pageno==6) echo "style=\"background-color: #4b0d77;\""?> class="page-link" href="?pageno=6#tit">6</a></li>
                <li class="<?php if($pageno <= $total_pages) echo 'disabled'; else echo 'page-item'; ?>"><a style="background-color: #4b0d77"
                        id="pagelink2" class="page-link"
                        href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>#tit">Next</a>
                </li>
            </ul>
        </nav>


        <div class="row card-group">
            <?php 
            while ($Produtos = mysqli_fetch_array($res_data)){ ?>
            <?php //CONVERTER PONTO EM VÍRGULA
         $Produtos['preco'] = str_replace('.', ',', $Produtos['preco']); ?>

            <div class="col-sm-4">
                <div class="card text-center semborda" style="width: 16rem;">
                    <a href="produto.php?id=<?php echo $Produtos['id']?>">
                        <img src="<?php echo $Produtos['imagem']?>" class="card-img-top rounded" alt="">
                        <div class="card-body">
                            <h5 class="meu-title card-title text-center"><?php echo $Produtos['nome']?></h5>
                            <h4 class="card-title text-center text-success"><b>R$<?php echo $Produtos['preco']?> à
                                    vista</b></h4>

                            <button class="btn btn-success btn-block"><b>COMPRAR</b></button>
                        </div>
                    </a>
                </div>
                <br>
            </div>
            <?php }
        ; mysqli_close($conn);
        ?>

        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-md justify-content-center">
                <li class="<?php if($pageno <= 1) echo 'disabled'; else echo 'page-item'; ?>">
                    <a class="page-link" id="pagelink" href="<?php if($pageno <= 1){ echo '#'; } 
    else { echo "?pageno=".($pageno - 1); } ?>#tit">Previous</a></li>
                <li class="page-item"><a class="page-link" href="?pageno=1#tit">1</a></li>
                <li class="page-item"><a class="page-link" href="?pageno=2#tit">2</a></li>
                <li class="page-item"><a class="page-link" href="?pageno=3#tit">3</a></li>
                <li class="page-item"><a class="page-link" href="?pageno=4#tit">4</a></li>
                <li class="page-item"><a class="page-link" href="?pageno=5#tit">5</a></li>
                <li class="page-item"><a class="page-link" href="?pageno=6#tit">6</a></li>
                <li class="<?php if($pageno <= $total_pages) echo 'disabled'; else echo 'page-item'; ?>"><a
                        id="pagelink2" class="page-link"
                        href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>#tit">Next</a>
                </li>
            </ul>
        </nav>
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
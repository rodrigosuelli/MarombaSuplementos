<?php
require_once 'init.php';
session_start();
$PDO = db_connect();

if (isset($_SESSION['cart'])) {
    $itens_id = array_values($_SESSION['cart']['id']);
    $whereIn = implode(',', $itens_id);
    $sql = "SELECT * FROM Produtos WHERE id IN ($whereIn) ORDER BY preco desc";
    $stmt = $PDO->prepare($sql);
    $stmt->execute();}

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

    <title>Carrinho de Compras</title>
    <!--Fav icon -->
    <link rel="icon" href="https://images2.imgbox.com/84/a1/MTumKAVt_o.png">
</head>

<body>
<!--HEADER-->
<?php require_once("componentes/header.php"); ?>
<div class="container">
    <div class="row align-items-center">
        <div class="col-sm-3">
    <h3 class="mb-4 mt-3 text-left">MEU CARRINHO</h3>
        </div>
        <div class="col-sm-9 text-left">
    <a href="index.php" style="width: 40rem;" class="btn btn-secondary fundo-roxo">Continuar Comprando</a>
        </div>
    </div>
    <?php if (empty($_SESSION['cart']['id'])) { ?>
        <h3 class="mb-4 mt-2 text-center">"Nenhum produto no carrinho"</h3>
        <div class="mt-5"><br><br><br><br><br><br><br></div>
        <div class="mt-5"><br><br><br><br><br><br><br></div>
        <div class="mt-5"><br><br><br><br><br><br><br><br><br></div>
    <?php }else{ ?>
    <div class="row">
        <div class="col-8">
            <table class="table table-responsive-md">
                <thead class="table-bordered">
                <tr>
                    <th width="70%">Produto</th>
                    <th width="20%">Quantidade</th>
                    <th>Preço</th>
                </tr>
                </thead>
                <?php while ($Produtos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //CONVERTER PONTO EM VÍRGULA
                ?>
                <tbody>
                <tr>
                    <td>
                        <div class="row">
                            <div class="col-5">
                                <img class="card-img-cart rounded float-left"
                                     src="<?php echo $Produtos['imagem'] ?>" alt=#"">
                            </div>
                            <div class="col-7">
                                <a id="link_prod_carrinho" href="produto.php?id=<?php echo $Produtos['id'] ?>">
                                    <p class="text-center font-weight-bold"><?php echo $Produtos['nome'] ?></p>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row justify-content-center">

                            <a href="mudar-quantidade.php?valor=-1&id=<?php echo $Produtos['id']; ?>" id="btn-carrinho"
                               class="btn btn-secondary mr-3 font-weight-bold  btn-sm">
                                -
                            </a>
                            <p style="font-size: 1.2rem;" class="font-weight-bold">
                                <?php
                                $id_prod = $Produtos['id'];
                                $key = array_search($id_prod, $_SESSION['cart']['id']);
                                echo $_SESSION['cart']['qtd'][$key] ?>
                            </p>

                            <a href="mudar-quantidade.php?valor=1&id=<?php echo $Produtos['id']; ?>" id="btn-carrinho"
                               class="btn btn-secondary ml-3 font-weight-bold  btn-sm">+</a>


                        </div>
                        <div class="row justify-content-center">
                            <a class="text-danger font-weight-bold mt-2"
                               href="remove-carrinho.php?id=<?php echo $Produtos['id'] ?>"
                               onclick="return confirm('Tem certeza de que deseja remover?');">
                                Remover
                            </a></div>
                    </td>
                    <td><p class="text-center font-weight-bold">
                            <?php
                            $_SESSION['cart']['preco'][$key] = $Produtos['preco'] * $_SESSION['cart']['qtd'][$key];
                            $preco_convertido = str_replace('.', ',', $_SESSION['cart']['preco'][$key]);
                            echo "R$" . $preco_convertido;
                            ?>
                        </p></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>


        <div class="col-4">
            <table class="table table-bordered table-responsive-md sombra_elegante">
                <thead>
                <tr>
                    <th style="font-size: 1.15rem" class="text-center">Resumo do Pedido</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <?php
                        $valorTotal=array_sum($_SESSION['cart']['preco']);
                        $valorTotal_convertido = str_replace('.', ',', $valorTotal);

                        ?>
                        <p style="font-size: 1.3rem;" class="font-weight-bold">Valor Total: <b style="font-size: 1.5rem;" class="text-success ml-3">R$ <?php echo $valorTotal_convertido;?></b></p>
                    </td>
                </tr>
                </tbody>
            </table>

            <?php if (isset($_SESSION['logado'])){?>
                <a href="finalizar-pedido.php" class="btn btn-success btn-block">
                    FINALIZAR PEDIDO
                </a>
            <?php }else{?>
                <a href="finalizar-pedido.php" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalExemplo1">
                    FINALIZAR PEDIDO
                </a>
                <!-- Modal -->
                <div class="modal fade" id="modalExemplo1" tabindex="-1" role="dialog" aria-labelledby="TituloModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="TituloModal">Faça Login</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="login.php" method="post">
                                    <div class="form-row justify-content-center">
                                        <div class="col-md-5">
                                            <div class="text-center">
                                                <img src="https://images2.imgbox.com/84/a1/MTumKAVt_o.png" alt="icone" width="75%">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-7 align-itens-center">
                                            <label class="mt-3" for="email">Email: </label>
                                            <input placeholder="Email" required="required" class="form-control" type="email" name="email"
                                                   id="email">
                                            <label class="mt-2" for="email">Senha: </label>
                                            <input placeholder="Senha" required="required" class="form-control" type="password" minlength="6" name="senha"
                                                   id="senha">
                                            <button type="submit" style="width: 25rem" id="btn-login" class="btn btn-primary mt-4 ml-4">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" style="width: 25rem" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <a href="cadastro.php"><button type="button" style="width: 25rem" class="btn btn-success">Criar Conta</button></a>

                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
        <?php }
        ?>
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

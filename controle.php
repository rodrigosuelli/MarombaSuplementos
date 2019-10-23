<?php
require_once 'init.php';
session_start();
// abre a conexão
$PDO = db_connect();
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), 
// mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
$sql_count = "SELECT COUNT(*) AS 'total' FROM Produtos ORDER BY nome ASC";

// SQL para selecionar os registros
$sql = "SELECT id, nome, preco, quantidade FROM Produtos ORDER BY id ASC";

// conta o total de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();

// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->execute();

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

    <title>Controle de Estoque</title>
    <!--Fav icon -->
    <link rel="icon" href="https://images2.imgbox.com/84/a1/MTumKAVt_o.png">
</head>

<body>
    <!--HEADER-->
    <?php require_once("componentes/header.php"); ?>
    <!--CORPO-->
    <div class="container text-center">
        <h1 class="mb-4 mt-3">Controle de Estoque</h1>
        <div class="row">
            <div class="col-sm-2">
                <h5>Produtos : <?php echo $total ?></h5>
                <button class="btn btn-success"><a href="form-add.php" id="addproduto">Adicionar Produto</a></button>
                <?php if ($total > 0): ?>
            </div>
            <div class="col-10">
                <table class="table table-bordered table-responsive-md table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th style="width:15%">Quantidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($Produtos = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo $Produtos['id'] ?></td>
                            <td><?php echo $Produtos['nome'] ?></td>
                            <td><?php echo $Produtos['preco'] ?></td>
                            <td><?php echo $Produtos['quantidade'] ?></td>
                            <td>
                                <a href="form-edit.php?id=<?php echo $Produtos['id'] ?>">Editar</a>
                                <a href="delete.php?id=<?php echo $Produtos['id'] ?>"
                                    onclick="return confirm('Tem certeza de que deseja remover?');">
                                    Remover
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p>Nenhum Produto no Estoque</p>
                <?php endif; ?>
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
</body>

</html>
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
                                                                                                         id="search-icon"><i
                                            class="material-icons md-24">search</i></a>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <?php if (isset($_SESSION['logado'])){?>
            <div class="col">
                <a id="login">
                    <i class="material-icons md-36 pulse animated">emoji_people</i><b>Olá <?php echo $_SESSION['logado']['nome'];?></b></a>
            </div>
                <div class="col">
                <a id="login" href="logout.php">
                    <i class="material-icons md-36"></i><b>Logout</b></a>
            </div>
            <?php }else{?>
            <div class="col ml-5">
                <a id="login" href="#" data-toggle="modal" data-target="#modalExemplo">
                    <i class="material-icons md-36 pulse animated">emoji_people</i><b>Olá, Faça Login</b></a>
            </div>
                <!-- Modal -->
                <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModal" aria-hidden="true">
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
            <?php } ?>
            <div class="col">
                <a href="carrinho.php" id="cart"><i class="material-icons md-36 pulse animated">shopping_cart</i></a>
                <a id="cart"><i class="material-icons md-36">=</i></a>
                <?php if (empty($_SESSION['cart']['id'])){
                     echo "<span id=\"n_prod_carrinho\" class=\"text-white bg-light\ font-weight-bold\">0</span>";
                 }else{
                    $count = count($_SESSION['cart']['id']);
                    echo "<span id=\"n_prod_carrinho\" class=\"text-white bg-light\ font-weight-bold\">$count</span>";
                }?>
            </div>
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

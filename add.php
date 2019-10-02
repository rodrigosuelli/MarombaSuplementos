<?php
require_once 'init.php';
session_start();
// pega os dados do formuário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
$imagem = isset($_POST['imagem']) ? $_POST['imagem'] : null;
$preco = isset($_POST['preco']) ? $_POST['preco'] : null;
$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : null;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
 
// validação (bem simples, só pra evitar dados vazios)
if (empty($nome) || empty($descricao) ||empty($categoria) || empty($imagem) || empty($preco) || empty($quantidade))
{
    echo "Volte e preencha todos os campos";
    exit;
}
// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
//$isoDate = dateConvert($birthdate);
// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO Produtos(nome, descricao, preco, quantidade, categoria, imagem) 
    VALUES(:nome, :descricao, :preco, :quantidade, :categoria, :imagem)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':descricao', $descricao);
$stmt->bindParam(':imagem', $imagem);
$stmt->bindParam(':preco', $preco);
$stmt->bindParam(':categoria', $categoria);
$stmt->bindParam(':quantidade', $quantidade);


if($stmt->execute()){
    header('Location: controle.php');
}else{
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
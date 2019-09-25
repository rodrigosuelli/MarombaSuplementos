<?php
require_once 'init.php';
// resgata os valores do formulário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : null;
$imagem = isset($_POST['imagem']) ? $_POST['imagem'] : null;
$preco = isset($_POST['preco']) ? $_POST['preco'] : null;
$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : null;
$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
// validação (bem simples, mais uma vez)
if (empty($nome) || empty($imagem) || empty($categoria) || empty($descricao) || empty($preco) || empty($quantidade))
{
    echo "Volte e preencha todos os campos";
    exit;
}
// a data vem no formato dd/mm/YYYY
// então precisamos converter para YYYY-mm-dd
//$isoDate = dateConvert($birthdate);
// atualiza o banco
$PDO = db_connect();
$sql = "UPDATE Produtos SET nome = :nome, descricao = :descricao,"
        . " preco = :preco, quantidade = :quantidade, categoria= :categoria, imagem = :imagem WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':descricao', $descricao);
$stmt->bindParam(':imagem', $imagem);
$stmt->bindParam(':preco', $preco);
$stmt->bindParam(':categoria', $categoria);
$stmt->bindParam(':quantidade', $quantidade);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
if ($stmt->execute())
{
    header('Location: controle.php');
}
else
{
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}
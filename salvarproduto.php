<?php
// Sanitização dos dados recebidos via POST
$idProduto = htmlspecialchars($_POST["campoIdProduto"]);
$nome = htmlspecialchars($_POST["campoNome"]);
$precoCompra = htmlspecialchars($_POST["campoPrecoCompra"]);
$margemLucro = htmlspecialchars($_POST["campoMargemLucro"]);
$idMarca = htmlspecialchars($_POST["campoIdMarca"]);
$idUnidade = htmlspecialchars($_POST["campoIdUnidade"]);

require("ClasseProduto.php");
$objetoProduto = new ClasseProduto();

// Verifica se é para inserir um novo produto ou atualizar um existente
if ($idProduto == 0) {
    // Insere um novo produto com todos os parâmetros necessários
    $resultado = $objetoProduto->inserirProduto($nome, $precoCompra, $margemLucro, $idMarca, $idUnidade);
} else {
    // Atualiza o produto existente com todos os parâmetros
    $resultado = $objetoProduto->alterarProduto($idProduto, $nome, $precoCompra, $margemLucro, $idMarca, $idUnidade);
}

// Exibe uma mensagem e redireciona para a página de produtos
echo "<script>
    alert('$resultado');
    window.location.href='Produtos.php'; 
</script>";

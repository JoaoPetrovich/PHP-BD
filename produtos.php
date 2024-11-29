<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etec Commerce</title>
    <!-- Folha de estilos -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <!-- Ícone da aba do navegador -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <?php require("header.php"); ?>
        <main>
            <section class="listagem">
                <h1>Produtos</h1>
                <a href="produto.php?idProduto=0">
                    <button>
                        NOVO
                    </button>
                </a>

                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Preço<br>De<br>Compra</th>
                            <th>Margem<br>De<br>Lucro</th>
                            <th>Preço<br>De<br>Venda</th>
                            <th>Marca</th>
                            <th>Unidade</th>
                            <th>Comprados</th>
                            <th>Vendidos</th>
                            <th>Estoque</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require("ClasseProduto.php");
                        $objetoProduto = new ClasseProduto();
                        $listagem = $objetoProduto->listarProdutos();
                        foreach ($listagem as $linha) {
                            $idProduto = $linha["idProduto"];
                            $nome = $linha["nomeProduto"];
                            $precoCompra = $linha["precoCompra"];
                            $margemLucro = $linha["margemLucro"] . "%";
                            $precoVenda = $linha["precoVenda"];
                            $nomeMarca = $linha["nomeMarca"];
                            $nomeUnidade = $linha["nomeUnidade"];
                            $comprados = $linha["comprados"];
                            $vendidos = $linha["vendidos"];
                            $estoque = $linha["estoque"];
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($idProduto); ?></td>
                                <td><?php echo htmlspecialchars($nome); ?></td>
                                <td><?php echo $precoCompra; ?></td>
                                <td><?php echo $margemLucro; ?></td>
                                <td><?php echo $precoVenda; ?></td>
                                <td><?php echo $nomeMarca; ?></td>
                                <td><?php echo $nomeUnidade; ?></td>
                                <td><?php echo $comprados; ?></td>
                                <td><?php echo $vendidos; ?></td>
                                <td><?php echo $estoque; ?></td>
                                <td>
                                    <a href="produto.php?idProduto=<?php echo $idProduto; ?>"><button>ALTERAR</button></a>
                                    <a href="excluirproduto.php?idProduto=<?php echo $idProduto; ?>"><button>EXCLUIR</button></a>
                                    <a href="bkpproduto.php?idProduto=<?php echo $idProduto; ?>"><button>LOG</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </section>
        </main>
        <?php require("footer.php"); ?>
    </div>
</body>

</html>
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
    <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
    <!-- link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <?php require("header.php"); ?>
        <main>
            <section class="listagem">
                <h1>Unidades</h1>
                <a href="unidade.php?idUnidade=0">
                    <button>
                        NOVO
                    </button>
                </a>

                <table>
                    <thead class="tabelaHeader">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Produtos</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="itens">
                        <?php
                        require("ClasseUnidade.php");
                        $objetoUnidade = new ClasseUnidade();
                        $listagem = $objetoUnidade->listarUnidades();
                        foreach ($listagem as $linha) {
                            $idUnidade = $linha["IDUNIDADE"];
                            $nome = $linha["NOME"];
                            $produtos = $linha["PRODUTOS"];
                        ?>
                            <tr>
                                <td><?php echo $idUnidade; ?></td>
                                <td><?php echo $nome; ?></td>
                                <td><?php echo $produtos; ?></td>
                                <td>
                                    <a href="unidade.php?idUnidade=<?php echo $idUnidade; ?>"><button>ALTERAR</button></a>
                                    <a href="excluirunidade.php?idUnidade=<?php echo $idUnidade; ?>"><button>EXCLUIR</button></a>
                                    <a href="bkpunidade.php?idUnidade=<?php echo $idUnidade; ?>"><button>LOG</button></a>
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
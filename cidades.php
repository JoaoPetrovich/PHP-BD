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
    <?php require("header.php"); ?>
    <main>
        <section class="listagem">
            <h1>Cidades</h1>
            <a href="cidade.php?idCidade=0">
                <button>
                    NOVO
                </button>
            </a>

            <table>
                <thead class="tabelaHeader">
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>UF</th>
                        <th>Clientes</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="itens">
                    <?php
                    require("ClasseCidade.php");
                    $objetoCidade = new ClasseCidade();
                    $listagem = $objetoCidade->listarCidades();
                    foreach ($listagem as $linha) {
                        $idCidade = $linha["idCidade"];
                        $nome = $linha["nomeCidade"];
                        $sigla = $linha["siglaEstado"];
                        $clientes = $linha["clientesCidade"];
                    ?>
                        <tr>
                            <td><?php echo $idCidade; ?></td>
                            <td><?php echo $nome; ?></td>
                            <td><?php echo $sigla; ?></td>
                            <td><?php echo $clientes; ?></td>
                            <td>
                                <a href="cidade.php?idCidade=<?php echo $idCidade; ?>"><button>ALTERAR</button></a>
                                <a href="excluircidade.php?idCidade=<?php echo $idCidade; ?>"><button>EXCLUIR</button></a>
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
</body>

</html>
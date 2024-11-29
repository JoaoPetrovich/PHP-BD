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
                <h1>Estados</h1>
                <a href="estado.php?idEstado=0">
                    <button>
                        NOVO
                    </button>
                </a>

                <table>
                    <thead class="tabelaHeader">
                        <tr>
                            <th>#</th>
                            <th>Sigla</th>
                            <th>Nome</th>
                            <th>Cidades</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="itens">
                        <?php
                        require("ClasseEstado.php");
                        $objetoEstado = new ClasseEstado();
                        $listagem = $objetoEstado->listarEstados();
                        foreach ($listagem as $linha) {
                            $idEstado = $linha["IDESTADO"];
                            $nome = $linha["NOME"];
                            $sigla = $linha["SIGLA"];
                            $cidades = $linha["CIDADES"];
                        ?>
                            <tr>
                                <td><?php echo $idEstado; ?></td>
                                <td><?php echo $sigla; ?></td>
                                <td><?php echo $nome; ?></td>
                                <td><?php echo $cidades; ?></td>
                                <td>
                                    <a href="estado.php?idEstado=<?php echo $idEstado; ?>"><button>ALTERAR</button></a>
                                    <a href="excluirestado.php?idEstado=<?php echo $idEstado; ?>"><button>EXCLUIR</button></a>
                                    <a href="bpkestado.php?idEstado=<?php echo $idEstado; ?>"><button>LOG</button></a>
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
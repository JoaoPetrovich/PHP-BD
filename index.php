<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etec Commerce</title>
    <!-- Folha de estilos -->
    <link rel="stylesheet" href="style.css">
    <!-- Ícone da aba do navegador -->
    <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
    <!-- link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <?php require("header.php"); ?>
        <main>
            <div class="card-conteudo3">
                <div class="card01">
                    <h2 class="card-title" id="card1-title">Título do card 1</h2>
                    <button class="card-button">
                        <div class="loader"></div>
                    </button>
                </div>
                <div class="card04">
                    <div class="cards">
                        <div class="texto-div">
                            <h3>Interface amigável</h3>
                            <p>Design intuitivo, fácil navegação para todos os usuários.</p>
                        </div>
                        <div class="img-div">
                            <a href="#"><img src="./img/img.png" alt=""></a>
                        </div>
                    </div>

                    <div class="cards">
                        <div class="texto-div">
                            <h3>Segurança avançada</h3>
                            <p>Proteção total para dados de clientes e transações.</p>
                        </div>
                        <div class="img-div">
                            <a href="#"><img src="./img/img.png" alt=""></a>
                        </div>
                    </div>

                    <div class="cards">
                        <div class="texto-div">
                            <h3>Suporte 24/7</h3>
                            <p>Atendimento ao cliente disponível a qualquer hora.</p>
                        </div>
                        <div class="img-div">
                            <a href="#"><img src="./img/img.png" alt=""></a>
                        </div>
                    </div>

                    <div class="cards">
                        <div class="texto-div">
                            <h3>Variedade de produtos</h3>
                            <p>Ofereça e encontre uma vasta gama de itens.</p>
                        </div>
                        <div class="img-div">
                            <a href="#"><img src="./img/img.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php require("footer.php"); ?>
    </div>
    <script src="script.js"></script>
</body>

</html>
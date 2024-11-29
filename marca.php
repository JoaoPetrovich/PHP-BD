<?php

$idMarca = htmlspecialchars($_GET["idMarca"]);

$nome = "";

if ($idMarca != 0) {
    require("ClasseMarca.php");
    $objetoMarca = new ClasseMarca();
    $objetoMarca->consultarMarcas($idMarca);
    $nome = $objetoMarca->getNome();
}
?>

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
    <?php require("header.php"); ?>
    <main>
        <section class="formulario">
            <h1>Marca</h1>
            <form action="salvarmarca.php" class="formulario-form" method="post">
                <input type="hidden" id="campoIdMarca" name="campoIdMarca" placeholder="Id da Marca" value="<?php echo $idMarca; ?>">

                <label for="campoNome">Nome da Marca:</label>
                <input type="text" id="campoNome" name="campoNome" maxlength="50" placeholder="Nome da Marca"
                    oninput="validarNome(event)" value="<?php echo $nome; ?>" required>

                <input type="submit" value="Salvar" id="botaoSalvar" name="botaoSalvar">

            </form>
        </section>
    </main>
    <?php require("footer.php"); ?>
</body>
</html>
<script>
    // Função para validar o campoNome
    function validarNome(event) {
        const inputNome = event.target;

        // Expressão regular que permite letras (maiúsculas e minúsculas), incluindo acentuação, números e espaço.
        const regex = /^[A-Za-zÀ-ÿ0-9\s]{2,}$/;

        // Converte para maiúsculas.
        inputNome.value = inputNome.value.toUpperCase();

        // Validar se tem no mínimo 4 caracteres, permitindo letras, números e acentuação.
        if (!regex.test(inputNome.value)) {
            inputNome.setCustomValidity("O nome deve conter no mínimo 2 caracteres e pode incluir letras de A a Z, números e acentuação.");
        } else {
            inputNome.setCustomValidity(""); // Limpa qualquer mensagem de erro anterior, permitindo a submissão do formulário.
        }
    }
</script>
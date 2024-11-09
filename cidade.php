<?php
// Capturar o valor do parâmetro idCidade
$idCidade = htmlspecialchars($_GET["idCidade"]);
// Inicializar as variáveis
$nome = "";
$idEstado = 0;

if ($idCidade != 0) {
    require("ClasseCidade.php");
    $objetoCidade = new ClasseCidade();
    $objetoCidade->consultarCidades($idCidade);
    $nome = $objetoCidade->getNome();
    $idEstado = $objetoCidade->getIdEstado();
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

</body>
<?php require("header.php"); ?>
<main>
    <section class="formulario">
        <h1>Cidade</h1>
        <form action="salvarcidade.php" class="formulario-form" method="post">
            <input type="hidden" id="campoIdCidade" name="campoIdCidade" placeholder="Id da Cidade" value="<?php echo $idCidade; ?>">

            <label for="campoNome">Nome da Cidade:</label>
            <input type="text" id="campoNome" name="campoNome" maxlength="50" placeholder="Nome da Cidade" oninput="validarNome(event)" value="<?php echo $nome; ?>" required>

            <label for="campoIdEstado">UF:</label>
            <select name="campoIdEstado" id="campoIdEstado">
                <?php
                require("ClasseEstado.php");
                $objetoEstado = new ClasseEstado();
                $listagem = $objetoEstado->listarEstados();
                foreach ($listagem as $linha) {
                    $idEstadoOption = $linha["IDESTADO"];
                    $nomeOption = $linha["NOME"];
                    $selecionado = ($idEstado == $idEstadoOption) ? "SELECTED" : "";
                ?>
                    <option value="<?php echo $idEstadoOption; ?>" <?php echo $selecionado; ?>><?php echo $nomeOption; ?></option>
                <?php
                }
                ?>
            </select>

            <input type="submit" value="Salvar" id="botaoSalvar" name="botaoSalvar">

        </form>
    </section>
</main>
<?php require("footer.php"); ?>

</html>

<script>
    //Função para validar o campoNome
    function validarNome(event) {
        const inputNome = event.target;

        // Expressão regular que permite letras (maiúsculas e minúsculas), incluindo acentuação, e espaço.
        const regex = /^[A-Za-zÀ-ÿ\s]{3,}$/;

        // Converte para maiúsculas.
        inputNome.value = inputNome.value.toUpperCase();

        // Validar se tem no mínimo 4 caracteres e apenas letras e acentuação.
        if (!regex.test(inputNome.value)) {
            inputNome.setCustomValidity("O nome deve conter no mínimo 4 caracteres e apenas letras de A a Z com acentuação.");
        } else {
            inputNome.setCustomValidity("");
            // Limpa qualquer mensagem de erro anterior, permitindo a subimissão do formulário.
        }
    }
</script>
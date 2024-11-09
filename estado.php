<?php
// Capturar o valor do parâmetro idEstado
$idEstado = htmlspecialchars($_GET["idEstado"]);
// Inicializar as variáveis
$sigla = "";
$nome = "";

if ($idEstado != 0) {
    require("ClasseEstado.php");
    $objetoEstado = new ClasseEstado();
    $objetoEstado->consultarEstados($idEstado);
    $sigla = $objetoEstado->getSigla();
    $nome = $objetoEstado->getNome();
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
        <h1>Estado</h1>
        <form action="salvarestado.php" class="formulario-form" method="post">
            <input type="hidden" id="campoIdEstado" name="campoIdEstado" placeholder="Id do Estado" value="<?php echo $idEstado; ?>">

            <label for="campoSigla">Sigla:</label>
            <input type="text" id="campoSigla" name="campoSigla" maxlength="2" placeholder="Sigla do Estado" oninput="validarSigla(event)" required value="<?php echo $sigla; ?>">

            <label for="campoNome">Nome do Estado:</label>
            <input type="text" id="campoNome" name="campoNome" maxlength="50" placeholder="Nome do Estado" oninput="validarNome(event)" value="<?php echo $nome; ?>" required>

            <input type="submit" value="Salvar" id="botaoSalvar" name="botaoSalvar">

        </form>
    </section>
</main>
<?php require("footer.php"); ?>

</html>

<script>
    // Função para validar o campoSigla
    function validarSigla(event) {
        const inputSigla = event.target;
        // Armazena a referência ao elemento de entrada que gerou o evento (campo de texto da sigla) na variavel 'inputSigla'.

        const regex = /^[A-Za-z]{2}$/;
        // Define uma expressão regular (regex) que só permite dois caracteres alfabéticos (de 'A' a 'Z', tanto maiúsculas quanto minúsculas)

        inputSigla.value = inputSigla.value.toUpperCase();
        // Converte para maiúsculas
        // Converte o valor digitado no campo 'inputSigla' para letras maiúsculas e atribui de volta ao campo.

        // Validar se tem apenas duas letras 
        if (!regex.test(inputSigla.value)) {
            // Verifica se o valor do campo não corresponde ao padrão da regex.
            // Se não for exatamente duas letras alfabéticas, a validação falha.

            inputSigla.setCustomValidity("A sigla deve conter exatamente 2 letras de A a Z.");
            // Define uma mensagem personalizada de erro, que será exibida ao usuário.
        } else {
            inputSigla.setCustomValidity("");
            // Se o valor estiver correto, limpa qualquer mensagem de erro anterior, permitindo a subimissão do formulário.
        }
    }

    //Função para validar o campoNome
    function validarNome(event) {
        const inputNome = event.target;

        // Expressão regular que permite letras (maiúsculas e minúsculas), incluindo acentuação, e espaço.
        const regex = /^[A-Za-zÀ-ÿ\s]{4,}$/;

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
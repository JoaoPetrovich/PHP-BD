<?php
$idUnidade = htmlspecialchars($_POST["campoIdUnidade"]);
$nome = htmlspecialchars($_POST["campoNome"]);
require("ClasseUnidade.php");
$objetoUnidade = new ClasseUnidade();
if ($idUnidade == 0) {
    $resultado = $objetoUnidade->inserirUnidade($nome);
} else {
    $resultado = $objetoUnidade->alterarUnidade($idUnidade, $nome);
}
echo "<script> alert('$resultado'); window.location.href='unidades.php'; </script>";

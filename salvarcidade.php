<?php
$idCidade = htmlspecialchars($_POST["campoIdCidade"]);
$nome = htmlspecialchars($_POST["campoNome"]);
$idEstado = htmlspecialchars($_POST["campoIdEstado"]);
require("ClasseCidade.php");
$objetoCidade = new ClasseCidade();
if ($idCidade == 0) {
    $resultado = $objetoCidade->inserirCidade($nome, $idEstado);
} else {
    $resultado = $objetoCidade->alterarCidade($idEstado, $idCidade, $nome);
}
echo "<script> alert('$resultado'); window.location.href='cidades.php'; </script>";

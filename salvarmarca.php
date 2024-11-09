<?php
$idMarca = htmlspecialchars($_POST["campoIdMarca"]);
$nome = htmlspecialchars($_POST["campoNome"]);
require("ClasseMarca.php");
$objetoMarca = new ClasseMarca();
if ($idMarca == 0) {
    $resultado = $objetoMarca->inserirMarca($nome);
} else {
    $resultado = $objetoMarca->alterarMarca($idMarca, $nome);
}
echo "<script> alert('$resultado'); window.location.href='marcas.php'; </script>";

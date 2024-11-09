<?php
$idMarca = htmlspecialchars($_GET["idMarca"]);
require("ClasseMarca.php");
$objetoMarca = new ClasseMarca();
$resultado = $objetoMarca->excluirMarca($idMarca);
echo "<script> alert('$resultado'); window.location.href='marcas.php'; </script>";

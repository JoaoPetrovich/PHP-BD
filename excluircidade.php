<?php
$idCidade = htmlspecialchars($_GET["idCidade"]);
require("ClasseCidade.php");
$objetoCidade = new ClasseCidade();
$resultado = $objetoCidade->excluirCidade($idCidade);
echo "<script> alert('$resultado'); window.location.href='cidades.php'; </script>";

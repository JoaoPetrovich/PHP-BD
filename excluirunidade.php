<?php
$idUnidade = htmlspecialchars($_GET["idUnidade"]);
require("ClasseUnidade.php");
$objetoUnidade = new ClasseUnidade();
$resultado = $objetoUnidade->excluirUnidade($idUnidade);
echo "<script> alert('$resultado'); window.location.href='unidades.php'; </script>";

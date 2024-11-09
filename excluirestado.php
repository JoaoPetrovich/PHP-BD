<?php
$idEstado = htmlspecialchars($_GET["idEstado"]);
require("ClasseEstado.php");
$objetoEstado = new ClasseEstado();
$resultado = $objetoEstado->excluirEstado($idEstado);
echo "<script> alert('$resultado'); window.location.href='estados.php'; </script>";

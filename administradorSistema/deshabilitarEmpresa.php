<?php
    $idEmpresa=$_GET["id"];
    include("./conexion.php");
    $update=mysql_query("update empresa set estado='I'where idEmpresa='$idEmpresa'",$link);
    echo "La empresa se a desahabilitado con exito";
?>
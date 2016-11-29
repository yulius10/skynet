<?php
    $idEmpresa=$_GET["id"];
    include("./conexion.php");
    $update=mysql_query("update empresa set estado='A'where idEmpresa='$idEmpresa'",$link);
    echo "La empresa se a re-activado con exito";
?>
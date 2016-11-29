<?php
    $id=$_GET["id"];
    include("./conexion.php");
    $eliminar=mysql_query("delete from usuario where idUsuario='$id'",$link);
    echo "Usuario Eliminado";
?>
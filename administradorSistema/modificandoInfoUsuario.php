<?php
    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido"];
    $cargo=$_POST["cargo"];
    $permiso=$_POST["permiso"];
    $correo=$_POST["correo"];
    $id=$_POST["id"];
    include("./conexion.php");
    $update=mysql_query("update usuario set nombre='$nombre',apellido='$apellido',cargo='$cargo',permiso='$permiso',correo='$correo' where idUsuario='$id'",$link);
    echo "Se a modificado correctamente";
?>
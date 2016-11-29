<?php
    $nombre=$_POST["nombre"];
    $nit=$_POST["nit"];
    $cuentas=$_POST["cuentas"];
    $sectorEconomico=$_POST["sectorEconomico"];
    $id=$_POST["id"];
    include("./conexion.php");
    $update=mysql_query("update empresa set nombre='$nombre',nit='$nit',cantidadCuentas='$cuentas',sectorEconomico='$sectorEconomico' where idEmpresa='$id'",$link);
    header("Location:listaModificarEmpresa.php");
?>
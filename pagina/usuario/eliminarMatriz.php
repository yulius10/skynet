<?php
    session_start();
    $idMatriz=$_POST["idMatriz"];
    $motivo=$_POST["motivo"];
    $fecha=date("Y-m-d");
    include("./conexion.php");
    $consulUsu=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
    $row=mysql_fetch_array($consulUsu);
    $consultaA=mysql_query("select MAX(version) from panelcambios where idEmpresa='$row[empresa_idEmpresa]'",$link);
    $version=mysql_fetch_array($consultaA);
    $ultimaVersion=$version[0]+1;
    $insertar=mysql_query("insert into panelcambios (usuario_idUsuario,fecha,motivo,version,idEmpresa) values ('$row[idUsuario]','$fecha','Deshabilitacion de matriz','$ultimaVersion','$row[empresa_idEmpresa]')",$link);
    $updateA=mysql_query("update matrizlegal set estado='I' where idmatrizLegal='$idMatriz'",$link);
    $consultaB=mysql_query("select * from matrizlegalcomplemento where matrizLegal_idmatrizLegal='$idMatriz'",$link);
    $arregloB=mysql_fetch_array($consultaB);
    $archivo=explode("/",$arregloB["urlNorma"]);
    $urlNuevo="matricesObsoletas/".end($archivo);
    if($arregloB["urlNorma"]!=""){
        if(copy($arregloB["urlNorma"],$urlNuevo)){
            unlink($arregloB["urlNorma"]);
            $consultaC=mysql_query("select * from matrizlegalcalificacion where matrizLegal_idmatrizLegal='$idMatriz'",$link);
            $arregloC=mysql_fetch_array($consultaC);
            if($arregloC["urlCumplimiento"]!=""){
                $archivoA=explode("/",$arregloC["urlCumplimiento"]);
                $urlNuevoA="evidenciaMatricesObsoletas/".end($archivoA);
                if(copy($arregloC["urlCumplimiento"],$urlNuevoA)){
                    unlink($arregloC["urlCumplimiento"]);
                }
            }
        }
    }
    else{
        $consultaC=mysql_query("select * from matrizlegalcalificacion where matrizLegal_idmatrizLegal='$idMatriz'",$link);
        $arregloC=mysql_fetch_array($consultaC);
        if($arregloC["urlCumplimiento"]!=""){
            $archivoA=explode("/",$arregloC["urlCumplimiento"]);
            $urlNuevoA="evidenciaMatricesObsoletas/".end($archivoA);
            if(copy($arregloC["urlCumplimiento"],$urlNuevoA)){
                unlink($arregloC["urlCumplimiento"]);
            }
        }
    }
    echo "Se a deshabilitado correctamente la matriz.";
?>
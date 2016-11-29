<?php
    $nombre=$_POST["nombre"];
    $nit=$_POST["nit"];
    $cantcuentas=$_POST["cantcuentas"];
    $sector=$_POST["sector"];
    include ("./conexion.php");
    $archivo=$_FILES['archivo']['name'];
    $archivoTipo=$_FILES['archivo']['type'];
    $tamanoArchivo=$_FILES['archivo']['size'];
    $ruta="../pagina/usuario/logoEmpresas/";
    $rutaFinal="../pagina/usuario/logoEmpresas/".$archivo;
    $consulta=mysql_query("select * from empresa where nombre='$nombre'",$link);
    $num=mysql_num_rows($consulta);
    if($num>0){
        echo "Ya existe la empresa";
    }
    else{
        if($archivoTipo=="image/png"){
            if(move_uploaded_file($_FILES['archivo']['tmp_name'],$rutaFinal)){
                $insertar=mysql_query("insert into empresa (nombre,nit,cantidadCuentas,sectorEconomico,urlLogo,estado) values ('$nombre','$nit','$cantcuentas','$sector','$rutaFinal','A')",$link);
                header("Location: crearEmpresa.php");
            }
            else{
                echo "No se a podido cargar la imagen correctamente";
            }
        }
        else{
            echo "La imagen debe ser .png";
        }
    }
?>
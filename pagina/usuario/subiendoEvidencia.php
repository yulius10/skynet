<?php
    session_start();
    $idMatriz=$_POST["idMatriz"];
    include("./conexion.php");
    $consulUsu=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
    $arreUsu=mysql_fetch_array($consulUsu);
    $consultaA=mysql_query("select MAX(version) from panelcambios where idEmpresa='$arreUsu[empresa_idEmpresa]'",$link);
    $version=mysql_fetch_array($consultaA);
    $ultimaVersion=$version[0]+1;
    $consultaB=mysql_query("select * from matrizlegal where idmatrizLegal='$idMatriz'",$link);
    $arregloB=mysql_fetch_array($consultaB);
    $norma=$arregloB["normaAplicar"];
    $archivo=$_FILES['archivo']['name'];
    $archivoTipo=$_FILES['archivo']['type'];
    $tamanoArchivo=$_FILES['archivo']['size'];
    $ruta="./evidenciaMatrices/";
    $rutaFinal="./evidenciaMatrices/".$norma.".pdf";
    if($archivo!=""){
        //valida si es un archivo pdf
        $arreglo=explode(".", $archivo);
        if(!($arreglo[1]=="pdf")){
            ?>
            <script type="text/javascript">
                alert("No es un archivo PDF");
                location.href="subirEvidencia.php";
            </script>
            <?php
        }
        else{
            if(move_uploaded_file($_FILES['archivo']['tmp_name'],$rutaFinal)){
                $update=mysql_query("update matrizlegalcalificacion set urlCumplimiento='$rutaFinal' where matrizLegal_idmatrizLegal='$idMatriz'",$link);
                $fecha=date("Y-m-d");
                $insertar=mysql_query("insert into panelcambios (usuario_idUsuario,fecha,motivo,version,idEmpresa) values ('$arreUsu[idUsuario]','$fecha','Subir archivo de la matriz','$ultimaVersion','$arreUsu[empresa_idEmpresa]')",$link);
                ?>
                <script type="text/javascript">
                    alert("Se cargo correctamente la evidencia.");
                    location.href="inicio.php";
                </script>
                <?php
            }
            else {
                ?>
                <script type="text/javascript">
                    alert("Error al subir la evidencia.");
                    location.href="subirEvidencia.php";
                </script>
                <?php
            }
        }
    }
    else{
        ?>
        <script type="text/javascript">
            alert("No subio la evidencia.");
            location.href="subirEvidencia.php";
        </script>
        <?php
    }
?>
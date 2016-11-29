<?php
    session_start();
    include("./conexion.php");
    $idMatriz=$_POST["codigo"];
    $tema=$_POST["tema"];
    $subtema=$_POST["subtema"];
    $tipo=$_POST["tipo"];
    $norma=$_POST["norma"];
    $publicacion=$_POST["publicacion"];
    $fechaEmision=$_POST["fechaEmision"];
    $emisor=$_POST["emisor"];
    $descripcionNorma=$_POST["descripcionNorma"];
    $articulo=$_POST["articulo"];
    $descripcionArticulo=$_POST["descripcionArticulo"];
    $archivo=$_FILES['archivo']['name'];
    $controles=$_POST["controles"];
    $cumplimiento=$_POST["cumplimiento"];
    $evaluacion=$_POST["evaluacion"];
    $evidencia=$_POST["evidencia"];
    $proceso=$_POST["proceso"];
    $anotacion=$_POST["anotacion"];
    $url=$_POST["url"];
    $motivo=$_POST["motivo"];
    $arre=explode("/",$url);
    $fecha=date("Y-m-d");
    if($archivo!=""){
        //valida si es un archivo pdf
        $arreglo=explode(".", $archivo);
        if(!($arreglo[1]=="pdf")){
            echo "no es pdf";
        }
        else{
            $consultaEmpresa=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
            $row=mysql_fetch_array($consultaEmpresa);
            $ruta="./matricesActualizadas/".$norma."-".$row["empresa_idEmpresa"];
            if (file_exists($ruta)){
                unlink($ruta);
                $rutaFinal="./matricesActualizadas/".$norma."-".$row["empresa_idEmpresa"].".pdf";
                if(move_uploaded_file($_FILES['archivo']['tmp_name'],$rutaFinal)){
                    $updateA=mysql_query("update matrizlegal set tema='$tema',tipoNorma='$tipo',normaAplicar='$norma',subtema='$subtema' where idmatrizLegal='$idMatriz'",$link);
                    $updateB=mysql_query("update matrizlegalemisor set anoPublicacion='$publicacion',enteEmisor='$emisor',descripcionNorma='$descripcionNorma',articulo='$articulo',fechaEmision='$fechaEmision' where matrizLegal_idmatrizLegal='$idMatriz'",$link);
                    $updateC=mysql_query("update matrizlegalcalificacion set cumplimiento='$cumplimiento',evaluacionCumplimiento='$evaluacion',controlesCumplimiento='$controles',evidenciaCumplimiento='$evidencia' where matrizLegal_idmatrizLegal='$idMatriz'",$link);
                    $updateD=mysql_query("update matrizlegalcomplemento set procesoAplicacion='$proceso',urlNorma='$rutaFinal',anotaciones='$anotacion' where matrizLegal_idmatrizLegal='$idMatriz'",$link);
                    $consulUsu=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
                    $arreUsu=mysql_fetch_array($consulUsu);
                    $consultaA=mysql_query("select MAX(version) from panelcambios where idEmpresa='$arreUsu[empresa_idEmpresa]'",$link);
                    $version=mysql_fetch_array($consultaA);
                    $ultimaVersion=$version[0]+1;
                    $insertar=mysql_query("insert into panelcambios (usuario_idUsuario,fecha,motivo,version,idEmpresa) values ('$arreUsu[idUsuario]','$fecha','Modificacion de la matriz','$ultimaVersion','$arreUsu[empresa_idEmpresa]')",$link);
                    ?>
                    <script type="text/javascript">
                        alert("Modificacion correcta");
                        location.href="inicio.php";
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script type="text/javascript">
                        alert("error al subir archivo");
                        location.href="inicio.php";
                    </script>
                    <?php
                }
            }
            else{
                $consultaEmpresa=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
                $row=mysql_fetch_array($consultaEmpresa);
                $rutaFinal="./matricesActualizadas/".$norma."-".$row["empresa_idEmpresa"].".pdf";
                if(move_uploaded_file($_FILES['archivo']['tmp_name'],$rutaFinal)){
                    $updateA=mysql_query("update matrizlegal set tema='$tema',tipoNorma='$tipo',normaAplicar='$norma',subtema='$subtema' where idmatrizLegal='$idMatriz'",$link);
                    $updateB=mysql_query("update matrizlegalemisor set anoPublicacion='$publicacion',enteEmisor='$emisor',descripcionNorma='$descripcionNorma',articulo='$articulo',fechaEmision='$fechaEmision' where matrizLegal_idmatrizLegal='$idMatriz'",$link);
                    $updateC=mysql_query("update matrizlegalcalificacion set cumplimiento='$cumplimiento',evaluacionCumplimiento='$evaluacion',controlesCumplimiento='$controles',evidenciaCumplimiento='$evidencia' where matrizLegal_idmatrizLegal='$idMatriz'",$link);
                    $updateD=mysql_query("update matrizlegalcomplemento set procesoAplicacion='$proceso',urlNorma='$rutaFinal',anotaciones='$anotacion' where matrizLegal_idmatrizLegal='$idMatriz'",$link);
                    $consulUsu=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
                    $arreUsu=mysql_fetch_array($consulUsu);
                    $consultaA=mysql_query("select MAX(version) panelcambios where idEmpresa='$arreUsu[empresa_idEmpresa]'",$link);
                    $version=mysql_fetch_array($consultaA);
                    $ultimaVersion=$version[0]+1;
                    $insertar=mysql_query("insert into panelcambios (usuario_idUsuario,fecha,motivo,version,idEmpresa) values ('$arreUsu[idUsuario]','$fecha','Modificando de la matriz','$ultimaVersion','$arreUsu[empresa_idEmpresa]')",$link);
                    ?>
                    <script type="text/javascript">
                        alert("Modificacion correcta");
                        location.href="inicio.php";
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script type="text/javascript">
                        alert("error al subir archivo");
                        location.href="inicio.php";
                    </script>
                    <?php
                }
            }
        }
    }
?>
<?php
    session_start();
    $tema=$_POST['tema'];
    $subtema=$_POST['subtema'];
    $tipo=$_POST['tipo'];
    $norma=$_POST['norma'];
    $publicacion=$_POST['publicacion'];
    $fechaEmision=$_POST['fechaEmision'];
    $emisor=$_POST['emisor'];
    $descripcionNorma=$_POST['descripcionNorma'];
    $articulo=$_POST['articulo'];
    $descripcionArticulo=$_POST['descripcionArticulo'];
    $controles=$_POST['controles'];
    $cumplimiento=$_POST['cumplimiento'];
    $evaluacion=$_POST['evaluacion'];
    $evidencia=$_POST['evidencia'];
    $proceso=$_POST['proceso'];
    $anotacion=$_POST['anotacion'];
    $fecha=date("Y-m-d H:i:s");
    include("./conexion.php");
    $archivo=$_FILES['archivo']['name'];
    $archivoTipo=$_FILES['archivo']['type'];
    $tamanoArchivo=$_FILES['archivo']['size'];
    $ruta="./matricesActualizadas/";
    
    $consultaEmpresa=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
    $row=mysql_fetch_array($consultaEmpresa);
    $rutaFinal="./matricesActualizadas/".$norma."-".$row["empresa_idEmpresa"].".pdf";
    //valida si subio un archivo
    if($archivo!=""){
        //valida si es un archivo pdf
        $arreglo=explode(".", $archivo);
        if(!($arreglo[1]=="pdf")){
            ?>
            <script type="text/javascript">
                alert("No es un archivo pdf.");
                location.href="insertar.php";
            </script>
            <?php
        }
        else{
            if(move_uploaded_file($_FILES['archivo']['tmp_name'],$rutaFinal)){
                $consultaB=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
                $arregloB=mysql_fetch_array($consultaB);
                $insertarA=mysql_query("insert into matrizlegal (usuario_idUsuario,tema,tipoNorma,normaAplicar,fecha,estado,subtema,idEmpresa) values('$arregloB[idUsuario]','$tema','$tipo','$norma','$fecha','A','$subtema','$arregloB[empresa_idEmpresa]')",$link);
                $consultaA=mysql_query("select * from matrizlegal where fecha='$fecha'",$link);
                $arregloA=mysql_fetch_array($consultaA);
                $insertarB=mysql_query("insert into matrizlegalemisor (matrizLegal_idmatrizLegal,anoPublicacion,enteEmisor,descripcionNorma,articulo,fechaEmision) values ('$arregloA[0]','$publicacion','$emisor','$descripcionNorma','$articulo','$fechaEmision')",$link);
                $insertarC=mysql_query("insert into matrizlegalcomplemento (matrizLegal_idmatrizLegal,procesoAplicacion,urlNorma,anotaciones,descripcionArticulo) values ('$arregloA[0]','$proceso','$rutaFinal','$anotacion','$descripcionArticulo')",$link);
                $insertarD=mysql_query("insert into matrizlegalcalificacion (matrizLegal_idmatrizLegal,cumplimiento,evaluacionCumplimiento,controlesCumplimiento,evidenciaCumplimiento) values('$arregloA[0]','$cumplimiento','$evaluacion','$controles','$evidencia')",$link);
                $fechaA=date("Y-m-d");
                $consultaC=mysql_query("select MAX(version) from panelcambios where idEmpresa='$arregloB[empresa_idEmpresa]'",$link);
                $numC=mysql_num_rows($consultaC);
                if($numC>0){
                    $arregloC=mysql_fetch_array($consultaC);
                    $version=$arregloC[0]+1;
                    $insertar=mysql_query("insert into panelcambios (usuario_idUsuario,fecha,motivo,version,idEmpresa) values ('$arregloB[idUsuario]','$fecha','Insertanto nueva matriz','$version','$arregloB[empresa_idEmpresa]')",$link);
                }
                else{
                    $insertar=mysql_query("insert into panelcambios (usuario_idUsuario,fecha,motivo,version,idEmpresa) values ('$arregloB[idUsuario]','$fecha','Insertanto nueva matriz','1','$arregloB[empresa_idEmpresa]')",$link);
                }
                ?>
                <script type="text/javascript">
                    alert("Se a guardado correctamente la matriz.");
                    location.href="insertar.php";
                </script>
                <?php
            }
            else {
                ?>
                <script type="text/javascript">
                    alert("Error al guardar matriz. archivo no subio");
                    location.href="insertar.php";
                </script>
                <?php
            }
        }
    }
    else{
        ?>
        <script type="text/javascript">
            alert("Error al guardar matriz. archivo no subio");
            location.href="insertar.php";
        </script>
        <?php
    }
?>
<?php
    session_start();
    include("./excelPHP/Classes/PHPExcel.php");
    include("./conexion.php");
    
    $consultaB=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
    $arregloB=mysql_fetch_array($consultaB);
    
    $archivo=$_FILES['archivo']['name'];
    $archivoTipo=$_FILES['archivo']['type'];
    $tamanoArchivo=$_FILES['archivo']['size'];
    
    $rutaFinal="./archivosExcel/".$archivo;
    move_uploaded_file($_FILES['archivo']['tmp_name'],$rutaFinal);
    
    $arreglo=explode(".",$archivo);
    if($arreglo[1]=="xlsx"){
        $excelReader = PHPExcel_IOFactory::createReaderForFile($rutaFinal);
	$excelObj = $excelReader->load($rutaFinal);
	$worksheet = $excelObj->getSheet(0);
	$lastRow = $worksheet->getHighestRow();
	include("conexion.php");
        $fechaHora=date("Y-m-d H:i:s");
        $fecha=date("Y-m-d");
        for ($row = 2; $row <= $lastRow; $row++) {
            $insertarA=mysql_query("insert into matrizlegal (usuario_idUsuario,tema,tipoNorma,normaAplicar,fecha,estado,subtema,idEmpresa) values ('$arregloB[idUsuario]','".$worksheet->getCell('A'.$row)->getValue()."','".$worksheet->getCell('C'.$row)->getValue()."','".$worksheet->getCell('D'.$row)->getValue()."','$fechaHora','A','".$worksheet->getCell('B'.$row)->getValue()."','$arregloB[empresa_idEmpresa]')",$link);
            $consultaA=mysql_query("select * from matrizlegal order by idmatrizLegal desc limit 1",$link);
            $arregloA=mysql_fetch_array($consultaA);
            $fechaEmi =$worksheet->getCell('F'.$row)->getValue();
            $fechanueva=str_replace(".","-",$fechaEmi);
            $arreglo=explode("-",$fechanueva);
            $fechafinal=date($arreglo[0]."-".$arreglo[1]."-".$arreglo[2]);
            $insertarB=mysql_query("insert into matrizlegalemisor (matrizLegal_idmatrizLegal,anoPublicacion,enteEmisor,descripcionNorma,articulo,fechaEmision) values ('$arregloA[idmatrizLegal]','".$worksheet->getCell('E'.$row)->getValue()."','".$worksheet->getCell('G'.$row)->getValue()."','".$worksheet->getCell('H'.$row)->getValue()."','".$worksheet->getCell('I'.$row)->getValue()."','".$fechafinal."')",$link);
            $insertarC=mysql_query("insert into matrizlegalcomplemento (matrizLegal_idmatrizLegal,procesoAplicacion,anotaciones,descripcionArticulo) values ('$arregloA[idmatrizLegal]','".$worksheet->getCell('O'.$row)->getValue()."','".$worksheet->getCell('P'.$row)->getValue()."','".$worksheet->getCell('J'.$row)->getValue()."')",$link);
            $insertarD=mysql_query("insert into matrizlegalcalificacion (matrizLegal_idmatrizLegal,cumplimiento,evaluacionCumplimiento,controlesCumplimiento,evidenciaCumplimiento) values ('$arregloA[idmatrizLegal]','".$worksheet->getCell('L'.$row)->getValue()."','".($worksheet->getCell('M'.$row)->getValue()*100)."','".$worksheet->getCell('K'.$row)->getValue()."','".$worksheet->getCell('N'.$row)->getValue()."')",$link);
        }
        $consulVersion=mysql_query("select MAX(version),fecha from panelcambios where idEmpresa='$arregloB[empresa_idEmpresa]'",$link);
        $version;
        $num=mysql_num_rows($consulVersion);
        if($num>0){
            $arreglo=mysql_fetch_array($consulVersion);
            $version=$arreglo[0]+1;
        }
        else{
            $version="1";
        }
        $insertarE=mysql_query("insert into panelcambios (usuario_idUsuario,fecha,motivo,version,idEmpresa) values ('$arregloB[idUsuario]','$fecha','Se insertaron $lastRow matrices nuevas','$version','$_SESSION[nombre]','$arregloB[empresa_idEmpresa]')",$link);
        unlink($rutaFinal);
        ?>
        <script type="text/javascript">
            alert("Las matrices se han guardado con exito");
            location.href="subirExcel.php";
        </script>
        <?php
    }
    else{
        ?>
        <script type="text/javascript">
            alert("Error el archivo no es de tipo excel");
            location.href="subirExcel.php";
        </script>
        <?php
    }
?>
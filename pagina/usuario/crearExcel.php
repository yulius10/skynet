<?php
    session_start();
    include ("./conexion.php");
    include("./excelPHP/Classes/PHPExcel.php");
    
    
    $consulAdmin=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
    $arreglo=mysql_fetch_array($consulAdmin);
    
    
    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();
    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("Codedrinks")//Autor
	->setLastModifiedBy("Administrador") //Ultimo usuario que lo modificó
	->setTitle("Matriz de requisitos legales")
	->setSubject("Matriz de requisitos legales")
	->setDescription("Matriz de requisitos legales")
        ->setKeywords("Matriz de requisitos legales")
	->setCategory("Matriz de requisitos legales");
    
    $titulosColumnas = array("Tema/factor de riesgo","Subtema","Tipo de norma","Norma No.","Anio de publicacion","Fecha de emision","Ente emisor","Descripcion de la norma","Articulo(s) aplicable(s)","Descripcion del requisito legal","Controles sugeridos que aseguran el cumplimiento","Proceso o area responsable de su aplicacion","Cumplimiento legal","Evaluacion cumplimiento","Evidencia el cumplimiento","Anotacion u observacion");
    // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1',  $titulosColumnas[0])
        ->setCellValue('B1',  $titulosColumnas[1])
        ->setCellValue('C1',  $titulosColumnas[2])
        ->setCellValue('D1',  $titulosColumnas[3])
        ->setCellValue('E1',  $titulosColumnas[4])
        ->setCellValue('F1',  $titulosColumnas[5])
        ->setCellValue('G1',  $titulosColumnas[6])
        ->setCellValue('H1',  $titulosColumnas[7])
        ->setCellValue('I1',  $titulosColumnas[8])
        ->setCellValue('J1',  $titulosColumnas[9])
        ->setCellValue('K1',  $titulosColumnas[10])
        ->setCellValue('L1',  $titulosColumnas[11])
        ->setCellValue('M1',  $titulosColumnas[12])
        ->setCellValue('N1',  $titulosColumnas[13])
        ->setCellValue('O1',  $titulosColumnas[14])
        ->setCellValue('P1',  $titulosColumnas[15]);
    
    //Se agregan los datos de los alumnos
    $consulta=mysql_query("select * from matrizlegal where idEmpresa='$arreglo[empresa_idEmpresa]' and estado='A'",$link);
    $i = 2;
    while ($row=mysql_fetch_array($consulta)) {
        $consultaA=mysql_query("select * from matrizlegalcomplemento where matrizlegal_idmatrizLegal='$row[idmatrizLegal]'",$link);
        $consultaB=mysql_query("select * from matrizlegalemisor where matrizlegal_idmatrizLegal='$row[idmatrizLegal]'",$link);
        $consultaC=mysql_query("select * from matrizlegalcalificacion where matrizlegal_idmatrizLegal='$row[idmatrizLegal]'",$link);
        $rowA=mysql_fetch_array($consultaA);
        $rowB=mysql_fetch_array($consultaB);
        $rowC=mysql_fetch_array($consultaC);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i,$row["tema"])
            ->setCellValue('B'.$i,$row["subtema"])
            ->setCellValue('C'.$i,$row["tipoNorma"])
            ->setCellValue('D'.$i,$row["normaAplicar"])
            ->setCellValue('E'.$i,$rowB["anoPublicacion"])
            ->setCellValue('F'.$i,$rowB["fechaEmision"])
            ->setCellValue('G'.$i,$rowB["enteEmisor"])
            ->setCellValue('H'.$i,$rowB["descripcionNorma"])
            ->setCellValue('I'.$i,$rowB["articulo"])
            ->setCellValue('J'.$i,$rowA["descripcionArticulo"])
            ->setCellValue('K'.$i,$rowC["controlesCumplimiento"])
            ->setCellValue('L'.$i,$rowA["procesoAplicacion"])
            ->setCellValue('M'.$i,$rowC["cumplimiento"])
            ->setCellValue('N'.$i,$rowC["evaluacionCumplimiento"])
            ->setCellValue('O'.$i,$rowC["evidenciaCumplimiento"])
            ->setCellValue('P'.$i,$rowA["anotaciones"]);
        $i++;
    }
    for($i = 'A'; $i <= 'D'; $i++){
        $objPHPExcel->setActiveSheetIndex(0)			
            ->getColumnDimension($i)->setAutoSize(TRUE);
    }
    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('Matriz de requisitos legales');
    // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
    $objPHPExcel->setActiveSheetIndex(0);
    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Matriz de requerimientos legales.xlsx"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
?>
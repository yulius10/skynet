<?php
    session_start();
    include ("./conexion.php");
    $consulAdmin=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
    $arreglo=mysql_fetch_array($consulAdmin);
    $idEmpre=$arreglo["empresa_idEmpresa"];
    $consulEmpre=mysql_query("select * from empresa where idEmpresa='$idEmpre'",$link);
    $consulVersion=mysql_query("select MAX(version),fecha,usuario_idUsuario from panelcambios where idEmpresa='$idEmpre'",$link);
    $a=mysql_fetch_array($consulVersion);
    $c=mysql_fetch_array($consulEmpre);
    $fecha=$a[1];
    $id=$a[2];
    $consulUsu=mysql_query("select * from usuario where idUsuario='$id'",$link);
    $arreUsu=mysql_fetch_array($consulUsu);
    include("./fpdf181/fpdf.php");
    /*
    class PDF extends FPDF{
        function Header(){
            $this->Image($_SESSION["urlLogo"],10,10,50,20,'PNG');
            $this->SetXY(100,15);
            $this->SetFont('Arial','B',18);
            $this->Cell(77,10,'Matriz de requisitos Legales');
            $this->SetXY(200,12);
            $this->SetFont('Arial','B',10);
            $this->Cell(77,10,'Código: MRL');
            $this->SetXY(230,12);
            $this->Cell(77,10,'Versión: 1');
            $this->SetXY(200,18);
            $this->Cell(77,10,'Fecha: 2016-09-01');
            $this->SetXY(12,30);
            $this->Cell(77,10,'Empresa:');
            $this->SetXY(30,30);
            $this->Cell(77,10,$_SESSION['empresa']);
            $this->SetXY(55,30);
            $this->Cell(77,10,'Sector económico:');
            $this->SetXY(88,30);
            $this->Cell(77,10,$c["sectorEconomico"]);
            $this->SetXY(12,35);
            $this->Cell(77,10,'Elaborado por:');
            $this->SetXY(38,35);
            $this->Cell(77,10,$_SESSION['nombre']);
            $this->SetXY(55,35);
            $this->Cell(77,10,'Fecha de elaboración:');
            $this->SetXY(93,35);
            $this->Cell(77,10,"2016-04-01");
            $this->SetXY(12,40);
            $this->Cell(77,10,'Actualizado por:');
            $this->SetXY(40,40);
            $this->Cell(77,10,$ultimapersona);
            $this->SetXY(55,40);
            $this->Cell(77,10,'Fecha de actualización:');
            $this->SetXY(95,40);
            $this->Cell(77,10,$fecha);
        }
    }
     * */
    $pdf=new FPDF('L','mm','A4');
    $pdf->SetTitle("Matriz legal",true);
    $pdf->AddPage();
    
    //encabezado de la pagina
    $pdf->Image($_SESSION["urlLogo"],10,10,50,20,'PNG');
    $pdf->SetXY(100,15);
    $pdf->SetFont('Arial','B',18);
    $pdf->Cell(77,10,'Matriz de requisitos Legales');
    $pdf->SetXY(200,12);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(77,10,'Código: MRL');
    $pdf->SetXY(230,12);
    $pdf->Cell(77,10,'Versión: 1');
    $pdf->SetXY(200,18);
    $pdf->Cell(77,10,'Fecha: 2016-09-01');
    $pdf->SetXY(12,30);
    $pdf->Cell(77,10,'Empresa:');
    $pdf->SetXY(30,30);
    $pdf->Cell(77,10,$_SESSION['empresa']);
    $pdf->SetXY(55,30);
    $pdf->Cell(77,10,'Sector económico:');
    $pdf->SetXY(88,30);
    $pdf->Cell(77,10,$c["sectorEconomico"]);
    $pdf->SetXY(12,35);
    $pdf->Cell(77,10,'Elaborado por:');
    $pdf->SetXY(38,35);
    $pdf->Cell(77,10,$_SESSION['nombre']);
    $pdf->SetXY(55,35);
    $pdf->Cell(77,10,'Fecha de elaboración:');
    $pdf->SetXY(93,35);
    $pdf->Cell(77,10,"2016-04-01");
    $pdf->SetXY(12,40);
    $pdf->Cell(77,10,'Actualizado por:');
    $pdf->SetXY(40,40);
    $pdf->Cell(77,10,$arreUsu["nombre"]);
    $pdf->SetXY(55,40);
    $pdf->Cell(77,10,'Fecha de actualización:');
    $pdf->SetXY(95,40);
    $pdf->Cell(77,10,$fecha);
    
    //encabezado de la tabla
    $pdf->SetXY(12,45);
    $pdf->Cell(77,10,'Tema/');
    $pdf->SetXY(35,45);
    $pdf->Cell(77,10,'Subtema');
    $pdf->SetXY(60,45);
    $pdf->Cell(77,10,'Tipo de');
    $pdf->SetXY(60,50);
    $pdf->Cell(15,10,'norma',0,1,'C');
    $pdf->SetXY(80,45);
    $pdf->Cell(77,10,'Norma No.');
    $pdf->SetXY(100,45);
    $pdf->Cell(21,10,'Año de',0,1,'C');
    $pdf->SetXY(100,50);
    $pdf->Cell(77,10,'publicación');
    $pdf->SetXY(125,45);
    $pdf->Cell(77,10,'Fecha de emisión');
    $pdf->SetXY(125,50);
    $pdf->Cell(30,10,'emisión',0,1,'C');
    $pdf->SetXY(160,45);
    $pdf->Cell(77,10,'Ente emisor');
    $pdf->SetXY(190,45);
    $pdf->Cell(77,10,'Descripción de');
    $pdf->SetXY(190,50);
    $pdf->Cell(27,10,'la norma',0,1,'C');
    $pdf->SetXY(230,45);
    $pdf->Cell(21,10,'Artículo(s)',0,1,'C');
    $pdf->SetXY(230,50);
    $pdf->Cell(77,10,'aplicable(s)');
    $pdf->SetXY(260,45);
    $pdf->Cell(21,10,'Descripción del',0,1,'C');
    $pdf->SetXY(260,50);
    $pdf->Cell(20,10,'requisito legal',0,1,'C');
        
    include("./conexion.php");
    $consulta=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
    $row=mysql_fetch_array($consulta);
    $consultaA=mysql_query("select * from matrizlegal where idEmpresa='$row[empresa_idEmpresa]' and estado='A'",$link);
    $y=55;
    while($rowA=mysql_fetch_array($consultaA)){
        $consultaB=mysql_query("select * from matrizlegalcalificacion where matrizlegal_idmatrizLegal='$rowA[idmatrizLegal]'",$link);
        $consultaC=mysql_query("select * from matrizlegalcomplemento where matrizlegal_idmatrizLegal='$rowA[idmatrizLegal]'",$link);
        $consultaD=mysql_query("select * from matrizlegalemisor where matrizlegal_idmatrizLegal='$rowA[idmatrizLegal]'",$link);
        $rowB=mysql_fetch_array($consultaB);
        $rowC=mysql_fetch_array($consultaC);
        $rowD=mysql_fetch_array($consultaD);
                        
        //contenido de la tabla
        $pdf->SetXY(12,$y);
        $pdf->Cell(77,10,$rowA["tema"]);
        $pdf->SetXY(35,$y);
        $pdf->Cell(77,10,$rowA["subtema"]);
        $pdf->SetXY(60,$y);
        $pdf->Cell(77,10,$rowA["tipoNorma"]);
        $pdf->SetXY(80,$y);
        $pdf->Cell(77,10,$rowA["normaAplicar"]);
        $pdf->SetXY(100,$y);
        $pdf->Cell(21,10,$rowD["anoPublicacion"]);
        $pdf->SetXY(125,$y);
        $pdf->Cell(77,10,$rowD["fechaEmision"]);
        $pdf->SetXY(160,$y);
        $pdf->Cell(77,10,$rowD["enteEmisor"]);
        $pdf->SetXY(190,$y);
        $pdf->Cell(77,10,$rowD["descripcionNorma"]);
        $pdf->SetXY(230,$y);
        $pdf->Cell(21,10,$rowD["articulo"]);
        $pdf->SetXY(260,$y);
        $pdf->Cell(21,10,$rowC["descripcionArticulo"]);
        $y+=5;
        if($y==175){
            $y=55;
            $pdf->AddPage();
            
            //encabezado de la pagina
            $pdf->Image($_SESSION["urlLogo"],10,10,50,20,'PNG');
            $pdf->SetXY(100,15);
            $pdf->SetFont('Arial','B',18);
            $pdf->Cell(77,10,'Matriz de requisitos Legales');
            $pdf->SetXY(200,12);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(77,10,'Código: MRL');
            $pdf->SetXY(230,12);
            $pdf->Cell(77,10,'Versión: 1');
            $pdf->SetXY(200,18);
            $pdf->Cell(77,10,'Fecha: 2016-09-01');
            $pdf->SetXY(12,30);
            $pdf->Cell(77,10,'Empresa:');
            $pdf->SetXY(30,30);
            $pdf->Cell(77,10,$_SESSION['empresa']);
            $pdf->SetXY(55,30);
            $pdf->Cell(77,10,'Sector económico:');
            $pdf->SetXY(88,30);
            $pdf->Cell(77,10,$c["sectorEconomico"]);
            $pdf->SetXY(12,35);
            $pdf->Cell(77,10,'Elaborado por:');
            $pdf->SetXY(38,35);
            $pdf->Cell(77,10,$_SESSION['nombre']);
            $pdf->SetXY(55,35);
            $pdf->Cell(77,10,'Fecha de elaboración:');
            $pdf->SetXY(93,35);
            $pdf->Cell(77,10,"2016-04-01");
            $pdf->SetXY(12,40);
            $pdf->Cell(77,10,'Actualizado por:');
            $pdf->SetXY(40,40);
            $pdf->Cell(77,10,$arreUsu["nombre"]);
            $pdf->SetXY(55,40);
            $pdf->Cell(77,10,'Fecha de actualización:');
            $pdf->SetXY(95,40);
            $pdf->Cell(77,10,$fecha);
            
            //contenido de la pagina
            $pdf->SetXY(12,45);
            $pdf->Cell(77,10,'Tema');
            $pdf->SetXY(35,45);
            $pdf->Cell(77,10,'Subtema');
            $pdf->SetXY(60,45);
            $pdf->Cell(77,10,'Tipo de');
            $pdf->SetXY(60,50);
            $pdf->Cell(15,10,'norma',0,1,'C');
            $pdf->SetXY(80,45);
            $pdf->Cell(77,10,'Norma No.');
            $pdf->SetXY(100,45);
            $pdf->Cell(21,10,'Año de',0,1,'C');
            $pdf->SetXY(100,50);
            $pdf->Cell(77,10,'publicación');
            $pdf->SetXY(125,45);
            $pdf->Cell(77,10,'Fecha de emisión');
            $pdf->SetXY(125,50);
            $pdf->Cell(30,10,'emisión',0,1,'C');
            $pdf->SetXY(160,45);
            $pdf->Cell(77,10,'Ente emisor');
            $pdf->SetXY(190,45);
            $pdf->Cell(77,10,'Descripción de');
            $pdf->SetXY(190,50);
            $pdf->Cell(27,10,'la norma',0,1,'C');
            $pdf->SetXY(230,45);
            $pdf->Cell(21,10,'Artículo(s)',0,1,'C');
            $pdf->SetXY(230,50);
            $pdf->Cell(77,10,'aplicable(s)');
            $pdf->SetXY(260,45);
            $pdf->Cell(21,10,'Descripción del',0,1,'C');
            $pdf->SetXY(260,50);
            $pdf->Cell(20,10,'requisito legal',0,1,'C');
        }
    }
    
    $pdf->AddPage();
    
    //encabezado de la pagina
    $pdf->Image($_SESSION["urlLogo"],10,10,50,20,'PNG');
    $pdf->SetXY(100,15);
    $pdf->SetFont('Arial','B',18);
    $pdf->Cell(77,10,'Matriz de requisitos Legales');
    $pdf->SetXY(200,12);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(77,10,'Código: MRL');
    $pdf->SetXY(230,12);
    $pdf->Cell(77,10,'Versión: 1');
    $pdf->SetXY(200,18);
    $pdf->Cell(77,10,'Fecha: 2016-09-01');
    $pdf->SetXY(12,30);
    $pdf->Cell(77,10,'Empresa:');
    $pdf->SetXY(30,30);
    $pdf->Cell(77,10,$_SESSION['empresa']);
    $pdf->SetXY(55,30);
    $pdf->Cell(77,10,'Sector económico:');
    $pdf->SetXY(88,30);
    $pdf->Cell(77,10,$c["sectorEconomico"]);
    $pdf->SetXY(12,35);
    $pdf->Cell(77,10,'Elaborado por:');
    $pdf->SetXY(38,35);
    $pdf->Cell(77,10,$_SESSION['nombre']);
    $pdf->SetXY(55,35);
    $pdf->Cell(77,10,'Fecha de elaboración:');
    $pdf->SetXY(93,35);
    $pdf->Cell(77,10,"2016-04-01");
    $pdf->SetXY(12,40);
    $pdf->Cell(77,10,'Actualizado por:');
    $pdf->SetXY(40,40);
    $pdf->Cell(77,10,$arreUsu["nombre"]);
    $pdf->SetXY(55,40);
    $pdf->Cell(77,10,'Fecha de actualización:');
    $pdf->SetXY(95,40);
    $pdf->Cell(77,10,$fecha);
    
    //encabezada de la tabla
    $pdf->SetXY(12,45);
    $pdf->Cell(77,10,'Controles sugeridos que');
    $pdf->SetXY(12,50);
    $pdf->Cell(40,10,'aseguran el cumplimiento',0,1,'C');
    $pdf->SetXY(60,45);
    $pdf->Cell(77,10,'Cumplimiento legal');
    $pdf->SetXY(90,45);
    $pdf->Cell(77,10,'Evaluación cumplimiento');
    $pdf->SetXY(135,45);
    $pdf->Cell(77,10,'Evidencia el cumplimiento');
    $pdf->SetXY(185,45);
    $pdf->Cell(77,10,'Proceso de área');
    $pdf->SetXY(185,50);
    $pdf->Cell(30,10,'de aplicación',0,1,'C');
    $pdf->SetXY(220,45);
    $pdf->Cell(77,10,'Anotaciones');
    
    $consultaQ=mysql_query("select * from matrizlegal where idEmpresa='$row[empresa_idEmpresa]' and estado='A'",$link);
    $yy=55;
    while($rowA=mysql_fetch_array($consultaQ)){
        $consultaB=mysql_query("select * from matrizlegalcalificacion where matrizlegal_idmatrizLegal='$rowA[idmatrizLegal]'",$link);
        $consultaC=mysql_query("select * from matrizlegalcomplemento where matrizlegal_idmatrizLegal='$rowA[idmatrizLegal]'",$link);
        $consultaD=mysql_query("select * from matrizlegalemisor where matrizlegal_idmatrizLegal='$rowA[idmatrizLegal]'",$link);
        $rowB=mysql_fetch_array($consultaB);
        $rowC=mysql_fetch_array($consultaC);
        $rowD=mysql_fetch_array($consultaD);
        
        //contenido de la tabla
        $pdf->SetXY(12,$yy);
        $pdf->Cell(77,10,$rowB["controlesCumplimiento"]);
        $pdf->SetXY(60,$yy);
        $pdf->Cell(77,10,$rowB["cumplimiento"]);
        $pdf->SetXY(90,$yy);
        $pdf->Cell(77,10,$rowB["evaluacionCumplimiento"]);
        $pdf->SetXY(135,$yy);
        $pdf->Cell(77,10,$rowB["evidenciaCumplimiento"]);
        $pdf->SetXY(185,$yy);
        $pdf->Cell(77,10,$rowC["procesoAplicacion"]);
        $pdf->SetXY(220,$yy);
        $pdf->Cell(77,10,$rowC["anotaciones"].$yy);
        
        $yy+=5;
        if($yy==175){
            $yy=55;
            $pdf->AddPage();
            
            //encabezado de la pagina
            $pdf->Image($_SESSION["urlLogo"],10,10,50,20,'PNG');
            $pdf->SetXY(100,15);
            $pdf->SetFont('Arial','B',18);
            $pdf->Cell(77,10,'Matriz de requisitos Legales');
            $pdf->SetXY(200,12);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(77,10,'Código: MRL');
            $pdf->SetXY(230,12);
            $pdf->Cell(77,10,'Versión: 1');
            $pdf->SetXY(200,18);
            $pdf->Cell(77,10,'Fecha: 2016-09-01');
            $pdf->SetXY(12,30);
            $pdf->Cell(77,10,'Empresa:');
            $pdf->SetXY(30,30);
            $pdf->Cell(77,10,$_SESSION['empresa']);
            $pdf->SetXY(55,30);
            $pdf->Cell(77,10,'Sector económico:');
            $pdf->SetXY(88,30);
            $pdf->Cell(77,10,$c["sectorEconomico"]);
            $pdf->SetXY(12,35);
            $pdf->Cell(77,10,'Elaborado por:');
            $pdf->SetXY(38,35);
            $pdf->Cell(77,10,$_SESSION['nombre']);
            $pdf->SetXY(55,35);
            $pdf->Cell(77,10,'Fecha de elaboración:');
            $pdf->SetXY(93,35);
            $pdf->Cell(77,10,"2016-04-01");
            $pdf->SetXY(12,40);
            $pdf->Cell(77,10,'Actualizado por:');
            $pdf->SetXY(40,40);
            $pdf->Cell(77,10,$arreUsu["nombre"]);
            $pdf->SetXY(55,40);
            $pdf->Cell(77,10,'Fecha de actualización:');
            $pdf->SetXY(95,40);
            $pdf->Cell(77,10,$fecha);
            
            //encabezada de la tabla
            $pdf->SetXY(12,45);
            $pdf->Cell(77,10,'Controles que aseguran');
            $pdf->SetXY(12,50);
            $pdf->Cell(40,10,'el cumplimiento',0,1,'C');
            $pdf->SetXY(60,45);
            $pdf->Cell(77,10,'Cumplimiento');
            $pdf->SetXY(90,45);
            $pdf->Cell(77,10,'Evaluación cumplimiento');
            $pdf->SetXY(135,45);
            $pdf->Cell(77,10,'Documento que evidencia');
            $pdf->SetXY(135,50);
            $pdf->Cell(45,10,' el cumplimiento',0,1,'C');
            $pdf->SetXY(185,45);
            $pdf->Cell(77,10,'Proceso de área');
            $pdf->SetXY(185,50);
            $pdf->Cell(30,10,'de aplicación',0,1,'C');
            $pdf->SetXY(220,45);
            $pdf->Cell(77,10,'Anotaciones');
        }
    }
    $pdf->Output();
?>
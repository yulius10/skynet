<?php
    session_start();
?>
<html>
    <head>
        <title>
            Inicio
        </title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
        <link rel="stylesheet" type="text/css" href="css/barraNavegacion.css" />
        <link rel="stylesheet" type="text/css" href="http://www.formmail-maker.com/var/demo/jquery-popup-form/colorbox.css" />
        <script type="text/javascript" src="js/jquery-1.4.2.min.js">
        </script>
        <script type="text/javascript" src="js/jquery.min.js">
        </script>
        <script type="text/javascript" src="js/jquery.colorbox-min.js">
        </script>
        <script type="text/javascript" src="js/iframe.js">
        </script>
        <script type="text/javascript">
            function reacargar(){
                location.href='verMatriz.php';
            }
        </script>
    </head>
    <body>
        <?php
            include './conexion.php';
            
            $condicional="";
            if($_GET){
                $condicional=$_GET["condicional"];
            }
            
            $consulAdmin=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
            $numAdmin=mysql_num_rows($consulAdmin);
            $arreglo=mysql_fetch_array($consulAdmin);
            $id=$arreglo["idUsuario"];
            $idEmpre=$arreglo["empresa_idEmpresa"];
            //consulta ultima fecha de mofidificacion y version en que va
            $version="";
            $fecha="";
            $ultimapersona="";
            $consulVersion=mysql_query("select MAX(version),fecha,usuario_idUsuario from panelcambios where idEmpresa='$idEmpre'",$link);
            $num=mysql_num_rows($consulVersion);
            $a=mysql_fetch_array($consulVersion);
            if($num>0 && $a[0]!=""){
                $version=$a[0];
                $fecha=$a[1];
            }
            else{
                $version="0";
                $fecha="No se a actualizado";
            }
            $consulUltimo=mysql_query("select * from usuario where idUsuario='$id'",$link);
            $b=mysql_fetch_array($consulUltimo);
            $numb=mysql_num_rows($consulUltimo);
            if($numb>0 && $b["nombre"]!=""){
                $ultimapersona=$b["nombre"];
            }
            else{
                $ultimapersona="No hay persona que halla modificado";
            }
            $consulEmpre=mysql_query("select * from empresa where idEmpresa='$idEmpre'",$link);
            $numVer=mysql_num_rows($consulEmpre);
            $c=mysql_fetch_array($consulEmpre);
            //suma los valores de la columna evaluacionCumplimiento de la tabla matrizlegalcalificacion
            $resultA=mysql_query("select * from matrizlegal where usuario_idUsuario='$id' and estado='A'",$link);
            $sumatoria=0;
            while($row=mysql_fetch_array($resultA)){
                $consulCali=mysql_query("select * from matrizlegalcalificacion where matrizlegal_idmatrizLegal='$row[idmatrizLegal]'",$link);
                $rowCali=mysql_fetch_array($consulCali);
                $sumatoria+=(int)$rowCali["evaluacionCumplimiento"];
            }
            $numCali=mysql_num_rows($resultA);
            if($numCali>0){
                $sumatoria=$sumatoria/$numCali;
            }
            echo "<br/>";
            include("./encabezadoA.inc");
            echo "<br/>";
        ?>
        
        <center>
            <a href="crearPdf.php">
                <img title="Descargar pdf de la matriz" src="imagenes/descargar-libro-pdf.png" width="300" height="50"/>
            </a>
            <a href="crearExcel.php">
                <img title="Descargar excel de la matriz" src="imagenes/Descargar-boton-social-locker.jpg" width="75" height="50"/>
            </a>
            <h1>
                Ver Matriz
            </h1>
        </center>
        
        <form method="get">
            <table class="tablacentrada">
                <tr>
                    <td>
                        Buscar por:
                        <select name="condicional" id="condicional" required onchange="submit();">
                            <option>
                            </option>
                            <option value="tema" <?php if($condicional=="tema"){ echo "selected"; } ?>>
                                Tema
                            </option>
                            <option value="subtema" <?php if($condicional=="subtema"){ echo "selected"; } ?>>
                                Subtema
                            </option>
                            <option value="tipo de norma" <?php if($condicional=="tipo de norma"){ echo "selected"; } ?>>
                                Tipo de norma
                            </option>
                            <option value="norma a aplicar" <?php if($condicional=="norma a aplicar"){ echo "selected"; } ?>>
                                Norma No.
                            </option>
                        </select>
                    </td>
                </tr>
            </table>
        </form>
        <form method="post">
            <table class="tablacentrada">
                <tr>
                    <td>
                        <?php
                            if($condicional=="tema"){
                                ?>
                                Tema a buscar:
                                <input type="text" name="temaB" id="temaB" value="<?php if($_POST){ echo $_POST["temaB"]; } ?>" required/>
                                <?php
                            }
                            else if($condicional=="subtema"){
                                ?>
                                Subtema a buscar:
                                <input type="text" name="subtemaB" id="subtemaB" value="<?php if($_POST){ echo $_POST["subtemaB"]; } ?>" required/>
                                <?php
                            }
                            else if($condicional=="tipo de norma"){
                                ?>
                                Tipo de norma a buscar:
                                <select name="tipoB" required>
                                    <option>
                                    </option>
                                    <option value="Acuerdo" <?php if($_POST){ if($_POST["tipoB"]=="Acuerdo"){ echo "selected"; } } ?> >
                                        Acuerdo
                                    </option>
                                    <option value="Auto" <?php if($_POST){ if($_POST["tipoB"]=="Auto"){ echo "selected"; } } ?> >
                                        Auto
                                    </option>
                                    <option value="Circular" <?php if($_POST){ if($_POST["tipoB"]=="Circular"){ echo "selected"; } } ?> >
                                        Circular
                                    </option>
                                    <option value="Concepto" <?php if($_POST){ if($_POST["tipoB"]=="Concepto"){ echo "selected"; } } ?> >
                                        Concepto
                                    </option>
                                    <option value="Constitucion" <?php if($_POST){ if($_POST["tipoB"]=="Constitucion"){ echo "selected"; } } ?> >
                                        Constituci&oacute;n
                                    </option>
                                    <option value="Decreto" <?php if($_POST){ if($_POST["tipoB"]=="Decreto"){ echo "selected"; } } ?> >
                                        Decreto
                                    </option>
                                    <option value="Ley" <?php if($_POST){ if($_POST["tipoB"]=="Ley"){ echo "selected"; } } ?> >
                                        Ley
                                    </option>
                                    <option value="Licencia" <?php if($_POST){ if($_POST["tipoB"]=="Licencia"){ echo "selected"; } } ?> >
                                        Licencia
                                    </option>
                                    <option value="Resolucion" <?php if($_POST){ if($_POST["tipoB"]=="Resolucion"){ echo "selected"; } } ?> >
                                        Resoluci&oacute;n
                                    </option>
                                    <option value="Sentencia" <?php if($_POST){ if($_POST["tipoB"]=="Sentencia"){ echo "selected"; } } ?> >
                                        Sentencia
                                    </option>
                                    <option value="Guia" <?php if($_POST){ if($_POST["tipoB"]=="Guia"){ echo "selected"; } } ?> >
                                        Gu&iacute;a
                                    </option>
                                </select>
                                <?php
                            }
                            else if($condicional=="norma a aplicar"){
                                ?>
                                Norma No. a buscar:
                                <input type="text" name="normaB"  value="<?php if($_POST){ echo $_POST["normab"]; } ?>" required/>
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="condicional" value="<?php echo $condicional; ?>"/>
                        <input type="submit" name="buscando" id="buscando" value="Buscar" onchange="submit();"/>
                    </td>
                    <td>
                        <input type="reset" name="limpiar" id="limpiar" value="limpiar" onclick="reacargar();" on/>
                    </td>
                </tr>
            </table>
        </form>
        
        <table id="tabla">
            <tr>
                <td colspan="17" class="izquierda">
                    Porcentaje de cumplimiento:
                </td>
                <td class="encabezado">
                    <?php
                        echo round($sumatoria,2)."%";
                    ?>
                </td>
            </tr>
            <tr>
                <td class="encabezado">
                    Tema/factor de riesgo
                </td>
                <td class="encabezado">
                    Subtema
                </td>
                <td class="encabezado">
                    Tipo de norma
                </td>
                <td class="encabezado">
                    Norma No.
                </td>
                <td class="encabezado">
                    A&ntilde;o de publicaci&oacute;n
                </td>
                <td class="encabezado">
                    Fecha de emisi&oacute;n
                </td>
                <td class="encabezado">
                    Ente emisor
                </td>
                <td class="encabezado">
                    Descripci&oacute;n de la norma
                </td>
                <td class="encabezado">
                    Art&iacute;culo(s) aplicable(s)
                </td>
                <td class="encabezado">
                    Descripci&oacute;n del requisito legal
                </td>
                <td class="encabezado">
                    Controles sugeridos que aseguran el cumplimiento
                </td>
                <td class="encabezado">
                    Proceso &oacute; &aacute;rea responsable de su aplicaci&oacute;n
                </td>
                <td class="encabezado">
                    Cumplimiento legal
                </td>
                <td class="encabezado">
                    Evaluaci&oacute;n cumplimiento
                </td>
                <td class="encabezado">
                    Evidencia el cumplimiento
                </td>
                <td class="encabezado">
                    Consultar norma
                </td>
                <td class="encabezado">
                    Anotaci&oacute;n u observaci&oacute;n
                </td>
                <?php
                    if($_SESSION['permiso']=="administrador"){
                ?>
                <td class="encabezado">
                    Acciones
                </td>
                <?php
                    }
                ?>
            </tr>
                <?php
                    $consultaMatriz="";
                    if(isset($_POST["buscando"])){
                        if($_POST){
                            $condicional=$_POST["condicional"];
                            
                            if($condicional=="tema"){
                                $tema=$_POST["temaB"];
                                $consultaMatriz=mysql_query("select matrizlegal.estado as Estado, matrizlegal.idmatrizLegal as idMatriLegal,matrizlegal.tema as Temas,matrizlegal.tipoNorma as tipoNoma,matrizlegal.normaAplicar as normaAplicar,matrizlegal.subtema as Subtema,matrizlegal.idEmpresa as idEmpresa,matrizlegalcomplemento.procesoAplicacion as procesoAplicacion,matrizlegalcomplemento.urlNorma as urlNorma,matrizlegalcomplemento.anotaciones as Anotaciones,matrizlegalcomplemento.descripcionArticulo as descripcionArticulo,matrizlegalemisor.anoPublicacion as anoPublicacion,matrizlegalemisor.enteEmisor as enteEmisor,matrizlegalemisor.descripcionNorma as descripcionNorma,matrizlegalemisor.articulo as Articulo,matrizlegalemisor.fechaEmision as fechaEmision,matrizlegalcalificacion.cumplimiento as Cumplimiento,matrizlegalcalificacion.evaluacionCumplimiento as evaluacionCumplimiento,matrizlegalcalificacion.controlesCumplimiento as controlesCumplimiento,matrizlegalcalificacion.evidenciaCumplimiento as evidenciaCumplimiento,matrizlegalcalificacion.urlCumplimiento as urlCumplimiento from matrizlegal,matrizlegalcalificacion,matrizlegalcomplemento,matrizlegalemisor where matrizlegal.tema='$tema' and matrizlegal.estado='A' and matrizlegalcalificacion.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and matrizlegalcomplemento.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and matrizlegalemisor.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and idEmpresa='$idEmpre'",$link);
                            }
                            else if($condicional=="subtema"){
                                $subtema=$_POST["subtemaB"];
                                $consultaMatriz=mysql_query("select matrizlegal.estado as Estado, matrizlegal.idmatrizLegal as idMatriLegal,matrizlegal.tema as Temas,matrizlegal.tipoNorma as tipoNoma,matrizlegal.normaAplicar as normaAplicar,matrizlegal.subtema as Subtema,matrizlegal.idEmpresa as idEmpresa,matrizlegalcomplemento.procesoAplicacion as procesoAplicacion,matrizlegalcomplemento.urlNorma as urlNorma,matrizlegalcomplemento.anotaciones as Anotaciones,matrizlegalcomplemento.descripcionArticulo as descripcionArticulo,matrizlegalemisor.anoPublicacion as anoPublicacion,matrizlegalemisor.enteEmisor as enteEmisor,matrizlegalemisor.descripcionNorma as descripcionNorma,matrizlegalemisor.articulo as Articulo,matrizlegalemisor.fechaEmision as fechaEmision,matrizlegalcalificacion.cumplimiento as Cumplimiento,matrizlegalcalificacion.evaluacionCumplimiento as evaluacionCumplimiento,matrizlegalcalificacion.controlesCumplimiento as controlesCumplimiento,matrizlegalcalificacion.evidenciaCumplimiento as evidenciaCumplimiento,matrizlegalcalificacion.urlCumplimiento as urlCumplimiento from matrizlegal,matrizlegalcalificacion,matrizlegalcomplemento,matrizlegalemisor where matrizlegal.subtema='$subtema' and matrizlegal.estado='A' and matrizlegalcalificacion.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and matrizlegalcomplemento.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and matrizlegalemisor.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and idEmpresa='$idEmpre'",$link);
                            }
                            else if($condicional=="tipo de norma"){
                                $tipo=$_POST["tipoB"];
                                $consultaMatriz=mysql_query("select matrizlegal.estado as Estado, matrizlegal.idmatrizLegal as idMatriLegal,matrizlegal.tema as Temas,matrizlegal.tipoNorma as tipoNoma,matrizlegal.normaAplicar as normaAplicar,matrizlegal.subtema as Subtema,matrizlegal.idEmpresa as idEmpresa,matrizlegalcomplemento.procesoAplicacion as procesoAplicacion,matrizlegalcomplemento.urlNorma as urlNorma,matrizlegalcomplemento.anotaciones as Anotaciones,matrizlegalcomplemento.descripcionArticulo as descripcionArticulo,matrizlegalemisor.anoPublicacion as anoPublicacion,matrizlegalemisor.enteEmisor as enteEmisor,matrizlegalemisor.descripcionNorma as descripcionNorma,matrizlegalemisor.articulo as Articulo,matrizlegalemisor.fechaEmision as fechaEmision,matrizlegalcalificacion.cumplimiento as Cumplimiento,matrizlegalcalificacion.evaluacionCumplimiento as evaluacionCumplimiento,matrizlegalcalificacion.controlesCumplimiento as controlesCumplimiento,matrizlegalcalificacion.evidenciaCumplimiento as evidenciaCumplimiento,matrizlegalcalificacion.urlCumplimiento as urlCumplimiento from matrizlegal,matrizlegalcalificacion,matrizlegalcomplemento,matrizlegalemisor where matrizlegal.tipoNorma='$tipo' and matrizlegal.estado='A' and matrizlegalcalificacion.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and matrizlegalcomplemento.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and matrizlegalemisor.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and idEmpresa='$idEmpre'",$link);
                            }
                            else if($condicional=="norma a aplicar"){
                                $norma=$_POST["normaB"];
                                $consultaMatriz=mysql_query("select matrizlegal.estado as Estado, matrizlegal.idmatrizLegal as idMatriLegal,matrizlegal.tema as Temas,matrizlegal.tipoNorma as tipoNoma,matrizlegal.normaAplicar as normaAplicar,matrizlegal.subtema as Subtema,matrizlegal.idEmpresa as idEmpresa,matrizlegalcomplemento.procesoAplicacion as procesoAplicacion,matrizlegalcomplemento.urlNorma as urlNorma,matrizlegalcomplemento.anotaciones as Anotaciones,matrizlegalcomplemento.descripcionArticulo as descripcionArticulo,matrizlegalemisor.anoPublicacion as anoPublicacion,matrizlegalemisor.enteEmisor as enteEmisor,matrizlegalemisor.descripcionNorma as descripcionNorma,matrizlegalemisor.articulo as Articulo,matrizlegalemisor.fechaEmision as fechaEmision,matrizlegalcalificacion.cumplimiento as Cumplimiento,matrizlegalcalificacion.evaluacionCumplimiento as evaluacionCumplimiento,matrizlegalcalificacion.controlesCumplimiento as controlesCumplimiento,matrizlegalcalificacion.evidenciaCumplimiento as evidenciaCumplimiento,matrizlegalcalificacion.urlCumplimiento as urlCumplimiento from matrizlegal,matrizlegalcalificacion,matrizlegalcomplemento,matrizlegalemisor where matrizlegal.normaAplicar=$norma' and matrizlegal.estado='A' and matrizlegalcalificacion.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and matrizlegalcomplemento.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and matrizlegalemisor.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and idEmpresa='$idEmpre'",$link);
                            }
                        }
                    }
                    else{
                        $consultaMatriz=mysql_query("select matrizlegal.estado as Estado, matrizlegal.idmatrizLegal as idMatriLegal,matrizlegal.tema as Temas,matrizlegal.tipoNorma as tipoNoma,matrizlegal.normaAplicar as normaAplicar,matrizlegal.subtema as Subtema,matrizlegal.idEmpresa as idEmpresa,matrizlegalcomplemento.procesoAplicacion as procesoAplicacion,matrizlegalcomplemento.urlNorma as urlNorma,matrizlegalcomplemento.anotaciones as Anotaciones,matrizlegalcomplemento.descripcionArticulo as descripcionArticulo,matrizlegalemisor.anoPublicacion as anoPublicacion,matrizlegalemisor.enteEmisor as enteEmisor,matrizlegalemisor.descripcionNorma as descripcionNorma,matrizlegalemisor.articulo as Articulo,matrizlegalemisor.fechaEmision as fechaEmision,matrizlegalcalificacion.cumplimiento as Cumplimiento,matrizlegalcalificacion.evaluacionCumplimiento as evaluacionCumplimiento,matrizlegalcalificacion.controlesCumplimiento as controlesCumplimiento,matrizlegalcalificacion.evidenciaCumplimiento as evidenciaCumplimiento,matrizlegalcalificacion.urlCumplimiento as urlCumplimiento from matrizlegal,matrizlegalcalificacion,matrizlegalcomplemento,matrizlegalemisor where matrizlegal.estado='A' and matrizlegalcalificacion.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and matrizlegalcomplemento.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and matrizlegalemisor.matrizlegal_idmatrizLegal=matrizlegal.idmatrizLegal and idEmpresa='$idEmpre'",$link);
                    }
                    while($row = mysql_fetch_array($consultaMatriz)) {
                ?>
            <tr>
                <td class="contenido">
                    <?php
                        echo $row['Temas'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['Subtema'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['tipoNoma'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['normaAplicar'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['anoPublicacion'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['fechaEmision'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['enteEmisor'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['descripcionNorma'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['Articulo'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['descripcionArticulo'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['controlesCumplimiento'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['procesoAplicacion'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['Cumplimiento'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['evaluacionCumplimiento']."%";
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['evidenciaCumplimiento'];
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo "<a href=".$row['urlNorma'].">".$row['normaAplicar']."</a>";
                    ?>
                </td>
                <td class="contenido">
                    <?php
                        echo $row['Anotaciones'];
                    ?>
                </td>
                <?php
                    if($_SESSION['permiso']=="administrador"){
                ?>
                <td class="contenido">
                    <a href="modificar.php?idMatriz=<?php echo $row['idMatriLegal']; ?>">
                        <img src="imagenes/modificar.png" title="Modificar matriz" width="25"/>
                    </a>
                    <a href="eliminar.php?idMatriz=<?php echo $row['idMatriLegal']; ?>" class='iframe'>
                        <img src="imagenes/eliminar.png" style="border:none" title="Eliminar matriz" width="25"/>
                    </a>
                    <?php
                        if($row['urlCumplimiento']!=""){
                    ?>
                            <a href="<?php echo $row['urlCumplimiento']; ?>">
                                <img src="imagenes/lupa.gif" title="Ver evidencia de cumplimiento" width="25"/>
                            </a>
                    <?php
                        }
                        else{
                    ?>
                            <a href="subirEvidencia.php?idMatriz=<?php echo $row['idMatriLegal']; ?>" class='iframe'>
                                <img src="imagenes/subir.png" title="Subir evidencia de cumplimiento" width="25"/>
                            </a>
                    <?php
                        }
                        if($row['urlNorma']==""){
                    ?>
                            <a href="subirMatriz.php?idMatriz=<?php echo $row['idMatriLegal']; ?>" class="iframe">
                                <img src="imagenes/subir.png" title="Subir norma" width="25"/>
                            </a>
                    <?php
                        }
                    ?>
                </td>
                <?php
                    }
                ?>
            </tr>
                <?php
                    }
                ?>
        </table>
    </body>
</html>
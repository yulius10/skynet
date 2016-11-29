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
    </head>
    <body>
        <br/>
        <?php
        include("./conexion.php");
        $consulAdmin=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
            $arreglo=mysql_fetch_array($consulAdmin);
            $id=$arreglo["idUsuario"];
            $resultA=mysql_query("select * from matrizlegal where idEmpresa='$arreglo[empresa_idEmpresa]' and estado='I'",$link);
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
            $fechamayor=mysql_query("select MAX(fecha) from matrizlegal where idEmpresa='$arreglo[empresa_idEmpresa]' and estado='I'",$link);
            $arraFecha=mysql_fetch_array($fechamayor);
        ?>
        <?php
            include("./encabezadoA.inc");
        ?>
        <br/>
        <center>
            <h1>
                Matriz de requisitos legales derogados
            </h1>
        </center>
        <br/>
        <?php
            include("./encabezadoDeshabilitados.inc");
        ?>
        <br/>
        <table id="tabla">
            <tr>
                <td colspan="16" style="text-align: right;" class="encabezado">
                    <b>
                        Procentaje de cumplimiento:
                    </b>
                </td>
                <td class="encabezado">
                    <?php
                        echo round($sumatoria,2);
                    ?>%
                </td>
            </tr>
            <tr>
                <td class="encabezado">
                    Tema/ factor de riesgo
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
                    Anotaci&oacute;n y observaci&oacute;n
                </td>
            </tr>
        <?php
        
            include("./conexion.php");
            $consultaA=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
            $arregloA=mysql_fetch_array($consultaA);
            $consultaB=mysql_query("select * from matrizlegal where idEmpresa='$arregloA[empresa_idEmpresa]' and estado='I'",$link);
            while($arregloB=mysql_fetch_array($consultaB)){
                $consultaC=mysql_query("select * from matrizlegalemisor where idmatrizLegalEmisor='$arregloB[idmatrizLegal]'",$link);
                $consultaD=mysql_query("select * from matrizlegalcomplemento where matrizlegal_idmatrizLegal='$arregloB[idmatrizLegal]'",$link);
                $consultaE=mysql_query("select * from matrizlegalcalificacion where matrizlegal_idmatrizLegal='$arregloB[idmatrizLegal]'",$link);
                $arregloC=mysql_fetch_array($consultaC);
                $arregloD=mysql_fetch_array($consultaD);
                $arregloE=mysql_fetch_array($consultaE);
                ?>
                <tr>
                    <td>
                    <?php
                        echo $arregloB["tema"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloB["subtema"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloB["tipoNorma"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloB["normaAplicar"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloC["anoPublicacion"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloC["fechaEmision"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloC["enteEmisor"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloC["descripcionNorma"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloC["articulo"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloD["descripcionArticulo"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloE["controlesCumplimiento"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloD["procesoAplicacion"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloE["cumplimiento"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloE["evaluacionCumplimiento"];
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $arregloE["evidenciaCumplimiento"];
                    ?>
                    </td>
                    <td>
                        <a href="<?php echo $arregloD["urlNorma"]; ?>">
                            <?php
                                echo $arregloB["normaAplicar"];
                            ?>
                        </a>
                    </td>
                    <td>
                    <?php
                        echo $arregloD["anotaciones"];
                    ?>
                    </td>
                </tr>
                <?php
            }
        ?>
        </table>
    </body>
</html>
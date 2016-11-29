<?php
    session_start();
    $idMatriz=$_GET["idMatriz"];
    include("./conexion.php");
    $consultaA=mysql_query("select * from matrizlegal where idmatrizLegal='$idMatriz'",$link);
    $consultaB=mysql_query("select * from matrizlegalemisor where matrizLegal_idmatrizLegal='$idMatriz'",$link);
    $consultaC=mysql_query("select * from matrizlegalcalificacion where matrizLegal_idmatrizLegal='$idMatriz'",$link);
    $consultaD=mysql_query("select * from matrizlegalcomplemento where matrizLegal_idmatrizLegal='$idMatriz'",$link);
    $arregloA=mysql_fetch_array($consultaA);
    $arregloB=mysql_fetch_array($consultaB);
    $arregloC=mysql_fetch_array($consultaC);
    $arregloD=mysql_fetch_array($consultaD);
?>
<html>
    <head>
        <title>
            Modificar matriz
        </title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster" />
        <!-- librerias para generar calendario -->
        <link rel="stylesheet" type="text/css" href="css/tcal.css" />
        <script type="text/javascript" src="js/tcal.js">
        </script>
        <!-- fin librerias para generar calendario -->
    </head>
    <body>
        <br/>
        <?php
            include("./encabezado.inc");
        ?>
        <br/>
        <form enctype="multipart/form-data" method="post" action="modificarMatriz.php">
            <table id="tabla">
                <tr>
                    <td class="encabezado">
                        Tema
                    </td>
                    <td>
                        <textarea name="tema" id="tema" maxlength="255" required><?php echo $arregloA["tema"]; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Subtema
                    </td>
                    <td>
                        <textarea name="subtema" id="subtema" maxlength="255" required><?php echo $arregloA["subtema"]; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Tipo de norma:
                    </td>
                    <td>
                        <select name="tipo" required>
                            <option>
                            </option>
                            <option value="Acuerdo" <?php if($arregloA["tipoNorma"]=="Acuerdo"){ echo "selected"; } ?> >
                                Acuerdo
                            </option>
                            <option value="Auto" <?php if($arregloA["tipoNorma"]=="Auto"){ echo "selected"; } ?> >
                                Auto
                            </option>
                            <option value="Circular" <?php if($arregloA["tipoNorma"]=="Circular"){ echo "selected"; } ?> >
                                Circular
                            </option>
                            <option value="Concepto" <?php if($arregloA["tipoNorma"]=="Concepto"){ echo "selected"; } ?> >
                                Concepto
                            </option>
                            <option value="Constitución" <?php if($arregloA["tipoNorma"]=="Constitución"){ echo "selected"; } ?> >
                                Constituci&oacute;n
                            </option>
                            <option value="Decreto" <?php if($arregloA["tipoNorma"]=="Decreto"){ echo "selected"; } ?> >
                                Decreto
                            </option>
                            <option value="Ley" <?php if($arregloA["tipoNorma"]=="Ley"){ echo "selected"; } ?> >
                                Ley
                            </option>
                            <option value="Licencia" <?php if($arregloA["tipoNorma"]=="Licencia"){ echo "selected"; } ?> >
                                Licencia
                            </option>
                            <option value="Resolución" <?php if($arregloA["tipoNorma"]=="Resolución"){ echo "selected"; } ?> >
                                Resoluci&oacute;n
                            </option>
                            <option value="Sentencia" <?php if($arregloA["tipoNorma"]=="Sentencia"){ echo "selected"; } ?> >
                                Sentencia
                            </option>
                            <option value="Guía" <?php if($arregloA["tipoNorma"]=="Guía"){ echo "selected"; } ?> >
                                Gu&iacute;a
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Norma a aplicar
                    </td>
                    <td>
                        <input type="text" name="norma" maxlength="255" value="<?php echo $arregloA["normaAplicar"];  ?>" id="nombre" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        A&ntilde;o de publicaci&oacute;n
                    </td>
                    <td>
                        <?php
                            $ano=date("Y");
                        ?>
                        <select name="publicacion" required>
                            <option>
                            </option>
                            <?php
                                for($i=1900;$i<=$ano;$i++){
                                    ?>
                                    <option value="<?php echo $i; ?>"  <?php if($arregloB["anoPublicacion"]==$i){ echo "selected"; } ?>>
                                        <?php
                                            echo $i;
                                        ?>
                                    </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Fecha de emisi&oacute;n
                    </td>
                    <td>
                        <input type="text" name="fechaEmision" value="<?php echo $arregloB["fechaEmision"]; ?>" class="tcal" OnFocus="this.blur()" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Ente emisor
                    </td>
                    <td>
                        <input type="text" name="emisor" maxlength="255" id="emisor" value="<?php echo $arregloB["enteEmisor"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Descripci&oacute;n de la norma
                    </td>
                    <td>
                        <textarea name="descripcionNorma" id="descripcionNorma" maxlength="255" required><?php echo $arregloB["descripcionNorma"]; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Art&iacute;culo(s) aplicable(s)
                    </td>
                    <td>
                        <input type="text" name="articulo" id="articulo" value="<?php echo $arregloB["articulo"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Descripci&oacute;n del articulo
                    </td>
                    <td>
                        <textarea name="descripcionArticulo" id="descripcionArticulo" maxlength="255" required><?php echo $arregloD["descripcionArticulo"]; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="encabezado">
                        Subir norma:
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="file" name="archivo" id="archivo" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Controles que aseguran el cumplimiento
                    </td>
                    <td>
                        <input type="text" name="controles" id="controles" value="<?php echo $arregloC["controlesCumplimiento"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Cumplimiento
                    </td>
                    <td>
                        <select name="cumplimiento" required>
                            <option>
                            </option>
                            <option value="Si cumple" <?php if($arregloC["cumplimiento"]=="Si cumple"){ echo "selected"; } ?> >
                                Si cumple
                            </option>
                            <option value="No cumple" <?php if($arregloC["cumplimiento"]=="No cumple"){ echo "selected"; } ?> >
                                No cumple
                            </option>
                            <option value="Cumple parcialmente" <?php if($arregloC["cumplimiento"]=="Cumple parcialmente"){ echo "selected"; } ?> >
                                Cumple parcialmente
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Evaluaci&oacute;n cumplimiento
                        <br/>
                        <small>
                            (Si cumple = 100%)
                            <br/>
                            (No cumple = 0%)
                            <br/>
                            (Cumple parcialmente = 25%, 50%, 75%)
                        </small>
                    </td>
                    <td>
                        <select name="evaluacion">
                            <option>
                            </option>
                            <option value="0" <?php if($arregloC["evaluacionCumplimiento"]=="0"){ echo "selected"; } ?> >
                                0%
                            </option>
                            <option value="25" <?php if($arregloC["evaluacionCumplimiento"]=="25"){ echo "selected"; } ?> >
                                25%
                            </option>
                            <option value="50" <?php if($arregloC["evaluacionCumplimiento"]=="50"){ echo "selected"; } ?> >
                                50%
                            </option>
                            <option value="75" <?php if($arregloC["evaluacionCumplimiento"]=="75"){ echo "selected"; } ?> >
                                75%
                            </option>
                            <option value="100" <?php if($arregloC["evaluacionCumplimiento"]=="100"){ echo "selected"; } ?> >
                                100%
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Documento que evidencia el cumplimiento
                    </td>
                    <td>
                        <textarea name="evidencia" id="evidencia" required maxlength="255"><?php echo $arregloC["evidenciaCumplimiento"]; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Proceso de &aacute;rea de aplicacion
                    </td>
                    <td>
                        <input type="hidden" name="url" id="url" value="<?php echo $arregloD["urlNorma"]; ?>"/>
                        <input type="hidden" name="codigo" id="codigo" value="<?php echo $idMatriz; ?>"/>
                        <input type="text" name="proceso" id="proceso" value="<?php echo $arregloD["procesoAplicacion"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Anotaciones
                    </td>
                    <td>
                        <textarea name="anotacion" id="anotacion" required maxlength="255"><?php echo $arregloD["anotaciones"]; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        Motivo de cambio:
                    </td>
                    <td>
                        <input type="text" name="motivo" id="motivo" required/>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <input type="submit" name="modificar" id="modificar" value="Modificar"/>
                    </th>
                </tr>
            </table>
        </form>
    </body>
</html>
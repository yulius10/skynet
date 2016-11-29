<?php
    session_start();
?>
<html>
    <head>
        <title>
            Insertar matriz
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
        <center>
            <h1>
                Insertar matriz legal
            </h1>
        </center>
        <form enctype="multipart/form-data" method="post" action="guardarmatriz.php">
            <table id="tabla">
                <tr>
                    <td class="encabezado">
                        Tema / factor de riesgo
                    </td>
                    <td>
                        <textarea name="tema" id="tema" maxlength="255" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Subtema
                    </td>
                    <td>
                        <textarea name="subtema" id="subtema" maxlength="255" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Tipo de norma:
                    </td>
                    <td>
                        <select name="tipo" id="tipo" required>
                            <option>
                            </option>
                            <option value="Acuerdo">
                                Acuerdo
                            </option>
                            <option value="Auto">
                                Auto
                            </option>
                            <option value="Circular">
                                Circular
                            </option>
                            <option value="Concepto">
                                Concepto
                            </option>
                            <option value="Constitucion">
                                Constituci&oacute;n
                            </option>
                            <option value="Decreto">
                                Decreto
                            </option>
                            <option value="Ley">
                                Ley
                            </option>
                            <option value="Licencia">
                                Licencia
                            </option>
                            <option value="Resolucion">
                                Resoluci&oacute;n
                            </option>
                            <option value="Sentencia">
                                Sentencia
                            </option>
                            <option value="Guia">
                                Gu&iacute;a
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Norma No.:
                    </td>
                    <td>
                        <input type="text" name="norma" maxlength="255" size="20" id="nombre" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        A&ntilde;o de publicaci&oacute;n:
                    </td>
                    <td>
                        <?php
                            $ano=date("Y");
                        ?>
                        <select name="publicacion" id="publicacion" required>
                            <option>
                            </option>
                            <?php
                                for($i=1900;$i<=$ano;$i++){
                                    ?>
                                    <option value="<?php echo $i; ?>">
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
                        Fecha de emisi&oacute;n:
                    </td>
                    <td>
                        <input type="text" name="fechaEmision" id="fechaEmision" size="20" class="tcal" OnFocus="this.blur()" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Ente emisor:
                    </td>
                    <td>
                        <input type="text" name="emisor" maxlength="255" id="emmisor" size="20" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Descripci&oacute;n de la norma:
                    </td>
                    <td>
                        <textarea name="descripcionNorma" id="descripcionNorma" maxlength="255" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Art&iacute;culo(s) aplicable(s):
                    </td>
                    <td>
                        <input type="text" name="articulo" id="articulo" size="20" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Descripci&oacute;n del requisito legal:
                    </td>
                    <td>
                        <textarea name="descripcionArticulo" id="descripcionArticulo" maxlength="255" required></textarea>
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
                        Controles sugeridos que aseguran el cumplimiento:
                    </td>
                    <td>
                        <input type="text" name="controles" id="controles" size="20" required/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Proceso  &oacute; &aacute;rea responsable de su aplicacion
                    </td>
                    <td>
                        <input type="text" name="proceso" id="proceso" required size="20"/>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Cumplimiento legal:
                    </td>
                    <td>
                        <select name="cumplimiento" id="cumplimiento" required>
                            <option>
                            </option>
                            <option value="Si cumple">
                                Si cumple
                            </option>
                            <option value="No cumple">
                                No cumple
                            </option>
                            <option value="Cumple parcialmente">
                                Cumple parcialmente
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Evaluaci&oacute;n cumplimiento:
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
                        <select name="evaluacion" id="evaluacion">
                            <option>
                            </option>
                            <option value="0">
                                0%
                            </option>
                            <option value="25">
                                25%
                            </option>
                            <option value="50">
                                50%
                            </option>
                            <option value="75">
                                75%
                            </option>
                            <option value="100">
                                100%
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Evidencia el cumplimiento:
                    </td>
                    <td>
                        <textarea name="evidencia" id="evidencia" required maxlength="255"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="encabezado">
                        Anotaci&oacute;n u observaci&oacute;n
                    </td>
                    <td>
                        <textarea name="anotacion" id="anotacion" required maxlength="255"></textarea>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <input type="submit" name="guardar" id="guardar" value="Guardar"/>
                    </th>
                </tr>
            </table>
        </form>
    </body>
</html>
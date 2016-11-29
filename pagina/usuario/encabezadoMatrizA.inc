<center>
    <table>
        <tr>
            <td rowspan="2" colspan="2">
                <center>
                    <img src="<?php echo $_SESSION['urlLogo']; ?>" title="skynet" width="250" height="70"/>
                </center>
            </td>
            <td rowspan="2" colspan="2" class="grande">
                <b>
                    Matriz de requisitos legales
                </b>
            </td>
            <td>
                <b>
                    C&oacute;digo:
                </b>
                GH-ML-001
            </td>
            <td colspan="4">
                <b>
                    Versi&oacute;n:
                </b>
                1
            </td>
        </tr>
        <tr>
            <td colspan="5">
                <b>
                    Fecha:
                </b>
                2016-09-01
            </td>
        </tr>
        <tr>
            <td>
                <b>
                    Empresa:
                </b>
            </td>
            <td>
                <?php
                    echo $_SESSION['empresa'];
                ?>
            </td>
            <td colspan="2">
                <b>
                    Sector econ&oacute;mico:
                </b>
            </td>
            <td colspan="3">
                <?php
                    echo $c["sectorEconomico"];
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>
                    Elaborado por:
                </b>
            </td>
            <td>
                <?php
                    echo $_SESSION['nombre'];
                ?>
            </td>
            <td>
                <b>
                    Fecha de elaboracion:
                </b>
            </td>
            <td>
                <?php
                    echo "2016-04-01";
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>
                    Actualizado por:
                </b>
            </td>
            <td>
                <?php
                    echo $ultimapersona;
                ?>
            </td>
            <td>
                <b>
                    Fecha de &uacute;ltima actualizaci&oacute;n:
                </b>
            </td>
            <td colspan="4">
                <?php
                    echo $fecha;
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <b>
                    Versi&oacute;n actualizaci&oacute;n:
                </b>
            </td>
            <td colspan="5">
                <?php
                    echo $version;
                ?>
            </td>
        </tr>
    </table>
</center>
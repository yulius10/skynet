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
            include("./encabezadoA.inc");
        ?>
        <br/>
        <?php
            include("./encabezadoPanelCambios.inc");
        ?>
        <br/>
        <table id="panelcambios">
            <tr>
                <td class="cabeza">
                    <b>
                        Fecha del cambio
                    </b>
                </td>
                <td class="cabeza">
                    <b>
                        Versi&oacute;n
                    </b>
                </td>
                <td class="cabeza">
                    <b>
                        Motivo del cambio
                    </b>
                </td>
                <td class="cabeza">
                    <b>
                        Responsable de realizar el cambio
                    </b>
                </td>
            </tr>
            <?php
                include("./conexion.php");
                $consu=mysql_query("select * from empresa where nombre='$_SESSION[empresa]'",$link);
                $arreEmpre=mysql_fetch_array($consu);
                $consulta=mysql_query("select * from panelcambios where idEmpresa='$arreEmpre[idEmpresa]'",$link);
                while ($row = mysql_fetch_array($consulta)) {
                    $conUsu=mysql_query("select * from usuario where idUsuario='$row[usuario_idUsuario]'",$link);
                    $arreUsu=mysql_fetch_array($conUsu);
                ?>
                    <tr>
                        <td <?php if($row["version"]%2==0){ echo "class='uno'"; }else{ echo "class='dos'"; } ?>>
                        <?php
                            echo $row["fecha"];
                        ?>
                        </td>
                        <td <?php if($row["version"]%2==0){ echo "class='uno'"; }else{ echo "class='dos'"; } ?>>
                        <?php
                            echo $row["version"];
                        ?>
                        </td>
                        <td <?php if($row["version"]%2==0){ echo "class='uno'"; }else{ echo "class='dos'"; } ?>>
                        <?php
                            echo $row["motivo"];
                        ?>
                        </td>
                        <td <?php if($row["version"]%2==0){ echo "class='uno'"; }else{ echo "class='dos'"; } ?>>
                        <?php
                            echo $arreUsu["nombre"];
                        ?>
                        </td>
                    </tr>
                <?php
                }
            ?>
        </table>
    </body>
</html>
<?php
    session_start();
?>
<html>
    <head>
	<title>
            Listar usuario
	</title>
	<link rel="stylesheet" type="text/css" href="css/barraNavegacion.css"/>
	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	<link rel="stylesheet" type="text/css" href="css/estiloBarraNavegacion.css"/>
	<link rel="stylesheet" type="text/css" href="http://www.formmail-maker.com/var/demo/jquery-popup-form/colorbox.css" />
	<script type="text/javascript" src="js/jquery-1.4.2.min.js">
        </script>
        <script type="text/javascript" src="js/jquery.min.js">
        </script>
        <script type="text/javascript" src="js/jquery.colorbox-min.js">
        </script>
        <script type="text/javascript" src="js/iframe.js">
        </script>
    </head>
    <body>
        <?php
            include("./encabezadoUsuario.inc");
        ?>
        <table class="tablacentrada">
            <tr>
                <td class="blanco">
                    Empresa
                </td>
                <td class="blanco">
                    Nombre
                </td>
                <td class="blanco">
                    Apellido
                </td>
                <td class="blanco">
                    Cargo
                </td>
                <td class="blanco">
                    Permiso
                </td>
                <td class="blanco">
                    Correo
                </td>
            </tr>
            <?php
                include ("./conexion.php");
                $consulta=mysql_query("select * from usuario");
                while ($row = mysql_fetch_array($consulta)) {
                    $consultaA=mysql_query("select * from empresa where idEmpresa='$row[empresa_idEmpresa]' and estado='A'");
                    $rowA=mysql_fetch_array($consultaA);
                    ?>
                    <tr <?php if($row["idUsuario"]%2==0){ echo "class='uno'"; } else{ echo "class='dos'"; } ?>>
                        <td>
                            <?php
                                echo $rowA["nombre"];
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $row["nombre"];
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $row["apellido"];
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $row["cargo"];
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $row["permiso"];
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $row["correo"];
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </body>
</html>
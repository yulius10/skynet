<?php
    session_start();
?>
<html>
    <head>
	<title>
            Reactivar empresas
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
            include("./encabezadoEmpresas.inc");
	?>
        <br/>
        <h1 class="titulo">
            Reactivar empresas
        </h1>
        <table class="tabla">
            <tr>
                <td class="blanco">
                    Nombre
                </td>
                <td class="blanco">
                    Nit
                </td>
                <td class="blanco">
                    Cantidades de cuentas
                </td>
                <td class="blanco">
                    Sector economico
                </td>
                <td class="blanco">
                    Reactivar
                </td>
            </tr>
            <?php
                include ("./conexion.php");
                $consulta=mysql_query("select * from empresa where estado='I'",$link);
                while($row=mysql_fetch_array($consulta)) {
                    ?>
                    <tr>
                        <td>
                            <?php
                                echo $row["nombre"];
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $row["nit"];
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $row["cantidadCuentas"];
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $row["sectorEconomico"];
                            ?>
                        </td>
                        <td>
                            <a href="reactivandoEmpresa.php?id=<?php echo $row["idEmpresa"]; ?>" class='iframe'>
                                <img src="imagenes/actualizar.png" title="Reactivar empresa" width="25" height="25"/>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </body>
</html>
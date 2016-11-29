<?php
    session_start();
?>
<html>
    <head>
	<title>
            Modificar empresa
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
            Modificar empresa
        </h1>
        <form method="post" action="obtenerInfoEmpresa.php">
            <table class="tablacentrada">
                <tr>
                    <td>
                        Empresa:
                    </td>
                    <td>
                        <select name="empresa" id="empresa" required>
                            <option>
                            </option>
                            <?php
                                include ("./conexion.php");
                                $consulta=mysql_query("select * from empresa where estado='A'",$link);
                                $num=mysql_num_rows($consulta);
                                if($num>0){
                                    while ($row = mysql_fetch_array($consulta)) {
                                        ?>
                                        <option value="<?php echo $row["nombre"]; ?>">
                                            <?php
                                                echo $row["nombre"];
                                            ?>
                                        </option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="modificar" id="modificar" value="Modificar"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
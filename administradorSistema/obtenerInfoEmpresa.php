<?php
    session_start();
?>
<html>
    <head>
	<title>
            Modificar informacion de la empresa
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
            include ("./conexion.php");
            $empresa=$_POST["empresa"];
            $consulta=mysql_query("select * from empresa where estado='A' and nombre='$empresa'",$link);
            while($row=mysql_fetch_array($consulta)) {
	?>
        <br/>
        <h1 class="titulo">
            Modificar informacion de la empresa
        </h1>
        <form method="post" action="modificarInfoEmpresa.php">
            <table class="tabla">
                <tr>
                    <td class="blanco">
                        Nombre
                    </td>
                    <td>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $row["nombre"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td class="blanco">
                        Nit
                    </td>
                    <td>
                        <input type="text" name="nit" id="nit" value="<?php echo $row["nit"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td class="blanco">
                        Cantidades de cuentas
                    </td>
                    <td>
                        <input type="text" name="cuentas" id="cuentas" value="<?php echo $row["cantidadCuentas"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td class="blanco">
                        Sector economico
                    </td>
                    <td>
                        <input type="text" name="sectorEconomico" id="sectorEconomico" value="<?php echo $row["sectorEconomico"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" id="id" value="<?php echo $row["idEmpresa"]; ?>"/>
                        <input type="submit" name="Modificar" id="Modificar" value="Modificar"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php
            }
        ?>
    </body>
</html>
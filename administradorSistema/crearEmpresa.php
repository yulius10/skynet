<?php
    session_start();
?>
<html>
    <head>
	<title>
            Crear empresa
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
            Crear empresa
        </h1>
        <form method="post" enctype="multipart/form-data" action="creardoEmpresa.php">
            <table class="tablacentrada">
                <tr>
                    <td>
                        Nombre
                    </td>
                    <td>
                        <input type="text" name="nombre" id="nombre" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nit
                    </td>
                    <td>
                        <input type="text" name="nit" id="nit" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Cantidades de cuentas
                    </td>
                    <td>
                        <input type="number" name="cantcuentas" min="0" id="cantcuentas" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Sector economico
                    </td>
                    <td>
                        <input type="text" name="sector" id="sector" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Logo de empresa:
                    </td>
                    <td>
                        <input type="file" name="archivo" id="logo" required/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="guardar" id="guardar" value="Guardar"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php
    session_start();
?>
<html>
    <head>
	<title>
            Crear usuario
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
        <br/>
        <h1 class="titulo">
            Crear usuario
        </h1>
        <form method="post" action="creardoUsuario.php">
            <table class="tablacentrada">
                <tr>
                    <td>
                        Empresa
                    </td>
                    <td>
                        <select name="empresa" id="empresa" required>
                            <option>
                            </option>
                            <?php
                                include("./conexion.php");
                                $consultarEmpresas=mysql_query("select * from empresa where estado='A'",$link);
                                $num=mysql_num_rows($consultarEmpresas);
                                if($num>0){
                                    while ($row = mysql_fetch_array($consultarEmpresas)) {
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
                    <td>
                        Nombre
                    </td>
                    <td>
                        <input type="text" name="nombre" id="nombre" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Apellido
                    </td>
                    <td>
                        <input type="text" name="apellido" id="apellido" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Cargo
                    </td>
                    <td>
                        <input type="text" name="cargo" id="cargo" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Permiso
                    </td>
                    <td>
                        <select name="permiso" id="permiso" required>
                            <option>
                            </option>
                            <option value="usuario">
                                Usuario de consulta
                            </option>
                            <option value="administrador">
                                Usuario administrador
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Correo
                    </td>
                    <td>
                        <input type="email" name="correo" id="correo" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Contrase&ntilde;a
                    </td>
                    <td>
                        <input type="password" name="password" required/>
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
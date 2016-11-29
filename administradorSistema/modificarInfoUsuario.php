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
            include ("./conexion.php");
            $id=$_GET["id"];
        ?>
        <br/>
        <h1 class="titulo">
            Modificar informacion del usuario
        </h1>
        <?php
            $consulta=mysql_query("select * from usuario where idUsuario='$id'",$link);
            $row=mysql_fetch_array($consulta);
        ?>
        <form method="post" action="modificandoInfoUsuario.php">
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
                        Apellido
                    </td>
                    <td>
                        <input type="text" name="apellido" id="apellido" value="<?php echo $row["apellido"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td class="blanco">
                        Cargo
                    </td>
                    <td>
                        <input type="text" name="cargo" id="cargo" value="<?php echo $row["cargo"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td class="blanco">
                        Permiso
                    </td>
                    <td>
                        <select name="permiso" id="permiso" required>
                            <option>
                            </option>
                            <option value="usuario" <?php  if($row["permiso"]=="usuario"){ echo "selected"; } ?>>
                                Usuario de consulta
                            </option>
                            <option value="administrador" <?php  if($row["permiso"]=="administrador"){ echo "selected"; } ?>>
                                Usuario administrador
                            </option>
                        </select>
                        <input type="text" name="permiso" id="permiso" value="<?php echo $row["permiso"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td class="blanco">
                        Correo
                    </td>
                    <td>
                        <input type="text" name="correo" id="correo" value="<?php echo $row["correo"]; ?>" required/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" id="id" value="<?php echo $row["idUsuario"]; ?>"/>
                        <input type="submit" name="modificar" id="modificar" value="Modificar"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
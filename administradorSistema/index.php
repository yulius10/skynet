<html>
    <head>
	<title>
            Administrador de sistema
        </title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
    </head>
    <body>
	<h1 class="titulo">
            Administrador de sistema
	</h1>
        <form method="post" action="validarUsuario.php">
            <table id="login">
		<tr>
                    <td>
			Usuario:
                    </td>
                    <td>
			<input type="text" name="usuario" id="usuario" required/>
                    </td>
		</tr>
		<tr>
                    <td>
			Contraseña:
                    </td>
                    <td>
			<input type="password" name="password" id="password" required/>
                    </td>
		</tr>
		<tr>
                    <td colspan="2">
			<input type="submit" name="ingresar" id="ingresar" value="Ingresar"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<html>
    <head>
        <title>
            Skynet
        </title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
    </head>
    <body>
        <form method="post" action="validarUsuario.php">
            <table id="acceso">
                <tr>
                    <td colspan="2">
                        <center>
                            <img src="imagenes/Skynet.png" title="skynet" width="250"/>
                        </center>
                    </td>
                </tr>
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
                        Contrase&ntilde;a:
                    </td>
                    <td>
                        <input type="password" name="password" id="password"/>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <input type="submit" name="entrar" id="entrar"/>
                    </th>
                </tr>
            </table>
        </form>
    </body>
</html>
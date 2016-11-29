<?php
    session_start();
    $idMatriz=$_GET['idMatriz'];
?>
<html>
    <head>
        <title>
            Deshabilitar Matriz
        </title>
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data" action="eliminarMatriz.php">
            <table id="eliminar">
                <tr>
                    <td>
                        Motivo de deshabilitacion de matriz:
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea id="motivo" name="motivo" required maxlength="255"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="idMatriz" id="idMatriz" value="<?php echo $idMatriz; ?>"/>
                        <input type="submit" name="deshabilitar" id="deshabilitar" value="Deshabilitar"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php
    session_start();
    $idMatriz=$_GET['idMatriz'];
?>
<html>
    <head>
        <title>
            Subir matriz
        </title>
        <link rel="stylesheet" type="text/css" href="css/estilos.css"/>
    </head>
    <body>
        <form enctype="multipart/form-data" method="post" action="subiendoMatriz.php">
            <table id="subirMatriz">
                <tr>
                    <td>
                        Subir matriz:
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="archivo" id="archivo" required/>
                        <input type="hidden" name="idMatriz" id="idMatriz" value="<?php echo $idMatriz; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="subir" id="subir" value="Subir"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
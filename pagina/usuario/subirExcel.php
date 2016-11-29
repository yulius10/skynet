<?php
    session_start();
?>
<html>
    <head>
        <title>
            Subir archivo
        </title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <link rel="stylesheet" type="text/css" href="css/barraNavegacion.css" />
        <script type="text/javascript" src="js/jquery-1.4.2.min.js">
        </script>
    </head>
    <body>
        <br/>
        <?php
            include("./encabezado.inc");
        ?>
        <br/>
        <center>
            <h1>
                Importar Archivo Excel
            </h1>
        </center>
        <form enctype="multipart/form-data" method="post" action="subiendoExcel.php">
            <table class="tabla">
                <tr>
                    <td>
                        Formato excel para subir matrices:
                    </td>
                    <td>
                        <a href="plantillas/matriz legal.xlsx" id="ar">
                            Plantilla de matrices
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        Subir archivo:
                    </td>
                    <td>
                        <input type="file" name="archivo" id="archivo" requiered/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center>
                            <input type="submit" name="Subir" id="Subir" value="Subir"/>
                        </center>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
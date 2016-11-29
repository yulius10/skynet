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
            include("./encabezadoUsuario.inc");
            include ("./conexion.php");
        ?>
        <br/>
        <h1 class="titulo">
            Modificar informacion del usuario
        </h1>
        <table class="tabla">
            <tr>
                <td class="blanco">
                    Empresa
                </td>
                <td class="blanco">
                    Nombre
                </td>
                <td class="blanco">
                    Apellido
                </td>
                <td class="blanco">
                    cargo
                </td>
                <td class="blanco">
                    Permiso
                </td>
                <td class="blanco">
                    Correo
                </td>
                <td class="blanco">
                    Modificar
                </td>
            </tr>
        <?php
            $empresa=$_POST["empresa"];
            $permiso=$_POST["permiso"];
            $consultaEmpresa=mysql_query("select * from empresa where nombre='$empresa' and estado='A'",$link);
            $num=mysql_num_rows($consultaEmpresa);
            if($num>0){
                $rowA=mysql_fetch_array($consultaEmpresa);
                $consulta=mysql_query("select * from usuario where empresa_idEmpresa='$rowA[idEmpresa]' and permiso='$permiso'",$link);
                while($row=mysql_fetch_array($consulta)) {
            ?>
            <tr>
                <td>
                <?php
                    echo $empresa;
                ?>
                </td>
                <td>
                <?php
                    echo $row["nombre"];
                ?>
                </td>
                <td>
                <?php
                    echo $row["apellido"];
                ?>
                </td>
                <td>
                <?php
                    echo $row["cargo"];
                ?>
                </td>
                <td>
                <?php
                    echo $row["permiso"];
                ?>
                </td>
                <td>
                <?php
                    echo $row["correo"];
                ?>
                </td>
                <td>
                    <a href="modificarInfoUsuario.php?id=<?php echo $row["idUsuario"]; ?>" class='iframe'>
                        <img src="imagenes/modificar.png" title="Modificar usuario" width="15"/>
                    </a>
                </td>
            </tr>
        <?php
                }
            }
        ?>
        </table>
    </body>
</html>
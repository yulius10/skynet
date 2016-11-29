<?php
    session_start();
?>
<html>
    <head>
        <title>
            Inicio
        </title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <link rel="stylesheet" type="text/css" href="css/barraNavegacion.css" />
        <link rel="stylesheet" type="text/css" href="http://www.formmail-maker.com/var/demo/jquery-popup-form/colorbox.css" />
        <script type="text/javascript" src="js/jquery-1.4.2.min.js">
        </script>
        <script type="text/javascript" src="js/jquery.min.js">
        </script>
        <script type="text/javascript" src="js/jquery.colorbox-min.js">
        </script>
        <script type="text/javascript" src="js/iframe.js">
        </script>
        <script>
            function reacargar(){
                location.href='inicio.php';
            }
        </script>
    </head>
    <body>
        <br/>
        <?php
            include './conexion.php';
            if($_GET){
                $tipo=$_GET["tipo"];
                $condicional=$_GET["condicional"];
            }
            else{
                $tipo="";
                $condicional="";
            }
            $consulAdmin=mysql_query("select * from usuario where correo='$_SESSION[usuario]'",$link);
            $numAdmin=mysql_num_rows($consulAdmin);
            $arreglo=mysql_fetch_array($consulAdmin);
            $id=$arreglo["idUsuario"];
            $idEmpre=$arreglo["empresa_idEmpresa"];
            //consulta ultima fecha de mofidificacion y version en que va
            $version="";
            $fecha="";
            $ultimapersona="";
            $consulVersion=mysql_query("select MAX(version),fecha,usuario_idUsuario from panelcambios where idEmpresa='$idEmpre'",$link);
            $num=mysql_num_rows($consulVersion);
            $a=mysql_fetch_array($consulVersion);
            if($num>0 && $a[0]!=""){
                $version=$a[0];
                $fecha=$a[1];
            }
            else{
                $version="0";
                $fecha="No se a actualizado";
            }
            $consulUltimo=mysql_query("select * from usuario where idUsuario='$id'",$link);
            $b=mysql_fetch_array($consulUltimo);
            $numb=mysql_num_rows($consulUltimo);
            if($numb>0 && $b["nombre"]!=""){
                $ultimapersona=$b["nombre"];
            }
            else{
                $ultimapersona="No hay persona que halla modificado";
            }
            $consulEmpre=mysql_query("select * from empresa where idEmpresa='$idEmpre'",$link);
            $numVer=mysql_num_rows($consulEmpre);
            $c=mysql_fetch_array($consulEmpre);
        ?>
        <br/>
        <center>
            <table>
                <tr>
                    <td rowspan="2" colspan="2">
                        <center>
                            <img src="<?php echo $_SESSION['urlLogo']; ?>" title="skynet" width="250" height="70"/>
                        </center>
                    </td>
                    <td rowspan="2" colspan="2" class="grande">
                        <b>
                            Matriz de requisitos legales
                        </b>
                    </td>
                    <td>
                        <b>
                            C&oacute;digo:
                        </b>
                        GH-ML-001
                    </td>
                    <td colspan="4">
                        <b>
                            Versi&oacute;n:
                        </b>
                        1
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <b>
                            Fecha:
                        </b>
                        2016-09-01
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Empresa:
                        </b>
                    </td>
                    <td>
                        <?php
                            echo $_SESSION['empresa'];
                        ?>
                    </td>
                    <td colspan="2">
                        <b>
                            Sector econ&oacute;mico:
                        </b>
                    </td>
                    <td colspan="3">
                        <?php
                            echo $c["sectorEconomico"];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Elaborado por:
                        </b>
                    </td>
                    <td>
                        <?php
                            echo $_SESSION['nombre'];
                        ?>
                    </td>
                    <td>
                        <b>
                            Fecha de elaboracion:
                        </b>
                    </td>
                    <td>
                        <?php
                            echo "2016-04-01";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>
                            Actualizado por:
                        </b>
                    </td>
                    <td>
                        <?php
                            echo $ultimapersona;
                        ?>
                    </td>
                    <td>
                        <b>
                            Fecha de &uacute;ltima actualizaci&oacute;n:
                        </b>
                    </td>
                    <td colspan="4">
                        <?php
                            echo $fecha;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <b>
                            Versi&oacute;n actualizaci&oacute;n:
                        </b>
                    </td>
                    <td colspan="5">
                        <?php
                            echo $version;
                        ?>
                    </td>
                </tr>
            </table>
        </center>
        <br/>
        <br/>
        <?php
            include("./encabezado.inc");
        ?>
    </body>
</html>
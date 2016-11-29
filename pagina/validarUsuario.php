<?php
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];
    include('./conexion.php');
    $consultaA=mysql_query("select * from usuario where correo='$usuario'",$link);
    $num=mysql_num_rows($consultaA);
    if($num>0){
        $arreglo=mysql_fetch_array($consultaA);
        if($arreglo["contrasena"]==$password){
            $consultaB=mysql_query("select * from empresa where idEmpresa='$arreglo[empresa_idEmpresa]' and estado='A'",$link);
            $arregloB=mysql_fetch_array($consultaB);
            session_start();
            $_SESSION['nombre']=$arreglo["nombre"];
            $_SESSION['usuario']=$usuario;
            $_SESSION['cargo']=$arreglo["cargo"];
            $_SESSION['permiso']=$arreglo["permiso"];
            $_SESSION['urlLogo']=$arregloB["urlLogo"];
            $_SESSION['empresa']=$arregloB["nombre"];
            header("Location:./usuario/inicio.php");
        }
        else{
            ?>
            <script type="text/javascript">
                alert("Contraseña es incorrecta");
                location.href="index.php";
            </script>
            <?php
        }
    }
    else{
        ?>
        <script type="text/javascript">
            alert("El usuario no existe");
            location.href="index.php";
        </script>
        <?php
    }
?>
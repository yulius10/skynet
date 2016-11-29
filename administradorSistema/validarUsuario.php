<?php
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];
    include('./conexion.php');
    $consultaA=mysql_query("select * from administradorsistema where correo='$usuario'",$link);
    $num=mysql_num_rows($consultaA);
    if($num>0){
        $arreglo=mysql_fetch_array($consultaA);
        if($arreglo["contrasena"]==$password){
            session_start();
            $_SESSION['nombre']=$arreglo["nombre"];
            $_SESSION['usuario']=$usuario;
            header("Location:inicio.php");
        }
        else{
            echo "Contraseña es incorrecta";
        }
    }
    else{
        echo "El usuario no existe";
    }
?>
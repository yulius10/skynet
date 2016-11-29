<?php
    $empresa=$_POST["empresa"];
    $nombre=$_POST["nombre"];
    $apellido=$_POST["apellido"];
    $cargo=$_POST["cargo"];
    $permiso=$_POST["permiso"];
    $correo=$_POST["correo"];
    $password=$_POST["password"];
    include ("./conexion.php");
    $consultaEmpresa=mysql_query("select * from empresa where nombre='$empresa' and estado='A'",$link);
    $num=mysql_num_rows($consultaEmpresa);
    if($num>0){
        $row = mysql_fetch_array($consultaEmpresa);
        $consultaCuentas=mysql_query("select * from usuario where empresa_idEmpresa='$row[idEmpresa]'",$link);
        $numCuenta=mysql_num_rows($consultaCuentas);
        if($numCuenta<$row["cantidadCuentas"]){
            $rowA=mysql_fetch_array($consultaCuentas);
            if($rowA["nombre"]!=$nombre){
                $crearNuevaCuenta=mysql_query("insert into usuario (empresa_idEmpresa,nombre,apellido,cargo,permiso,correo,contrasena) values ('$row[idEmpresa]','$nombre','$apellido','$cargo','$permiso','$correo','$password')",$link);
                echo "insert into usuario (empresa_idEmpresa,nombre,apellido,cargo,permiso,correo,contrasena) values ('$row[idEmpresa]','$nombre','$apellido','$cargo','$permiso','$correo','$password')";
                header("Location: crearUsuario.php");
            }
            else{
                echo "Ya existe un usuario con el mismo nombre";
            }
        }
        else{
            echo "Esta empresa llego a su limite de cuentas";
        }
    }
    //header("Location: crearUsuario.php");
?>
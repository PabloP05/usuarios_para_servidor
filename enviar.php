<?php
    require 'config/consfig.php';


    /* print_r($_POST); */


    $conexion = new mysqli(SERVIDROR,USUARIOWEB,PASWORDWEB,BBDD);
//para sacar el ultimo id de la bd se utiliza insert_id

        if(!empty($_POST['correo'])){ //valido que si el usuario no agrega un correo no se envie el valor vacio a la bd 
            $sql = "INSERT INTO usuarios(nombre,clave,pais, correo) VALUES ('".$_POST['usuario']."','".$_POST['password']."','".$_POST['paises']."','".$_POST['correo']."')";
        }else{
            $sql = "INSERT INTO usuarios(nombre,clave,pais) VALUES ('".$_POST['usuario']."','".$_POST['password']."','".$_POST['paises']."')";
        }


        
            if(!empty($_POST['usuario']) && !empty($_POST['password'])){
                $conexion->query($sql);
            }
            if($conexion->affected_rows>0){
                $id=$conexion->insert_id;
                foreach ($_POST['intereses'] as $key => $value) {
                   $sql="INSERT INTO preferenciasUsuarios VALUES (".$id.",'".$value."')";
                   $conexion->query($sql);
                }

                if($conexion->affected_rows>0){
                    echo 'filas agregadas con existo';
                }

            }
?>
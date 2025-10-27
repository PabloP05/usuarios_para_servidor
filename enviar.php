<?php
    require_once 'config/consfigDB.php';


    /* print_r($_POST); */


    $conexion = new mysqli(SERVIDROR,USUARIOWEB,PASWORDWEB,BBDD);
//para sacar el ultimo id de la bd se utiliza insert_id
        if(!empty($_POST['correo'])){ //valido que si el usuario no agrega un correo no se envie el valor vacio a la bd 
            $sql = "INSERT INTO usuarios(nombre,clave,pais, correo) VALUES ('".$_POST['usuario']."','".$_POST['password']."','".$_POST['paises']."','".$_POST['correo']."')";
        }else{
            $sql = "INSERT INTO usuarios(nombre,clave,pais) VALUES ('".$_POST['usuario']."','".$_POST['password']."','".$_POST['paises']."')";
        }
    

            if(!empty($_POST['usuario']) && !empty($_POST['password'])){
                
                //envuelvo la consulta en trycatch para verificar la excepcion 
                try{ 
                    $conexion->query($sql);
                }catch(Exception $fallo){
                    /* $conexion->errno; saco un echo a eso para saber el nº de error de CSU duplicada */
                    
                    if($conexion->errno == 1062){
                        $fallo = 'Correo electronico duplicado';
                        echo $fallo;
                    } //el error de CSU duplicada es 1062
                        
                    //mensaje de error oficial de mysqli : $conexion->error
                }
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
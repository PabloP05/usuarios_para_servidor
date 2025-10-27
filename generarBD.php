<?php

    require '../consfigDB.php';

  $conexion = new mysqli(SERVIDROR,USUARIO,PASWORD); // no le paso la bd porque la voy a crear aqui 


    if ($conexion->connect_error) { // esto comprueba que si la base de datos no existe la cree despues 

        die("la base de datos no existe");

    }
    
    
    ///genero las tablas si no existen
    $sql = "CREATE DATABASE IF NOT EXISTS 2daw"; //si no existe la base de datos la crea

        /* echo $sql; */

        $conexion->query($sql);
        $conexion->select_db('2daw'); 
    

        $sql='CREATE TABLE IF NOT EXISTS paises( 
            idPais tinyint AUTO_INCREMENT PRIMARY KEY,
            pais varchar(50) unique
        );';

        /* echo $sql; */

        $conexion->query($sql);

         $sql='CREATE TABLE IF NOT EXISTS usuarios(
            idUsuarios tinyint AUTO_INCREMENT PRIMARY KEY,
            nombre varchar(50),
            clave varchar(50),
            pais varchar(50),
            correo varchar(50)
        );';
        $conexion->query($sql);  
    
        $sql = 'CREATE TABLE IF NOT EXISTS checkbox(
            idCheckbox tinyint PRIMARY KEY AUTO_INCREMENT,
            checkbox varchar(50)
        )';
        $conexion->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS preferenciasUsuarios (
            idUsuario TINYINT,
            opcion VARCHAR(50),
            CONSTRAINT fk_usuarios FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuarios),
            CONSTRAINT pk_dual PRIMARY KEY (idUsuario,opcion) 
            );";
        $conexion->query($sql); 
        $sql = 'ALTER TABLE usuarios 
                MODIFY correo varchar(50) DEFAULT NULL';
            

        $conexion->query($sql);


        
    //INSERCION MASIVA DE DATOS
    
    $array =['España',
            'Francia',
            'Alemania',
            'Italia',
            'Portugal',
            'Reino Unido',
            'Estados Unidos',
            'Canadá',
            'México',
            'Argentina'];

    $arrayCheck = [
        'reciclaje',
        'contaminacion',
        'zonas industriales',
        'vehiculos electricos'
    ];
    

    for($i=0;$i<sizeof($array);$i++){
         $sql=("INSERT INTO paises(pais) VALUES ('".$array[$i]."')");
         //echo $sql."<br>";

        $conexion->query($sql);
        if($conexion->affected_rows>0)
            echo 'fila insertada <br>'; 

    }
    
    for($i=0;$i<sizeof($arrayCheck);$i++){

        $sql = "INSERT INTO checkbox(checkbox) VALUES ('".$arrayCheck[$i]."')";

         $conexion->query($sql);
        if($conexion->affected_rows>0)
            echo 'fila insertada <br>'; 

    }

    $conexion->close();

?>
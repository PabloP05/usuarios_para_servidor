<?php
    require '../config/consfigDB.php';

    class usuarioWeb{
        public function crearUsuario(){
            $conexion = new mysqli(SERVIDROR,USUARIO,PASWORD,BBDD);

            $sql = "CREATE USER 'usuarioPruebas'@'localhost' IDENTIFIED BY '1234';";
            $conexion->query($sql);

            $sql = "GRANT INSERT,SELECT ON 2daw.* TO 'usuarioPruebas'@'localhost';";
            $conexion->query($sql);

            $sql="FLUSH PRIVILEGES;";
            $conexion->query($sql);
            $conexion->close();
        }
    }
?>
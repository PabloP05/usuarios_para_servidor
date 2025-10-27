<?php
    require 'config/consfigDB.php';
    class rellenarSelect {
        private $conexion;
        
        function __construct(){
            $this->conexion = new mysqli(SERVIDROR, USUARIO, PASWORD, BBDD);
        }

        public function cargarDatosSelect() {
            $sql = "SELECT pais FROM paises";
            $resultado = $this->conexion->query($sql);
            return $resultado;
        }

        public function cargarCheckbox() {
            $sql = "SELECT * FROM checkbox";
            $resultado = $this->conexion->query($sql);
            return $resultado;
        }

        public function cerrarConexion() {
            $this->conexion->close();
        }
}

?>


<?php
    require_once __DIR__ . '/../config/confDBPDO.php';
    class DBPDO {
        public static function getConexion() {
            $conexion = new PDO(DSN, USERNAME, PASSWORD);
            // Para que los errores se vean claros
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }
    }
?>
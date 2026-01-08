<?php
    require_once __DIR__ . '/../config/confDBPDO.php';
    class DBPDO {
        public static function ejecutarConsulta($sql,$parametros){
            $conexion = new PDO(DSN, USERNAME, PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consulta = $conexion->prepare($sql);
            $consulta->execute($parametros);
            $objetoResultado = $consulta->fetch();
            return $objetoResultado;
        }
    };
?>
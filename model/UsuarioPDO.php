<?php
    require_once 'DBPDO.php';
    require_once 'Usuario.php';
    class UsuarioPDO {
        public function validarUsuario($codUsuario, $password) {
            $conexion = DBPDO::getConexion();

            $sql = "SELECT * FROM T01_Usuarios WHERE T01_CodUsuario = :usuario AND T01_Password = SHA2(:password,256)";
            $parametros= [':usuario' => $codUsuario, ':password' => $password];
            $fila = DBPDO::ejecutarConsulta($sql,$conexion,$parametros);

            if ($fila != false) {
                // Usuario válido
                $usuario = new Usuario(
                    $fila['T01_CodUsuario'],
                    $fila['T01_Password'],
                    $fila['T01_DescUsuario'],
                    $fila['T01_NumConexiones'],
                    null,
                    $fila['T01_Perfil'],
                    $fila['T01_ImagenUsuario'],
                    new DateTime($fila['T01_FechaHoraUltimaConexion'])
                );
                
                self::actualizarUltimaConexionYUsuario($usuario,$conexion);
                $_SESSION['usuarioActualDWESLoginLogoff'] = $usuario;
                $_SESSION['paginaEnCurso'] = 'inicioPrivado';
            }
        }
        public static function actualizarUltimaConexionYUsuario($usuario,$conexion){
            $codUsuario=$usuario->getCodUsuario();
            $password=$usuario->getPassword();
            $sqlUpdate = "UPDATE T01_Usuarios SET T01_NumConexiones = T01_NumConexiones + 1, T01_FechaHoraUltimaConexion = NOW() WHERE T01_CodUsuario = :usuario";
            $parametrosUpdate=[':usuario' => $codUsuario];
            DBPDO::ejecutarConsulta($sqlUpdate,$conexion,$parametrosUpdate);

            $sqlSelect = "SELECT * FROM T01_Usuarios WHERE T01_CodUsuario = :usuario AND T01_Password = :password";
            $parametrosSelect=[':usuario' => $codUsuario, ':password' => $password];
            $resultadoSelect = DBPDO::ejecutarConsulta($sqlSelect,$conexion,$parametrosSelect);
            
            $usuario->setFechaHoraUltimaConexion(new DateTime($resultadoSelect['T01_FechaHoraUltimaConexion']));
        }
    }
?>
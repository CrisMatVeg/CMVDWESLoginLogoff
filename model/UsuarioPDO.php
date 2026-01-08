<?php
    require_once 'DBPDO.php';
    require_once 'Usuario.php';
    class UsuarioPDO {
        public function validarUsuario($codUsuario,$password) {
            $sql = "SELECT * FROM T01_Usuarios WHERE T01_CodUsuario = :usuario AND T01_Password = SHA2(:password,256)";
            $parametros= [':usuario' => $codUsuario, ':password' => $password];
            $objetoResultado = DBPDO::ejecutarConsulta($sql,$parametros);

            if ($objetoResultado != false) {
                // Usuario válido
                $usuario = new Usuario(
                    $objetoResultado['T01_CodUsuario'],
                    $objetoResultado['T01_Password'],
                    $objetoResultado['T01_DescUsuario'],
                    $objetoResultado['T01_NumConexiones'],
                    null,
                    $objetoResultado['T01_Perfil'],
                    $objetoResultado['T01_ImagenUsuario'],
                    new DateTime($objetoResultado['T01_FechaHoraUltimaConexion'])
                );
                
                self::actualizarUltimaConexionYUsuario($usuario);
            }else{
                return false;
            }
            return $usuario;
        }
        // actualiza la base de datos y el objeto usuario
        public static function actualizarUltimaConexionYUsuario($usuario){
            $codUsuario=$usuario->getCodUsuario();
            $password=$usuario->getPassword();
            $sqlUpdate = "UPDATE T01_Usuarios SET T01_NumConexiones = T01_NumConexiones + 1, T01_FechaHoraUltimaConexion = NOW() WHERE T01_CodUsuario = :usuario";
            $parametrosUpdate=[':usuario' => $codUsuario];
            DBPDO::ejecutarConsulta($sqlUpdate,$parametrosUpdate);

            $sqlSelect = "SELECT * FROM T01_Usuarios WHERE T01_CodUsuario = :usuario AND T01_Password = :password";
            $parametrosSelect=[':usuario' => $codUsuario, ':password' => $password];
            $resultadoSelect = DBPDO::ejecutarConsulta($sqlSelect,$parametrosSelect);
            
            $usuario->setFechaHoraUltimaConexion(new DateTime($resultadoSelect['T01_FechaHoraUltimaConexion']));
        }
    }
?>
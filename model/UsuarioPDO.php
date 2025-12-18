<?php
    require_once 'DBPDO.php';
    require_once 'Usuario.php';
    class UsuarioPDO {
        public function validarUsuario($codUsuario, $password) {
            $conexion = DBPDO::getConexion();
            $sql = "SELECT * FROM T01_Usuarios WHERE T01_CodUsuario = :usuario AND T01_Password = SHA2(:password,256)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([':usuario' => $codUsuario, ':password' => $password]);
            // Devuelve false si no existe
            $fila = $consulta->fetch();
            if ($fila == false) {
                return false;
            }
            // Actualizamos conexiones
            $usuario=new Usuario();
            $usuario-> fechaHoraUltimaConexionAnterior=new DateTime($fila['T01_FechaHoraUltimaConexion']);
            $sqlUpdate = "UPDATE T01_Usuarios SET T01_NumConexiones = T01_NumConexiones + 1, T01_FechaHoraUltimaConexion = NOW() WHERE T01_CodUsuario = :usuario";
            $consulta = $conexion->prepare($sqlUpdate);
            $consulta->execute([':usuario' => $codUsuario]);
            $sql2 = "SELECT * FROM T01_Usuarios WHERE T01_CodUsuario = :usuario AND T01_Password = SHA2(:password,256)";
            $consulta = $conexion->prepare($sql2);
            $consulta->execute([':usuario' => $codUsuario, ':password' => $password]);
            $fila2 = $consulta->fetch();
            $usuario->codUsuario = $fila2['T01_CodUsuario'];
            $usuario->password = $fila2['T01_Password'];
            $usuario->descUsuario = $fila2['T01_DescUsuario'];
            $usuario->numConexiones = $fila2['T01_NumConexiones'];
            $usuario->fechaHoraUltimaConexion = new DateTime($fila2['T01_FechaHoraUltimaConexion']);
            $usuario->perfil = $fila2['T01_Perfil'];
            $usuario->imagenUsuario = $fila2['T01_ImagenUsuario'];
            // Devolvemos el usuario
            return $usuario;
        }
    }
?>
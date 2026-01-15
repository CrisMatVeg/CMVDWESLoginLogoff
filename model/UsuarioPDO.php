<?php
require_once 'DBPDO.php';
require_once 'Usuario.php';

/**
 * Clase UsuarioPDO
 *
 * Esta clase proporciona métodos para interactuar con la base de datos
 * en relación con usuarios. Permite validar usuarios, actualizar su 
 * última conexión y dar de alta nuevos usuarios.
 *
 * @package Usuarios
 * @author Cristian Mateos
 * @version 1.0
 */
class UsuarioPDO {

    /**
     * Valida un usuario en la base de datos
     *
     * Consulta la tabla T01_Usuarios para comprobar si existe un usuario 
     * con el código y la contraseña proporcionados. Si existe, crea y 
     * devuelve un objeto Usuario; si no, devuelve false.
     *
     * @param string $codUsuario Código del usuario a validar
     * @param string $password Contraseña del usuario
     * @return Usuario|false Devuelve un objeto Usuario si es válido, o false si no lo es
     */
    public static function validarUsuario($codUsuario, $password) {
        $sql = "SELECT * FROM T01_Usuarios WHERE T01_CodUsuario = :usuario AND T01_Password = SHA2(:password,256)";
        $parametros = [':usuario' => $codUsuario, ':password' => $password];
        $objetoResultado = DBPDO::ejecutarConsulta($sql, $parametros);

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
        } else {
            return false;
        }
        return $usuario;
    }

    /**
     * Actualiza la última conexión y la información del usuario en la base de datos
     *
     * Incrementa el número de conexiones y actualiza la fecha/hora de la
     * última conexión en la tabla T01_Usuarios. Luego actualiza el objeto 
     * Usuario pasado como parámetro con la nueva fecha/hora.
     *
     * @param Usuario $usuario Objeto Usuario a actualizar
     * @return void
     */
    public function actualizarUltimaConexionYUsuario($usuario){
        $codUsuario = $usuario->getCodUsuario();
        $password = $usuario->getPassword();

        $sqlUpdate = "UPDATE T01_Usuarios SET T01_NumConexiones = T01_NumConexiones + 1, T01_FechaHoraUltimaConexion = NOW() WHERE T01_CodUsuario = :usuario";
        $parametrosUpdate = [':usuario' => $codUsuario];
        DBPDO::ejecutarConsulta($sqlUpdate, $parametrosUpdate);

        $sqlSelect = "SELECT * FROM T01_Usuarios WHERE T01_CodUsuario = :usuario";
        $parametrosSelect = [':usuario' => $codUsuario];
        $resultadoSelect = DBPDO::ejecutarConsulta($sqlSelect, $parametrosSelect);

        $usuario->setFechaHoraUltimaConexion(new DateTime($resultadoSelect['T01_FechaHoraUltimaConexion']));
    }

    /**
     * Da de alta un nuevo usuario en la base de datos
     *
     * Inserta un nuevo registro en la tabla T01_Usuarios con el código, 
     * contraseña (encriptada) y descripción proporcionados. Si el registro
     * se realiza correctamente, valida el usuario y devuelve el objeto Usuario
     * para la sesión. Si falla, devuelve false.
     *
     * @param string $codUsuario Código del nuevo usuario
     * @param string $password Contraseña del nuevo usuario
     * @param string $descUsuario Descripción o nombre del nuevo usuario
     * @return Usuario|null Objeto Usuario recién creado o null si falla la inserción
     */
    public static function altaUsuario($codUsuario, $password, $descUsuario){
        $datosUsuarioRegistradoParaSession = null;
    
        $sql = "INSERT INTO T01_Usuarios (T01_CodUsuario, T01_Password, T01_DescUsuario) 
                VALUES (:codUsuario, SHA2(:password,256), :descUsuario)";
        $parametros = [
            ':codUsuario' => $codUsuario,
            ':password' => $password,
            ':descUsuario' => $descUsuario
        ];
    
        try {
            // Ejecutar inserción
            DBPDO::ejecutarConsulta($sql, $parametros);
    
            // Si no lanza excepción, el usuario se creó → validar para devolver objeto
            $datosUsuarioRegistradoParaSession = self::validarUsuario($codUsuario, $password);
        } catch(Exception $e){
            // Devuelve null si hubo cualquier error
            return null;
        }
    
        return $datosUsuarioRegistradoParaSession;
    }
    
}
?>

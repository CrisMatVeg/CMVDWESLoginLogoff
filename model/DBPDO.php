<?php
require_once __DIR__ . '/../config/confDBPDO.php';

/**
 * Clase DBPDO
 *
 * Clase que proporciona métodos estáticos para ejecutar consultas SQL
 * utilizando PDO en una base de datos configurada mediante confDBPDO.php.
 *
 * @package Database
 * @author Cristian Mateos
 * @version 1.0
 */
class DBPDO {

    /**
     * Ejecuta una consulta SQL en la base de datos y devuelve el primer resultado.
     *
     * Este método utiliza PDO para conectarse a la base de datos utilizando
     * los parámetros definidos en confDBPDO.php. Permite pasar parámetros
     * opcionales para consultas preparadas.
     *
     * @param string $sql La consulta SQL a ejecutar.
     * @param array|null $parametros (Opcional) Array de parámetros para la consulta preparada.
     * @return mixed Retorna el primer registro devuelto por la consulta como objeto/array, según fetch().
     * @throws PDOException Lanza excepción si ocurre un error en la consulta o la conexión.
     * @static
     */
    public static function ejecutarConsulta($sql, $parametros = null){
        try {
            $conexion = new PDO(DSN, USERNAME, PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $consulta = $conexion->prepare($sql);
            $consulta->execute($parametros != null ? $parametros : null);
            $objetoResultado = $consulta->fetch();
            return $objetoResultado;
        }catch (PDOException $e) {
            $_SESSION['paginaAnterior']=$_SESSION['paginaEnCurso'];
            $_SESSION['paginaEnCurso']='error';
            $_SESSION['error']= new AppError($e->getCode(),$e->getMessage(),$e->getFile(),$e->getLine(), $_SESSION['paginaAnterior']);
            header('Location: indexLoginLogoff.php');
            exit;
        }
    }
};
?>

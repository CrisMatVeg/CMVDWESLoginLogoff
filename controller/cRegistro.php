<?php
/**
 * Controlador: Registro (cRegistro)
 *
 * Este controlador gestiona la lógica de registro de nuevos usuarios
 * de la aplicación Login/Logoff.
 *
 * Funcionalidad:
 * 1. Gestiona el botón "Cancelar"/"Atrás":
 *    - Si se envía el parámetro `atras`, actualiza la página en curso
 *      con la página anterior y redirige a `indexLoginLogoff.php`.
 *
 * 2. Gestiona el alta de usuario:
 *    - Si se envía el parámetro `acceso`, recoge los valores del formulario:
 *      `codUsuario`, `password` y `descUsuario`.
 *    - Valida los campos introducidos mediante la clase `validacionFormularios`.
 *    - Construye la contraseña concatenando el código de usuario y la contraseña.
 *    - Llama al modelo `UsuarioPDO` para dar de alta al usuario.
 *    - Si el alta es correcta:
 *       - Actualiza la última conexión en base de datos y en el objeto usuario.
 *       - Almacena el usuario en la sesión (`usuarioActualDWESLoginLogoff`).
 *       - Actualiza la página en curso a `inicioPrivado` y redirige a
 *         `indexLoginLogoff.php`.
 *    - Si el alta falla, redirige a la página de login.
 *
 * Dependencias:
 * - Clase `UsuarioPDO` y sus métodos `altaUsuario` y `actualizarUltimaConexionYUsuario`
 * - Clase `validacionFormularios` para la validación de datos
 * - Arreglo `$view` para cargar la vista final (`layout`)
 * - Variables de sesión `$_SESSION`
 *
 * @package Controladores
 * @author Cristian Mateos
 * @version 1.0
 */
if (isset($_REQUEST['atras'])) {
    $_SESSION['paginaAnterior'] = $_REQUEST['paginaAnterior'];
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    header('Location: indexLoginLogoff.php');
    exit;
}

/**
 * Array de errores de validación.
 *
 * Cada posición almacenará un mensaje de error o null si el campo es válido.
 *
 * @var array<string, string|null>
 */
$aErrores = [
    'codUsuario' => null,
    'password' => null,
    'descUsuario' => null
];

/**
 * Indica si la entrada de datos es correcta.
 *
 * @var bool
 */
$entradaOK = true;

/**
 * Procesamiento del formulario de acceso/alta.
 */
if (isset($_REQUEST['acceso'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];

    /**
     * Validación de campos del formulario.
     *
     * - codUsuario: alfanumérico (3–10 caracteres)
     * - password: contraseña segura (8–16 caracteres, con complejidad)
     * - descUsuario: descripción del usuario (1–255 caracteres)
     */
    $aErrores['codUsuario'] = validacionFormularios::comprobarAlfaNumerico(
        $_REQUEST['codUsuario'],10,3,1);

    $aErrores['password'] = validacionFormularios::validarPassword(
        $_REQUEST['password'],8,4,1,1);

    $aErrores['descUsuario'] = validacionFormularios::comprobarAlfaNumerico(
        $_REQUEST['descUsuario'],255,1,1);

    /**
     * Comprobación global de errores de validación.
     */
    foreach ($aErrores as $campo => $error) {
        if ($error !== null) {
            $entradaOK = false;
        }
    }

    /**
     * Si la validación es correcta, se realiza el alta del usuario.
     */
    if ($entradaOK) {
        /**
         * La contraseña se compone concatenando el código de usuario
         * y la contraseña introducida.
         *
         * @var string
         */
        $password = $_REQUEST['codUsuario'] . $_REQUEST['password'];

        /**
         * Acceso al modelo de usuarios.
         *
         * @var UsuarioPDO
         */
        $usuarioPDO = new UsuarioPDO();

        /**
         * Alta del usuario en base de datos.
         *
         * @var Usuario|null
         */
        $usuario = $usuarioPDO->altaUsuario(
            $_REQUEST['codUsuario'],
            $password,
            $_REQUEST['descUsuario']
        );

        /**
         * Si el alta falla, se vuelve a la página de login.
         */
        if ($usuario === null) {
            $entradaOK = false;
            $_SESSION['paginaEnCurso'] = 'Login';
            header('Location: indexLoginLogoff.php');
            exit;
        } else {
            /**
             * Actualización de la última conexión y creación de sesión.
             */
            $usuarioPDO->actualizarUltimaConexionYUsuario($usuario);

            $_SESSION['usuarioActualDWESLoginLogoff'] = $usuario;
            $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
            $_SESSION['paginaEnCurso'] = 'inicioPrivado';

            header('Location: indexLoginLogoff.php');
            exit;
        }
    }
} else {
    $entradaOK = false;
}

/**
 * Carga de la vista asociada al layout.
 */
require_once $view['layout'];

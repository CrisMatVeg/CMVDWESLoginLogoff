<?php
    require_once __DIR__ . '/../model/UsuarioPDO.php';
    if (isset($_REQUEST['paginaDestino']) && $_REQUEST['paginaDestino']=="inicioPrivado") {
        $codUsuario = $_REQUEST['codUsuario']==null ? '' : $_REQUEST['codUsuario'];
        $password = $_REQUEST['password']==null ? '' : $codUsuario.$_REQUEST['password'];
        // Llamar al modelo
        $usuarioPDO = new UsuarioPDO();
        $usuario = $usuarioPDO->validarUsuario($codUsuario, $password);

        if ($usuario !== false) {
            // Guardamos el usuario en la sesión (sobrescribe cualquier usuario anterior)
            $_SESSION['usuarioActualDWESLoginLogoff'] = $usuario;
            $_SESSION['paginaEnCurso'] = $_REQUEST['paginaDestino'];
        }
    }
    
    if (isset($_REQUEST['atras'])) {
        $_SESSION['paginaEnCurso'] = $_REQUEST['paginaAnterior'];
    }
    
    require_once $view['layout'];
?>
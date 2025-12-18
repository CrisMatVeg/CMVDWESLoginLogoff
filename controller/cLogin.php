<?php
    require_once __DIR__ . '/../model/UsuarioPDO.php';
    
    // Solo procesamos si se pulsa “entrar”
    if (isset($_REQUEST['accion']) && $_REQUEST['accion'] == 'entrar') {
        $codUsuario = $_REQUEST['codUsuario']==null ? '' : $_REQUEST['codUsuario'];
        $password = $_REQUEST['password']==null ? '' : $codUsuario.$_REQUEST['password'];
        // Llamamos al modelo
        $usuarioPDO = new UsuarioPDO();
        $usuario = $usuarioPDO->validarUsuario($codUsuario, $password);
        if ($usuario != false) {
            // Usuario válido
            $_SESSION['usuarioActualDWESLoginLogoff'] = $usuario;
            $_SESSION['paginaEnCurso'] = 'inicioPrivado';
        }
    }
    
    // Si se pulsa “cancelar”, volvemos a InicioPublico
    if (isset($_REQUEST['accion']) && $_REQUEST['accion'] == 'cancelar') {
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
    }
    
    require_once $view['layout'];
?>
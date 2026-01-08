<?php
    if (!isset($_SESSION['usuarioActualDWESLoginLogoff'])) {
        $_SESSION['paginaEnCurso'] = 'Login';
        require_once $controller['Login'];
        exit;
    }
    require_once $view["layout"];
?>
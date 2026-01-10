<?php
    require_once ("./config/confAPP.php");
    require_once ("./config/confDBPDO.php");
    require_once './model/Usuario.php';
    require_once './model/UsuarioPDO.php';
    session_start();

    // Página por defecto
    if (!isset($_SESSION['paginaEnCurso'])) {
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
    }
    
    // Cargar controller
    require_once ($controller[$_SESSION['paginaEnCurso']]);
?>
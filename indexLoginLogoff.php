<?php
    require_once ("./config/confAPP.php");
    require_once ("./config/confDBPDO.php");
    require_once './model/Usuario.php';
    session_start();

    // Página por defecto
    if (!isset($_SESSION['paginaEnCurso'])) {
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
    }

    // Si se envía una nueva página hacia delante o hacia atrás
    if (isset($_REQUEST['paginaDestino'])) {
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = trim($_REQUEST['paginaDestino']);
    }

    if (isset($_REQUEST['atras'])) {
        if($_REQUEST['atras']=="Cerrar Sesión"){
            session_unset();
            session_destroy();
            session_start();
        }
        $_SESSION['paginaAnterior'] = $_REQUEST['paginaAnterior'];
        $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    }

    // Cargar controller
    require_once ($controller[$_SESSION['paginaEnCurso']]);
?>
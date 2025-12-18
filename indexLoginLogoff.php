<?php
    require_once ("./config/confAPP.php");
    require_once ("./config/confDBPDO.php");
    require_once ('./model/Usuario.php');
    session_start();

    // Página por defecto
    if (!isset($_SESSION['paginaEnCurso'])) {
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
    }

    // Procesar botones
    if (isset($_REQUEST['accion'])) {
        switch($_REQUEST['accion']) {
            case 'Cancelar':
            case 'Volver':
            case 'Cerrar Sesión':
                $_SESSION['paginaAnterior'] = $_REQUEST["paginaAnterior"]?? 'inicioPublico';
                $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
                break;
            case 'Detalle':
                $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
                $_SESSION['paginaEnCurso'] = 'Detalle';
                break;
            case 'Login':
                $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
                $_SESSION['paginaEnCurso'] = 'Login';
                break;
        }
    }

    // Cargamos controller
    require_once ($controller[$_SESSION['paginaEnCurso']]);
?>
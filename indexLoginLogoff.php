<?php
    require_once ("./config/confAPP.php");
    require_once ("./config/confDBPDO.php");
 
    session_start();

    // Si se envía una nueva página
    if (isset($_REQUEST['paginaEnCurso']) && $_REQUEST['paginaEnCurso'] !== $_SESSION['paginaEnCurso']) {
        // Guardamos la página actual como anterior
        if (isset($_SESSION['paginaEnCurso'])) {
            $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        }
        // Actualizamos la página actual
        $_SESSION['paginaEnCurso'] = $_REQUEST['paginaEnCurso'];
    }

    // Procesar botones
    if (isset($_REQUEST['accion'])) {
        switch($_REQUEST['accion']) {
            case 'cancelar':
                //$_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'] ?? 'inicioPublico';
                $_SESSION['paginaEnCurso'] =  $_SESSION['paginaAnterior'] ?? 'inicioPublico';
                break;
            case 'detalle':
                $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
                $_SESSION['paginaEnCurso'] = 'Detalle';
                break;
            case 'entrar':
                $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
                $_SESSION['paginaEnCurso'] = 'inicioPrivado';
                break;
            case 'Login':
                $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
                $_SESSION['paginaEnCurso'] = 'Login';
                break;
        }
    }

    // Página por defecto
    if(empty($_SESSION['paginaEnCurso'])){
        $_SESSION['paginaEnCurso']='inicioPublico';
    }

    // Cargamos controller
    require_once ($controller[$_SESSION['paginaEnCurso']]);
?>
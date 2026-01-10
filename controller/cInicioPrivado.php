<?php
if (!isset($_SESSION['usuarioActualDWESLoginLogoff'])) {
    $_SESSION['paginaEnCurso'] = 'Login';
    header('Location: indexLoginLogoff.php');
    exit;
}
if (isset($_REQUEST['paginaDestino'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = $_REQUEST["paginaDestino"];
    header('Location: indexLoginLogoff.php');
    exit;
}
if (isset($_REQUEST['atras'])) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['paginaAnterior'] = $_REQUEST['paginaAnterior'];
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    header('Location: indexLoginLogoff.php');
    exit;
}
$avInicioPrivado=[
    "codUsuario" => $_SESSION['usuarioActualDWESLoginLogoff']->getCodUsuario(),
    "numConexiones" => $_SESSION['usuarioActualDWESLoginLogoff']->getNumConexiones(),
    "fechaHoraUltimaConexionAnterior" => $_SESSION['usuarioActualDWESLoginLogoff']->getFechaHoraUltimaConexionAnterior(),
    "descUsuario" => $_SESSION['usuarioActualDWESLoginLogoff']->getDescUsuario()
];
require_once $view["layout"];

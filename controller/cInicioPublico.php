<?php
if (isset($_REQUEST['paginaDestino'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = $_REQUEST["paginaDestino"];
    header('Location: indexLoginLogoff.php');
    exit;
}
require_once $view["layout"];

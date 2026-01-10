<?php
if (isset($_REQUEST['paginaDestino']) && $_REQUEST['paginaDestino'] == "inicioPrivado") {
    $codUsuario = $_REQUEST['codUsuario'] == null ? '' : $_REQUEST['codUsuario'];
    $password = $_REQUEST['password'] == null ? '' : $codUsuario . $_REQUEST['password'];
    // Llamar al modelo
    $usuarioPDO = new UsuarioPDO();
    $usuario = $usuarioPDO->validarUsuario($codUsuario, $password);

    if ($usuario !== false) {
        $_SESSION['usuarioActualDWESLoginLogoff'] = $usuario;
        $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
        $_SESSION['paginaEnCurso'] = $_REQUEST["paginaDestino"];
        header('Location: indexLoginLogoff.php');
        exit;
    }
}

if (isset($_REQUEST['atras'])) {
    $_SESSION['paginaAnterior'] = $_REQUEST['paginaAnterior'];
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    header('Location: indexLoginLogoff.php');
    exit;
}

require_once $view['layout'];

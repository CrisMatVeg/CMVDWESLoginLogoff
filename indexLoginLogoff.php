<?php
    require_once ("./config/confAPP.php");
    require_once ("./config/confDBPDO.php");
 
    session_start();
    if(empty($_SESSION['paginaEnCurso'])){
        $_SESSION['paginaEnCurso']='inicioPublico';
    }
    require_once ($controller[$_SESSION['paginaEnCurso']]);
?>
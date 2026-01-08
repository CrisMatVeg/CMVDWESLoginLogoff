<header>
    <div class="logo">
        <span class="owl" aria-hidden="true"></span>
        <span>Login Logoff<span style="color:var(--muted);font-weight:600;margin-left:6px;font-size:.9rem">—
            Inicio Privado</span></span>
    </div>
    <nav>
        <form method="post">
            <input type="hidden" name="paginaAnterior" value="inicioPublico">
            <input type="submit" name="atras" value="Cerrar Sesión" class="btn primary">
        </form>
    </nav>
</header>

<main>
    <?php
        $usuarioActual=$_SESSION['usuarioActualDWESLoginLogoff'];
        $codUsuario=$usuarioActual->getCodUsuario();
        $numConexiones=$usuarioActual->getNumConexiones();
        $fechaHoraUltimaConexionAnterior=$usuarioActual->getFechaHoraUltimaConexionAnterior();
        $descUsuario=$usuarioActual->getDescUsuario();
        echo "<h1>Bienvenido " . $descUsuario . "</h1>";
        echo "<h2>Esta el la " . $numConexiones + 1 . "ª vez que se conecta.</h2>";
        if($numConexiones!=0){
            echo "<h2>Usted se conectó por última vez el ".$fechaHoraUltimaConexionAnterior->format('d')." del ".$fechaHoraUltimaConexionAnterior->format('m'). " de " .$fechaHoraUltimaConexionAnterior->format('Y'). " a las " .$fechaHoraUltimaConexionAnterior->format('H').":".$fechaHoraUltimaConexionAnterior->format('i')."</h2>";
        }else{
            echo '<h2>BIENVENIDO!</h2>';
        }
        echo '<br>'
    ?>
    <form method="post">
        <input type="submit" name="paginaDestino" value='Detalle' class="btn primary">
    </form>
</main>
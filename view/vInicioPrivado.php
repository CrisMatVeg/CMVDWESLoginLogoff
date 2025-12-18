<header>
    <div class="logo">
        <span class="owl" aria-hidden="true"></span>
        <span>Login Logoff<span style="color:var(--muted);font-weight:600;margin-left:6px;font-size:.9rem">—
            Inicio Privado</span></span>
    </div>
    <nav>
        <form method="post" action="indexLoginLogoff.php">
            <input type="hidden" name="paginaAnterior" value="Login">
            <input type="submit" name="accion" value="cancelar" class="btn primary">
        </form>
    </nav>
</header>

<main>
    <?php
        $usuarioActual=$_SESSION['usuarioActualDWESLoginLogoff'];
        echo "<h1>Bienvenido " . $usuarioActual->descUsuario . "</h1>";
        echo "<h2>Esta el la " . $usuarioActual->numConexiones . "ª vez que se conecta.</h2>";
        if($usuarioActual->numConexiones>1){
            echo "<h2>Usted se conectó por última vez el ".$usuarioActual->fechaHoraUltimaConexionAnterior->format('d')." del ".$usuarioActual->fechaHoraUltimaConexionAnterior->format('m'). " de " .$usuarioActual->fechaHoraUltimaConexionAnterior->format('Y'). " a las " .$usuarioActual->fechaHoraUltimaConexionAnterior->format('H').":".$usuarioActual->fechaHoraUltimaConexionAnterior->format('i')."</h2>";
        }else{
            echo '<h2>BIENVENIDO!</h2>';
        }
    ?>
    <form method="post" action="indexLoginLogoff.php">
        <input type="submit" name="accion" value='detalle' class="btn primary">
    </form>
</main>
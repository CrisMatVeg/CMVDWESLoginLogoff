<header>
    <div class="logo">
        <span class="owl" aria-hidden="true"></span>
        <span>Login Logoff<span style="color:var(--muted);font-weight:600;margin-left:6px;font-size:.9rem">—
            Detalle</span></span>
    </div>
    <form method="post" action="indexLoginLogoff.php">
        <input type="hidden" name="paginaAnterior" value="inicioPrivado">
        <input type="submit" name="accion" value="Volver" class="btn primary">
    </form>
</header>

<main>
<section class="hero">
<div>
    <h1>Superglobales y phpinfo()</h1>
    <?php
        // Mostrar información de $_SESSION
        echo '<h1>$_SESSION</h1>';
        echo '<table><tr><th>Clave</th><th>Valor</th></tr>';
        foreach ($_SESSION as $clave => $valor) {
            echo "<tr><th>$clave</th><td>";
            echo "<pre>"; 
            print_r($valor); // Imprime de forma legible el contenido de la variable
            echo "</pre>";
            echo "</td></tr>";
        }
        echo '</table>';

        // Mostrar información de $_COOKIE
        echo '<h3>$_COOKIE</h3>';
        echo '<table><tr><th>Clave</th><th>Valor</th></tr>';
        foreach ($_COOKIE as $clave => $valor) {
            echo "<tr><th>$clave</th><td>" . $valor . "</td></tr>";
        }
        echo '</table>';

        // Mostrar información de $_SERVER
        echo '<h3>$_SERVER</h3>';
        echo '<table><tr><th>Clave</th><th>Valor</th></tr>';
        foreach ($_SERVER as $clave => $valor) {
            echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
        }
        echo '</table>';

        // Mostrar información de $_ENV
        echo '<h3>$_ENV</h3>';
        echo '<table><tr><th>Variable $_ENV</th><th>Valor</th></tr>';
        foreach ($_ENV as $clave => $valor) {
            echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
        }
        echo '</table>';

        // Mostrar información de $_REQUEST
        echo '<h3>$_REQUEST</h3>';
        echo '<table><tr><th>Clave</th><th>Valor</th></tr>';
        foreach ($_REQUEST as $clave => $valor) {
            echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
        }
        echo '</table>';

        // Mostrar información de $_GET
        echo '<h3>$_GET</h3>';
        echo '<table><tr><th>Clave</th><th>Valor</th></tr>';
        foreach ($_GET as $clave => $valor) {
            echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
        }
        echo '</table>';

        // Mostrar información de $_POST
        echo '<h3>$_POST</h3>';
        echo '<table><tr><th>Variable $_POST</th><th>Valor</th></tr>';
        foreach ($_POST as $clave => $valor) {
            echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
        }
        echo '</table>';

        // Mostrar información de $_FILES (archivos subidos)
        echo '<h3>$_FILES</h3>';
        echo '<table><tr><th>Variable $_FILES</th><th>Valor</th></tr>';
        foreach ($_FILES as $clave => $valor) {
            echo "<tr><th>$$clave</th><td>" . $valor . "</td></tr>";
        }
        echo '</table>';

        // Mostrar información completa de PHP, configuración del servidor, módulos, etc.
        echo phpinfo();
    ?>
</div>
</section>
</main>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Logoff</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./webroot/css/estilosLoginLogoff.css">

        <style>
            @font-face {
                font-family: "mFeather";
                src: url("./webroot/fonts/Nunito/static/Nunito-Black.ttf") format("truetype");
                font-weight: 700;
                font-style: normal;
            }

            @font-face {
                font-family: "mNunito";
                src: url("./webroot/fonts/Nunito/Nunito-VariableFont_wght.ttf") format("truetype");
                font-weight: bold;
                font-style: normal;
            }

            :root {
                --brand-green: #58cc02;
                --accent: #4a9bff;
                --footera: #A5ED6E;
                --footertext: #D7FFB8;
                --bg: #f7fbff;
                --text: #1a1a1a;
                --muted: #6b7280;
                --max-width: 100vw;
                --btnshadow:#58A700;

                --headline: 'mFeather';
                --body: 'mNunito';
            }

            .logo .owl {
                width: 60px;
                height: 60px;
                background-image: url("./webroot/images/paloma.svg");
                background-size:cover;
                background-repeat: no-repeat;
                display: inline-block;
            }

            #es, #pr, #fr {
                display: none;
            }

            img{
                height: 30px;
            }

            form{
                display: flex;
                justify-content:center;
                align-content:center;
                gap:10px;
            }

            form *{
                cursor: pointer;
            }

            .labels{
                display: flex;
                justify-content:center;
                align-content:center;
                gap:10px;
                padding-top:10px;
            }

            .cta {
                width: 120px;
                box-shadow: 0px 5px 0px 0px var(--btnshadow);
            }

            .hero div img{
                width: 700px;
                height: 450px;
            }

            .selected-idioma img{
                border:4px solid var(--accent);
                border-radius:10px; 
            }
        </style>
    </head>
    <body>
        <div class="container">
        <?php
            require_once $view[$_SESSION['paginaEnCurso']];
        ?>
            <footer>
                <div class="footer-grid">
                    <div>© 2025-26 IES Los Sauces. Todos los derechos reservados. <a href="../CMVDWESProyectoDWES/indexProyectoDWES.php" title="Inicio">Cristian Mateos Vega</a></div>
                    <div>
                        <a href="https://es.duolingo.com/" target="_blank" title="Duolingo">Pagina Imitada</a>
                        ·
                        <a href="https://github.com/CrisMatVeg/CMVDWESLoginLogoff" target="_blank" title="Github"><i class="fa-brands fa-github fa-2xl"></i></a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

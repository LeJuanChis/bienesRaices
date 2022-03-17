<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;

    if(!isset($inicio)){
        $inicio = null;
    }
    

   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raices</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenido-header contenedor">

            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono menu responsive">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Boton para dark mode">
                    <nav class="navegacion">
                        <a href="nosotros">Nosotros</a>
                        <a href="propiedades">Propiedades</a>
                        <a href="blog">Blog</a>
                        <a href="contacto">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/logout">Cerrar sesion</a>
                        <?php else: ?>
                            <a href="/login">Administradores</a>
                            <?php endif; ?>
                    </nav>
                </div>

            </div>
            <!--Fin de la barra superior-->

            <?php
            if ($inicio) {
                echo "<h1>Venta de casas y departamentos de lujo</h1>";
            }
            ?>
        </div>
    </header>

<?php 
echo $contenido; //mostramos la variable con la informacion de nuestro include en el router
?>



    <footer class="seccion footer">
        <div class="contenido-footer contenedor">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos reservados <?php echo date('Y') ?> &copy;</p>
    </footer>

    <script src="../build/js/bundle.js"></script>
</body>
</html>
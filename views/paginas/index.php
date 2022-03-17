<main class="contenedor seccion">
    <h2>Mas sobre nosotros</h2>
    <div class="iconos-nosotros">
        <div class="icono">
            <img class="icono-negro" src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae ratione deserunt perspiciatis commodi, nisi amet corporis et ducimus voluptate ad molestiae, enim possimus, obcaecati illum eaque aliquid dolorem vel officia!</p>
        </div>

        <div class="icono">
            <img class="icono-negro" src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae ratione deserunt perspiciatis commodi, nisi amet corporis et ducimus voluptate ad molestiae, enim possimus, obcaecati illum eaque aliquid dolorem vel officia!</p>
        </div>

        <div class="icono">
            <img class="icono-negro" src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
            <h3>Tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae ratione deserunt perspiciatis commodi, nisi amet corporis et ducimus voluptate ad molestiae, enim possimus, obcaecati illum eaque aliquid dolorem vel officia!</p>
        </div>
    </div>
</main>

<section class="seccion contenedor">
    <h2>Casas y departamentos en venta</h2>

    <div class="contenedor-anuncios">

    <?php 
        
        $limite = 3;
        include __DIR__.'/propiedades.php';
        
    ?>


    </div>
    <!--Contenedor de anuncios-->
    <div class="boton-derecha">
        <a href="propiedades" class="boton-verde">Ver todos</a>
    </div>
</section>
<!--Seccion-->


<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario para que un asesor de contacte</p>
    <a href="contacto.php" class="boton-amarillo">Contactanos</a>
</section>



<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro blog</h3>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source src="build/img/blog1.webp" type="image/webp">
                    <source src="build/img/blog1.jpg" type="image/jpeg">
                    <img src="build/img/blog1.jpg" alt="Blog 1" loading="lazy">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p>Escrito el <span>20-10-2021</span> por <span>Admin</span></p>

                    <p>Consejos para construir una terraza en el techo de tu casa</p>
                </a>
            </div>

        </article>
        <!--Entrada del blog-->

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source src="build/img/blog2.webp" type="image/webp">
                    <source src="build/img/blog2.jpg" type="image/jpeg">
                    <img src="build/img/blog2.jpg" alt="Blog 2" loading="lazy">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guia para la decoracion de tu hogar</h4>
                    <p>Escrito el <span>20-10-2021</span> por <span>Admin</span></p>

                    <p>La mejor decoracion para tu hogar en fechas especiales</p>
                </a>
            </div>

        </article>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonio">
            <blockquote>
                El personal se comporto de la mejor manera posible, son la mejor inmobiliaria del pais!!!
            </blockquote>
            <p>-Juan Carlos Osorio</p>
        </div>
    </section>
</div>

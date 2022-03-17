
<main class="contenedor-solo">

<div class=" anuncio-solo ">
<?php if (!empty($propiedad->imagen)): ?>
            <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen propiedad" loading="lazy">
            <?php else:  ?>
                <img src="/imagenes/defecto.jpg" alt="Imagen propiedad" loading="lazy">
                <?php endif; ?>
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo; ?></h3>
            <p class="text-overflow"><?php echo $propiedad->descripcion; ?></p>
            <p class="precio"><?php echo $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono-negro" src="build/img/icono_wc.svg" alt="Icono WC">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="icono-negro" src="build/img/icono_dormitorio.svg" alt="Icono dormitorio">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
                <li>
                    <img class="icono-negro" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento">
                    <p><?php echo $propiedad->estacionamientos; ?></p>
                </li>

            </ul>

           
        </div>
        <!--Contenido del anuncio-->


    </div>
</main>

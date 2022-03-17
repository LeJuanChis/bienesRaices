<main class="contenedor seccion">
    <div class="alerta notificacion">
            <p><?php
            if($mensaje){
               echo mostrarNotificaciones($mensaje);
                
            }
             
             ?></p>
    </div>
    <h2>Administrador de bienes raices</h2>

    <a href="/propiedades/crear" class="boton-verde">Crear una nueva propiedad</a>
    <a href="/vendedores/crear" class="boton-amarillo">Crear un nuevo vendedor</a>
            <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Mostramos las propiedades -->
            <?php foreach ($propiedades as $propiedad): ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?> </td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen propiedad" class="imagen-tabla"></td>
                    <td><?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method='POST' class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" value="<?php echo $propiedad->id; ?>" name="id">
                            <input type="hidden" value="propiedad" name="tipo">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Mostramos las propiedades -->
            <?php foreach ($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><img class="imagen-tabla" src="<?php echo 'imagenesVendedores/'.$vendedor->imagen; ?>" alt="Foto del vendedor"></td>
                    <td><?php echo $vendedor->nombre. ' ' .$vendedor->apellido; ?> </td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method='POST' class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" value="<?php echo $vendedor->id; ?>" name="id">
                            <input type="hidden" value="vendedor" name="tipo">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>

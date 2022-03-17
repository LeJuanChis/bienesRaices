<main class="contenedor seccion">
    <h2>Actualizar la propiedad</h2>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <p><?= $error ?></p>
        </div>
    <?php endforeach; ?>
    <a href="/admin" class="boton-verde">Volver</a>

    <form action="/propiedades/actualizar" method="POST" class="formulario" enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $propiedad->id; ?>" name="propiedad[id]">
    <?php include __DIR__."/formulario.php"; 
        
    ?>
        
        <input type="submit" class="boton-amarillo" value="Actualizar la propiedad">
    </form>


</main>
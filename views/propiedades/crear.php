<main class="contenedor seccion">
    <h2>Crear</h2>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <p><?= $error ?></p>
        </div>
    <?php endforeach; ?>
    <a href="/admin" class="boton-verde">Volver</a>

    <form action="/propiedades/crear" method="POST" class="formulario" enctype="multipart/form-data">
        
        <?php include __DIR__."/formulario.php"; ?>

        <input type="submit" class="boton-amarillo" value="Subir propiedad">
    </form>


</main>
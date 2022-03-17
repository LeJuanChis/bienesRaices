<main class="contenedor seccion">
    <h2>Actualizar el vendedor</h2>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <p><?= $error ?></p>
        </div>
    <?php endforeach; ?>
    <a href="/admin" class="boton-verde">Volver</a>

    <form  method="POST" class="formulario" enctype="multipart/form-data">
        <input type="hidden" name="vendedor[id]" value="<?php echo $vendedor->id; ?>">
        <?php include __DIR__."/formulario.php"; ?>

        <input type="submit" class="boton-amarillo" value="Actualizar vendedor">
    </form>


</main>

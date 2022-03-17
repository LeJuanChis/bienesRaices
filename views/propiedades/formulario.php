<fieldset>
            <legend>Informacion general</legend>

            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo de la propiedad" autocomplete="off" value="<?php echo sanitizar($propiedad->titulo); ?>">

            <label for="precio">Precio</label>
            <input type="number" name="propiedad[precio]" id="Precio" placeholder="Precio de la propiedad" value="<?php echo sanitizar($propiedad->precio); ?>">

            <label for="imagen">Foto</label>
            <input type="file" name="propiedad[imagen]" id="imagen" accept="image/jpeg, image/png, image/jpg">

            <?php if($propiedad->imagen): ?>
                <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small" alt="Imagen de la propiedad">
                <?php endif; ?>
            <label for="descripcion">Descripcion</label>
            <textarea name="propiedad[descripcion]" id="descripcion"><?php echo sanitizar($propiedad->descripcion); ?></textarea>

            
        </fieldset>



        <fieldset>
            <legend>Informacion de la propiedad</legend>

            <label for="n_habitaciones">Habitaciones</label>
            <input type="number" id="n_habitaciones" name="propiedad[habitaciones]" placeholder="Numero de habitaciones" min="1" value="<?php echo sanitizar($propiedad->habitaciones); ?>">

            <label for="n_baños">Baños</label>
            <input type="number" id="n_baños" name="propiedad[wc]" placeholder="Numero de baños" min="1" value="<?php echo sanitizar($propiedad->wc); ?>">

            <label for="n_estacionamientos">Estacionamientos</label>
            <input type="number" id="n_estacionamientos" name="propiedad[estacionamientos]" placeholder="Numero de estacionamientos" min="1" value="<?php echo sanitizar($propiedad->estacionamientos); ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <label for="vendedor">Seleccione el vendedor</label>
            <select name="propiedad[id_vendedor]" id="vendedor">
                <option value="" selected>--Selecciona--</option>
                <?php foreach ($vendedores as $vendedor) : ?>
                    <option 
                    <?php echo $propiedad->id_vendedor === $vendedor->id ? 'selected' : '';?>
                    value="<?php echo sanitizar($vendedor->id);?>">
                    <?php echo sanitizar($vendedor->nombre . ' ' . $vendedor->apellido); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </fieldset>

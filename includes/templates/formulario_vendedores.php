<fieldset>

<legend>Informacion personal</legend>

<label for="Nombre">Nombre: </label>
<input type="text" name="vendedor[nombre]" placeholder="Su nombre" autocomplete="off" id="Nombre" value="<?php echo sanitizar($vendedor->nombre)?>">

<label for="Apellido">Apellidos: </label>
<input type="text" name="vendedor[apellido]" placeholder="Sus apellidos" autocomplete="off" id="Apellido" value="<?php echo sanitizar($vendedor->apellido)?>">

<label for="Telefono">Telefono: </label>
<input type="number" name="vendedor[telefono]" placeholder="Su telefono" autocomplete="off" id="Telefono" value="<?php echo sanitizar($vendedor->telefono)?>">

<label for="imagen">Foto</label>
<input type="file" name="vendedor[imagen]" id="imagen" accept="image/jpeg, image/png, image/jpg">

</fieldset>
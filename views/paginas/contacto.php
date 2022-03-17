
    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php 
            if($mensaje){
                echo "<p class='alerta  notificacion'>".$mensaje."</p>";
            }
        ?>
        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Imagen contacto" loading="lazy">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" method="POST" action="/contacto">
            <fieldset>
                <legend>Informacion personal</legend>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu nombre" name="contacto[nombre]" >


                <label for="telefono">Telefono</label>
                <input type="tell" id="telefono" placeholder="Tu telefono" name="contacto[telefono]">

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="contacto[mensaje]"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <label for="opciones">Vende o compra</label>
                <select id="opciones" name="contacto[opciones]" >
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="compra">Compra</option>
                    <option value="vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto</label>
                <input type="number" id="presupuesto" placeholder="Tu precio o presupuesto" name="contacto[presupuesto]">
            </fieldset>

            <fieldset>
                <legend>Informacion de contacto</legend>

                <p>Como desea ser contactado?</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" value="telefono"  id="contactar-telefono" name="contacto[contactar]">
                    
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email"  id="contactar-email" name="contacto[contactar]">
                </div>

                <div id="contacto"></div>


                
            </fieldset>


            <input type="submit" value="Enviar" class="boton-verde">

        </form>
    </main>

<main class="contenedor seccion">
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <p><?php echo $error; ?></p>
        </div>
        <?php endforeach; ?>
        <h2>Login</h2>

        <form class="formulario" method="POST" action="login">
            <fieldset>
                <legend>Email y Password</legend>
                
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Tu email" autocomplete="off" id="email"> 

                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Tu password" name="password">
            </fieldset>

            <input type="submit" value="Iniciar sesion" class="boton-amarillo">
        </form>
    </main>

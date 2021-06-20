<h2>Iniciar sesión</h2>

<form action="<?=base_url?>usuarios/login" method="post">

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" required>

    <input type="submit" value="Iniciar sesión">

</form>
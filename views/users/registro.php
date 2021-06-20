<h2>Registrarse</h2>

<form action="<?=base_url?>usuarios/register" method="post">

    <label for="nick">Nick</label>
    <input type="text" name="nick" required>

    <label for="name">Nombre</label>
    <input type="text" name="name" required>

    <label for="surname">Apellido</label>
    <input type="text" name="surname" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" required>

    <?php if(isset($_SESSION['identity']) && $_SESSION['identity']['role'] == 'admin'): ?>
        <select name="role">
            <option value="admin">Administrador</option>
            <option value="vendor">Vendedor</option>
            <option value="client" selected>Cliente</option>
        </select>
    <?php else: ?>
        <input type="hidden" name="role" value="client">
    <?php endif; ?>

    <?php if(isset($_SESSION['identity']) && $_SESSION['identity']['role'] == 'admin'): ?>
        <input type="submit" value="Guardar">
    <?php else: ?>
        <input type="submit" value="Registrarse">
    <?php endif; ?>

</form>

<?php if(isset($_SESSION['identity'])): ?>
    <a href="<?=base_url?>usuarios/gestion"><button>Cancelar</button></a>
<?php else: ?>
    <a href="<?=base_url?>"><button>Cancelar</button></a>
<?php endif; ?>
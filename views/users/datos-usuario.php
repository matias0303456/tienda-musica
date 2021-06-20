<h2>Editar datos de <?=$user['nick']?></h2>

<form action="<?=base_url?>usuarios/update&id=<?=$user['id']?>" method="post">

    <label for="nick">Nick</label>
    <input type="text" name="nick" value="<?=$user['nick']?>" required>

    <label for="name">Nombre</label>
    <input type="text" name="name" value="<?=$user['name']?>" required>

    <label for="surname">Apellido</label>
    <input type="text" name="surname" value="<?=$user['surname']?>" required>

    <label for="email">Email</label>
    <input type="email" name="email" value="<?=$user['email']?>" required>

    <?php if(isset($_SESSION['identity']) && $_SESSION['identity']['role'] == 'admin'): ?>
        <select name="role">
            <?php if($user['role'] == 'admin'): ?>
                <option value="admin" selected>Administrador</option>
                <option value="vendor">Vendedor</option>
                <option value="client">Cliente</option>
            <?php elseif($user['role'] == 'vendor'): ?>
                <option value="admin">Administrador</option>
                <option value="vendor" selected>Vendedor</option>
                <option value="client">Cliente</option>
            <?php else: ?>
                <option value="admin">Administrador</option>
                <option value="vendor">Vendedor</option>
                <option value="client" selected>Cliente</option>
            <?php endif; ?>
        </select>
    <?php else: ?>
        <input type="hidden" name="role" value="client">
    <?php endif; ?>

    <input type="submit" value="Guardar">

</form>

<a href="<?=base_url?>usuarios/eliminar_cuenta&id=<?=$_SESSION['identity']['id']?>"><button>Eliminar mi cuenta</button></a>

<?php if(isset($_SESSION['identity']) && $_SESSION['identity']['role'] == 'admin'): ?>
    <a href="<?=base_url?>usuarios/gestion"><button>Cancelar</button></a>
<?php else: ?>
    <a href="<?=base_url?>"><button>Cancelar</button></a>
<?php endif; ?>
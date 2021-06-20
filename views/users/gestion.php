<h2>Usuarios</h2>

<a href="<?=base_url?>usuarios/registro"><button>Nuevo</button></a>

<?php if(!isset($users) || empty($users)): ?>
    <h3>No existen usuarios registrados.</h3>

<?php else: ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Nick</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acción</th>
        </tr>
        <?php foreach($users as $index => $user): ?>
            <tr>
                <td><?=$user['id']?></td>
                <td><?=$user['nick']?></td>
                <td><?=$user['name']?></td>
                <td><?=$user['surname']?></td>
                <td><?=$user['email']?></td>
                <td><?=$user['role']?></td>
                <td><a href="<?=base_url?>usuarios/datos_usuario&id=<?=$user['id']?>"><button>Editar</button></a><a href="<?=base_url?>usuarios/eliminar_cuenta&id=<?=$user['id']?>"><button>Borrar</button></a></td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>
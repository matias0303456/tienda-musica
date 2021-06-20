<h2>Órdenes</h2>

<?php if(!isset($orders) || empty($orders)): ?>
    <h3>No existen órdenes guardadas</h3>

<?php else: ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Email de usuario</th>
            <th>Destino</th>
            <th>Contacto</th>
            <th>Estado</th>
            <th>Actualizado</th>
            <th>Acción</th>
        </tr>
        <?php foreach($orders as $index => $order): ?>
            <tr>
                <td># <?=$order['id']?></td>
                <td><?=$order['user']?></a></td>
                <td><?=$order['destination']?></a></td>
                <td><?=$order['contact']?></a></td>
                <td><?=$order['status']?></a></td>
                <td><?=$order['updated_at']?></a></td>
                <td>
                    <a href="<?=base_url?>compras/editar_orden&id=<?=$order['id']?>"><button>Editar</button></a><a href="<?=base_url?>compras/borrar_orden&id=<?=$order['id']?>"><button>Borrar</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>
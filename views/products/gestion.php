<h2>Productos</h2>

<a href="<?=base_url?>productos/crear"><button>Nuevo</button></a>

<?php if(!isset($products) || empty($products)): ?>
    <h3>No existen productos guardados</h3>

<?php else: ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Categoría</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Actualizado</th>
            <th>Acción</th>
        </tr>
        <?php foreach($products as $index => $product): ?>
            <tr>
                <td><?=$product['id']?></td>
                <td><a href="<?=base_url?>productos/categoria&id=<?=$product['category_id']?>"><?=$product['category']?></a></td>
                <td><a href="<?=base_url?>productos/producto&id=<?=$product['id']?>"><?=$product['name']?></a></td>
                <td><?=$product['description']?></td>
                <td>$ <?=$product['price']?></td>
                <td><?=$product['stock']?></td>
                <td><?=$product['updated_at']?></td>
                <td>
                <a href="<?=base_url?>productos/editar&id=<?=$product['id']?>"><button>Editar</button></a><a href="<?=base_url?>productos/borrar&id=<?=$product['id']?>"><button>Borrar</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>
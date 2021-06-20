<h2>Categorías</h2>

<a href="<?=base_url?>categorias/crear"><button>Nueva</button></a>

<?php if(!isset($categories) || empty($categories)): ?>
    <h3>No existen categorías guardadas</h3>

<?php else: ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acción</th>
        </tr>
        <?php foreach($categories as $index => $category): ?>
            <tr>
                <td><?=$category['id']?></td>
                <td><a href="<?=base_url?>productos/categoria&category=<?=$category['name']?>"><?=$category['name']?></a></td>
                <td>
                    <a href="<?=base_url?>categorias/editar&id=<?=$category['id']?>"><button>Editar</button></a><a href="<?=base_url?>categorias/borrar&id=<?=$category['id']?>"><button>Borrar</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>

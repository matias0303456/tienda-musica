<h2>Categorías</h2>

<?php if(!isset($categories) || empty($categories)): ?>
    <h3>No existen categorías guardadas</h3>

<?php else: ?>

    <table>
        <?php foreach($categories as $index => $category): ?>
            <tr>
                <td><a href="<?=base_url?>productos/categoria&id=<?=$category['id']?>"><?=$category['name']?></a></td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>


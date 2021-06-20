<h2><?=$category['name']?></h2>

<?php if(!isset($products) || empty($products)): ?>
    <h3>No existen productos guardados</h3>

<?php else: ?>

    <?php foreach($products as $index => $product): ?>
        <ul>
            <li><a href="<?=base_url?>productos/producto&id=<?=$product['id']?>"><?=$product['name']?></a></li>
            <li>
                <?php foreach($images as $index => $image): ?>
                    <?php if($image['product_id'] == $product['id']): ?>
                        <img src="../../<?=$image['path']?>" alt="Imagen del producto" width="50" height="50">
                    <?php endif; ?>
                <?php endforeach; ?>
            </li>
            <li><?=$product['description']?></li>
            <li>Precio: $ <?=$product['price']?></li>
            <li>Stock: <?=$product['stock']?></li>
        </ul>
    <?php endforeach; ?>

<?php endif; ?>
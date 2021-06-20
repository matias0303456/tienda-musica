<h2>Nuestros productos</h2>

<?php if (!isset($products) || empty($products)) : ?>
    <h3>No existen productos guardados</h3>

<?php else : ?>

    <div id="main-container">
        <?php foreach ($products as $index => $product) : ?>
            <ul class="product-card">
                <li class="product-name"><a href="<?= base_url ?>productos/producto&id=<?= $product['id'] ?>"><?= $product['name'] ?></a></li>
                <li>
                    <?php foreach ($images as $index => $image) : ?>
                        <?php if ($image['product_id'] == $product['id']) : ?>
                            <img src="../../<?= $image['path'] ?>" alt="Imagen del producto">
                        <?php endif; ?>
                    <?php endforeach; ?>
                </li>
                <li class="product-description"><?= $product['description'] ?></li>
                <li class="product-price">Precio: $ <?= $product['price'] ?></li>
                <li class="product-stock">Stock: <?= $product['stock'] ?></li>
            </ul>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
<h2>Mi carrito</h2>

<?php if(!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])): ?>

    <h3>El carrito está vacío</h3>

<?php else: ?>

    <ul>
        <?php foreach($_SESSION['carrito'] as $index => $element): ?>
            <li>Producto: <?=$element['product_name']?></li>
            <li>Cantidad: <?=$element['amount']?></li><a href=""><button>+</button></a><a href=""><button>-</button></a>
            <li>Precio: $ <?=$element['price']?></li>
            <li>Total: $ <?=$element['total']?></li>
            <a href="<?=base_url?>carrito/eliminar&id=<?=$element['product_id']?>"><button>Eliminar</button></a>
            <hr>
        <?php endforeach; ?>
        <li>Total carrito: $ <?=$_SESSION['total_carrito']?></li>
    </ul>

<?php endif; ?>
<h2>Confirmar compra</h2>

<h3>Producto: <?=$product['name']?></h3>
<h3>Precio: $ <?=$product['price']?></h3>

<form action="<?=base_url?>compras/generate" method="post">

    <label for="amount">Unidades</label>
    <input type="number" name="amount" value="1" required>

    <label for="destination">Destino</label>
    <input type="text" name="destination" required>

    <label for="contact">Contacto</label>
    <input type="text" name="contact" required>

    <input type="hidden" name="price" value="<?=$product['price']?>" required>
    <input type="hidden" name="product_id" value="<?=$product['id']?>" required>
    <input type="hidden" name="status" value="Pendiente" required>

    <input type="submit" value="Confirmar">

</form>
<h2>Editar producto</h2>

<h3>Imágenes del producto</h3>
<p>
    <?php if(empty($images)): ?>
        El producto no tiene imágenes.
    <?php else: ?>
        <?php foreach($images as $index => $image): ?>
            <img src="../../<?=$image['path']?>" alt="Imagen del producto" width="50" height="50">
            <a href="<?=base_url?>productos/borrar_imagen&id=<?=$image['id']?>"><button>Borrar</button></a>
        <?php endforeach; ?>
    <?php endif; ?>
</p>

<h3>Información</h3>
<form action="<?=base_url?>productos/update&id=<?=$product['id']?>" method="post" enctype="multipart/form-data">

    <label for="name">Nombre</label>
    <input type="text" name="name" value="<?=$product['name']?>" required>

    <label for="category">Categoría</label>
    <select name="category" required>
        <?php foreach($categories as $index => $category): ?>
            <?php if($product['category_id'] == $category['id']): ?>
                <option value="<?=$product['category_id']?>" selected><?=$product['category']?></option>
            <?php else: ?>
                <option value="<?=$category['id']?>"><?=$category['name']?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select>

    <label for="description">Descripción</label>
    <textarea name="description" id="" cols="30" rows="10" required><?=$product['description']?></textarea>

    <label for="price">Precio</label>
    <input type="number" name="price" value="<?=$product['price']?>" required>

    <label for="stock">Stock</label>
    <input type="number" name="stock" value="<?=$product['stock']?>" required>

    <label for="image">Imágenes</label>
    <input type="file" name="image[]" accept=".jpg" multiple>

    <input type="submit" value="Guardar">

</form>

<a href="<?=base_url?>productos/gestion"><button>Cancelar</button></a>

<h2>Nuevo producto</h2>

<form action="<?=base_url?>productos/create" method="post">

    <label for="category">Categoría</label>
    <select name="category_id" required>
        <?php foreach($categories as $index => $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach; ?>
    </select>

    <label for="name">Nombre</label>
    <input type="text" name="name" required>

    <label for="description">Descripción</label>
    <textarea name="description" id="" cols="30" rows="10" required></textarea>

    <label for="price">Precio</label>
    <input type="number" name="price" required>

    <label for="stock">Stock</label>
    <input type="number" name="stock" required>

    <input type="submit" value="Guardar">

</form>

<a href="<?=base_url?>productos/gestion"><button>Cancelar</button></a>

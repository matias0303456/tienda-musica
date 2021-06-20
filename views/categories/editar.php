<h2>Editar categoría</h2>

<form action="<?=base_url?>categorias/update&id=<?=$category['id']?>" method="post">
    <label for="name">Nombre</label>
    <input type="text" name="name" value="<?=$category['name']?>" required>
    <input type="submit" value="Guardar">
</form>

<a href="<?=base_url?>categorias/gestion"><button>Cancelar</button></a>

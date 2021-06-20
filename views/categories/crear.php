<h2>Nueva categoría</h2>

<form action="<?=base_url?>categorias/create" method="post">
    <label for="name">Nombre</label>
    <input type="text" name="name" required>
    <input type="submit" value="Guardar">
</form>

<a href="<?=base_url?>categorias/gestion"><button>Cancelar</button></a>

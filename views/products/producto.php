<h2><?=$product['name'] ?></h2>
<i><?=$product['category'] ?></i>
<p>
    <?php foreach($images as $index => $image): ?>
        <img src="../../<?=$image['path']?>" alt="Imagen del producto" width="50" height="50">
    <?php endforeach; ?>
</p>
<p><?=$product['description'] ?></p>
<p>Precio: $<?=$product['price'] ?></p>
<p>Stock: <?=$product['stock'] ?></p>

<a href="<?=base_url?>compras/confirmacion&id=<?=$product['id']?>"><button>Comprar</button></a>
<a href="<?=base_url?>carrito/add&id=<?=$product['id']?>"><button>Agregar al carrito</button></a>
<a href="<?=base_url?>productos/categoria&id=<?=$product['category_id']?>"><button>Explorar <?=$product['category']?></button></a>

<h3>Comentarios</h3>
<?php if (!isset($comments) || empty($comments)): ?>
    <p>Este producto no tiene comentarios aún.</p>
<?php else: ?>
    <ul>
        <?php foreach($comments as $index => $comment): ?>
            <li>
                <small><?=$comment['user']?></small><br>
                <?=$comment['content']?><br>
                <?php if(isset($_SESSION['identity'])): ?>
                    <a href="">Responder</a>
                    <?php if($comment['user_id'] == $_SESSION['identity']['id']): ?>
                        | <a href="">Editar</a> | <a href="<?=base_url?>productos/borrar_comentario&id=<?=$comment['id']?>">Borrar</a>
                    <?php endif; ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if(isset($_SESSION['identity'])): ?>
    <form action="<?=base_url?>productos/comment" method="post">
        <input type="hidden" name="product_id" value="<?=$_GET['id']?>">
        <input type="text" name="content" placeholder="Escribe tu comentario" required>
        <input type="submit" value="Enviar">
    </form>
<?php else: ?>
    <p>
        <a href="<?=base_url?>usuarios/registro">
            Registrate</a> o 
        <a href="<?=base_url?>usuarios/iniciar_sesion">
            Inicia sesión</a> para comentar o comprar.
    </p>
<?php endif; ?>


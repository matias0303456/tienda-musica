<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesdarus Música</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>

    <div id="container">

        <header>

            <h1>Lesdarus Música</h1>

            <nav>
                <ul>
                    <li>
                        <a href="<?= base_url ?>">Inicio</a>
                    </li>
                    <?php if(!isset($_SESSION['identity'])) : ?>
                        <li>
                            <a href="<?= base_url ?>categorias/lista">Categorías</a>
                        </li>
                        <li>
                            <a href="<?= base_url ?>usuarios/registro">Registrarse</a>
                        </li>
                        <li>
                            <a href="<?= base_url ?>usuarios/iniciar_sesion">Iniciar sesión</a>
                        </li>
                    <?php else : ?>
                        <?php if($_SESSION['identity']['role'] == 'client') : ?>
                            <li>
                                <a href="<?= base_url ?>categorias/lista">Categorías</a>
                            </li>
                        <?php endif; ?>
                        <?php if($_SESSION['identity']['role'] == 'vendor' || $_SESSION['identity']['role'] == 'admin'): ?>
                            <li>
                                <a href="<?= base_url ?>categorias/gestion">Categorías</a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>productos/gestion">Productos</a>
                            </li>
                            <li>
                                <a href="<?= base_url ?>compras/gestion_de_ordenes">Órdenes</a>
                            </li>
                        <?php endif; ?>
                        <?php if($_SESSION['identity']['role'] == 'admin'): ?>
                            <li>
                                <a href="<?= base_url ?>usuarios/gestion">Usuarios</a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?= base_url ?>carrito/mi_carrito">Mi carrito</a>
                        </li>
                        <li>
                            <a href="<?= base_url ?>usuarios/datos_usuario&id=<?= $_SESSION['identity']['id'] ?>">Mis datos</a>
                        </li>
                        <li>
                            <a href="<?= base_url ?>usuarios/cerrar_sesion">Salir</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

        </header>

        <main>

            <?php if(isset($_SESSION['add_carrito']) && $_SESSION['add_carrito'] == 'success'): ?>
                <p>El producto fue agregado al carrito. <a href="<?=base_url?>carrito/mi_carrito">Ver carrito</a></p>
            <?php endif; ?>
            <?php Utils::deleteSession('add_carrito') ?>

            <!-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div> -->
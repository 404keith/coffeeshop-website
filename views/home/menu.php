<?php
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/productModel.php';

$products = get_all_products($pdo);

foreach ($products as $product) {
    // Display product info
}
?>

<link rel="stylesheet" href="<?= FILE_ROOT ?>/public/assets/css/menu.css" />
<div class="conn2">
    <h2 class="section-title">Our Menu</h2>
    <p>“Hungry? Thirsty? We’ve got just the thing to make your day sweeter and brighter!”</p>

    <!-- Desktop/Tablet Menu -->
    <div class="row menu d-none d-md-flex">

        <div class="col-3">
            <a href="<?php echo FILE_ROOT; ?>/drinks" class="item">
                <img class="img" src="<?php echo FILE_ROOT; ?>/public/assets/images/drinks_home.png" alt="Drinks">
                <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/drinks_home_hover.png"
                    alt="Drinks">
                <span>DRINKS</span>
            </a>
        </div>

        <div class="col-3">
            <a href="<?php echo FILE_ROOT; ?>/waffles" class="item">
                <img class="img" src="<?php echo FILE_ROOT; ?>/public/assets/images/waffles_home.png" alt="Waffles">
                <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/waffles_home_hover.png"
                    alt="Waffles">
                <span>WAFFLES</span>
            </a>
        </div>

        <div class="col-3">
            <a href="<?php echo FILE_ROOT; ?>/pastries" class="item">
                <img class="img" src="<?php echo FILE_ROOT; ?>/public/assets/images/pastries_home.png" alt="Pastries">
                <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/pastries_home_hover.png"
                    alt="Pastries">
                <span>PASTRIES</span>
            </a>
        </div>

        <div class="col-3">
            <a href="<?php echo FILE_ROOT; ?>/merienda" class="item">
                <img class="img" src="<?php echo FILE_ROOT; ?>/public/assets/images/merienda_home.png" alt="Merienda">
                <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/merienda_home_hover.png"
                    alt="Merienda">
                <span>MERIENDA</span>
            </a>
        </div>

    </div>



    <!-- Mobile Menu (Carousel) -->
    <div id="menuCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <a href="<?php echo FILE_ROOT; ?>/drinks" class="item">
                    <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/drinks_home_hover.png"
                        alt="Drinks">
                    <span>DRINKS</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/waffles" class="item">
                    <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/waffles_home_hover.png"
                        alt="Waffles">
                    <span>WAFFLES</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/pastries" class="item">
                    <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/pastries_home_hover.png"
                        alt="Pastries">
                    <span>PASTRIES</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/merienda" class="item">
                    <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/merienda_home_hover.png"
                        alt="Merienda">
                    <span>MERIENDA</span>
                </a>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
            <i class="bi bi-caret-left-fill"></i>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
            <i class="bi bi-caret-right-fill"></i>
        </button>
    </div>
</div>
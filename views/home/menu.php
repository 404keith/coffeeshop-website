<?php
require_once APP_ROOT . '/config/dbhandler.php';
require_once APP_ROOT . '/models/productModel.php';

$products = get_all_products($pdo);

foreach ($products as $product) {
    // Display product info
}
?>

<style>
    .conn2 {
        padding: 100px 200px;
        background: #fff6eb;
        background-position: center -15.2rem;
        text-align: center;
        /* MODIFIED: Use min-height for flexibility */
        min-height: 100vh;
        position: relative;
        width: 100%;
        /* MODIFIED: Set height to auto so min-height takes over */
        height: auto;
    }

    .conn2 h2 {
        font-family: 'pacifico';
        font-size: 3rem;
        color: #D68421;
    }

    .menu .item {
        display: block;
        width: 250px;
        margin: 0 auto;
        height: 400px;
        background: #f9ede2ff;
        padding-top: 120px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        text-decoration: none;

        transition: background-color 0.3s ease-out, border-radius 0.3s ease-out;
        overflow: hidden;
        border-radius: 8px;
    }

    .menu .item::before {
        content: none;
    }

    .item:hover {
        /* background-color: #f5e4d2ff; */
        border-radius: 16px;
    }

    .menu .item img {
        position: absolute;
        top: 0;
        margin-top: 7rem;
        left: 50%;
        transform: translateX(-50%);
        width: 70px;
        max-width: 250px;
        height: auto;
        object-fit: contain;
        z-index: 10;
    }

    .item:hover img {
        transform: translateX(-50%);
    }

    .menu .item .img_hover {
        display: none;
    }

    .item:hover .img {
        display: none;
    }

    .item:hover .img_hover {
        display: block;
    }

    .menu .item span {
        display: block;
        color: black;
        font-weight: bold;
        padding: 8rem 10px;
        text-align: center;
        margin-top: auto;
        z-index: 10;
        transition: color 0.2s ease-out;
    }

    .menu {
        gap: 0 !important;
        margin-top: 50px;
    }



    /* Mobile Carousel Fix */
    @media (max-width: 768px) {

        */ .conn2 {
            padding: 50px 20px;
            /* Reduced padding for mobile */
            min-height: auto;
            /* Let content define height */
            height: auto;
        }

        /* Resetting desktop hover effects for mobile */
        .item:hover {
            transform: none;
            box-shadow: none;
            /* background-color: #f9ede2ff; */
            animation: none;
            border-radius: 4px;
        }

        .item:hover img {
            transform: translateX(-50%);
        }

        .item:hover span {
            color: black;
            /* Reset to black */
        }


        #menuCarousel .carousel-inner {
            display: flex;
            align-items: center;
        }

        #menuCarousel .item {
            width: 260px;
            height: 420px;
            margin: auto;
            /* MODIFIED: Match web view background color */
            background: #f9ede2ff;
            border-radius: 4px;
            padding-top: 120px;
            position: relative;
            display: flex;
            text-decoration: none;
            flex-direction: column;
            justify-content: flex-end;
            padding-bottom: 5rem;
        }

        #menuCarousel .item img {
            position: absolute;
            top: 0;
            margin-top: 8rem;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: auto;
            object-fit: contain;
        }

        #menuCarousel .item span {
            display: block;
            text-decoration: none;
            color: black;
            font-weight: bold;
            padding: 12px 10px;
            border-radius: 0 0 20px 20px;
            text-align: center;
        }

        #menuCarousel .item span:hover {
            color: #D68421;
        }

        #menuCarousel .item .img {
            display: block;
            /* Default state: show regular image */
        }

        #menuCarousel .item .img_hover {
            display: none;
            /* Default state: hide hover image */
        }

        #menuCarousel .item:hover .img {
            display: none;
            /* On hover/tap: hide regular image */
        }

        #menuCarousel .item:hover .img_hover {
            display: block;
            /* On hover/tap: show hover image */
        }


        #menuCarousel .carousel-control-prev,
        #menuCarousel .carousel-control-next {
            width: 4%;

        }

        #menuCarousel .carousel-control-prev i,
        #menuCarousel .carousel-control-next i {
            color: #D68421;
            font-size: 3.5rem;
        }

    }
</style>

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
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/drinks_home.png" class="img" alt="Drinks">
                    <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/drinks_home_hover.png"
                        alt="Drinks">
                    <span>DRINKS</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/waffles" class="item">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/waffles_home.png" class="img" alt="Waffles">
                    <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/waffles_home_hover.png"
                        alt="Waffles">
                    <span>WAFFLES</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/pastries" class="item">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/pastries_home.png" class="img"
                        alt="Pastries">
                    <img class="img_hover" src="<?php echo FILE_ROOT; ?>/public/assets/images/pastries_home_hover.png"
                        alt="Pastries">
                    <span>PASTRIES</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/merienda" class="item">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/merienda_home.png" class="img"
                        alt="Merienda">
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
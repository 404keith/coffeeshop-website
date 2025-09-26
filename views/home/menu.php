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
        height: 100vh;
        position: relative;
        width: 100%;
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

        /* Resetting desktop hover effects for mobile */
        .item:hover {
            transform: none;
            box-shadow: none;
            /* background-color: #f9ede2ff; */
            animation: none;
            /* Crucial: remove animation on mobile */
            border-radius: 4px;
        }

        .item:hover img {
            transform: translateX(-50%);
        }

        .item:hover span {
            color: black;
            /* Reset to black */
        }


        /* Mobile Carousel Fix */
        @media (max-width: 768px) {
            #menuCarousel .carousel-inner {
                display: flex;
                align-items: center;
            }

            #menuCarousel .item {
                width: 260px;
                height: 420px;
                margin: auto;
                background: white;
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

        }
</style>

<div class="conn2">
    <h2 class="section-title">Our Menu</h2>
    <p>“Hungry? Thirsty? We’ve got just the thing to make your day sweeter and brighter!”</p>

    <!-- Desktop/Tablet Menu -->
    <!-- <div class="menu d-none d-md-flex">
        <a href="<?php echo FILE_ROOT; ?>/drinks" class="item">
            <img class="img1" src="<?php echo FILE_ROOT; ?>/public/assets/images/drinkss.png" alt="Drinks">
            <span>DRINKS</span>
        </a>
        <a href="<?php echo FILE_ROOT; ?>/waffles" class="item">
            <img class="img2" src="<?php echo FILE_ROOT; ?>/public/assets/images/waffless.png" alt="Waffles">
            <span>WAFFLES</span>
        </a>
        <a href="<?php echo FILE_ROOT; ?>/pastries" class="item">
            <img class="img3" src="<?php echo FILE_ROOT; ?>/public/assets/images/pastriess.png" alt="Pastries">
            <span>PASTRIES</span>
        </a>
        <a href="<?php echo FILE_ROOT; ?>/merienda" class="item">
            <img class="img4" src="<?php echo FILE_ROOT; ?>/public/assets/images/meriendaa.png" alt="Merienda">
            <span>MERIENDA</span>
        </a>
    </div> -->


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
                    <span>DRINKS</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/waffles" class="item">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/waffles_home.png" class="img" alt="Waffles">
                    <span>WAFFLES</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/pastries" class="item">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/pastries_home.png" class=img"
                        alt="Pastries">
                    <span>PASTRIES</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/merienda" class="item">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/merienda_home.png" class="img"
                        alt="Merienda">
                    <span>MERIENDA</span>
                </a>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" style="color:black" type="button" data-bs-target="#menuCarousel"
            data-bs-slide="prev">
            <i class="bi bi-caret-left-fill fs-3 me-5"></i>
        </button>

        <button class="carousel-control-next" style="color:black" type="button" data-bs-target="#menuCarousel"
            data-bs-slide="next">
            <i class="bi bi-caret-right-fill fs-3 ms-5"></i>
        </button>
    </div>
</div>
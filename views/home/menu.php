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
        background: #D68421;
        /* background-image:  url('<?php echo FILE_ROOT; ?>/public/assets/images/background-3.png'); */

        text-align: center;
        height: 100vh;
        position: relative;
        /* changed from absolute for better flow */
        width: 100%;
    }

    .conn2 h2 {
        font-family: 'pacifico';
        font-size: 3rem;
        color: #fff6eb;
    }

    .menu {
        display: flex;
        justify-content: center;
        gap: -10px;
        margin-top: 200px;
        flex-wrap: wrap;
    }

    .item {
        text-decoration: none;
        color: white;
        width: 200px;
        border-radius: 20px;
        background: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.3s ease-out;
        padding-top: 100px;
        position: relative;
        margin: 0 auto;
    }

    .item img {
        position: absolute;
    }

    .img1 {
        width: 280px;
        top: -230px;
        object-fit: cover;
    }

    .img2 {
        width: 310px;
        top: -220px;
        object-fit: cover;
    }

    .img3 {
        width: 220px;
        top: -160px;
        object-fit: cover;
    }

    .img4 {
        width: 300px;
        top: -250px;
        left: -30px;
        object-fit: cover;
    }

    .item span {
        background: #281A11;
        padding: 12px 10px;
        width: 100%;
        text-align: center;
        font-weight: bold;
        border-radius: 0 0 20px 20px;
    }

    .item:hover {
        transform: scale(1.1);
        background: linear-gradient(to top, #150e09ff, #573f30ff 100%);


    }

    /* Mobile Carousel Fix */
    @media (max-width: 768px) {
        #menuCarousel .carousel-inner {
            display: flex;
            align-items: center;
        }

        #menuCarousel .item {
            width: 260px;
            height: 330px;
            margin: auto;
            background: white;
            border-radius: 20px;
            padding-top: 120px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        #menuCarousel .item img {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 220px;
            height: auto;
            object-fit: contain;
        }

        #menuCarousel .item span {
            display: block;
            background: #281A11;
            color: white;
            font-weight: bold;
            padding: 12px 10px;
            border-radius: 0 0 20px 20px;
            text-align: center;
        }

    }
</style>

<div class="conn2">
    <h2 class="section-title">Menu</h2>
    <p>“Hungry? Thirsty? We’ve got just the thing to make your day sweeter and brighter!”</p>

    <!-- Desktop/Tablet Menu -->
    <div class="menu d-none d-md-flex">
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
    </div>

    <!-- Mobile Menu (Carousel) -->
    <div id="menuCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
        <div class="carousel-inner text-center">
            <div class="carousel-item active">
                <a href="<?php echo FILE_ROOT; ?>/drinks" class="item mx-auto">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/drinkss.png" class="d-block w-75 mx-auto"
                        alt="Drinks">
                    <span>DRINKS</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/waffles" class="item mx-auto">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/waffless.png" class="d-block w-75 mx-auto"
                        alt="Waffles">
                    <span>WAFFLES</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/pastries" class="item mx-auto">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/pastriess.png" class="d-block w-75 mx-auto"
                        alt="Pastries">
                    <span>PASTRIES</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/merienda" class="item mx-auto">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/meriendaa.png" class="d-block w-75 mx-auto"
                        alt="Merienda">
                    <span>MERIENDA</span>
                </a>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
            <i class="bi bi-caret-left-fill fs-3 me-5"></i>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
            <i class="bi bi-caret-right-fill fs-3 ms-5"></i>
        </button>
    </div>
</div>
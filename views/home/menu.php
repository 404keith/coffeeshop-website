<style>
.conn2 {
    padding: 120px 40px;
    background: linear-gradient(to bottom, #FFF6EB 90%, #FFF6EB 100%);
    text-align: center;
    height: 100vh;
    position: relative; /* changed from absolute for better flow */
    width: 100%;
}

.conn2 h2 {
    font-family: 'pacifico';
    font-size: 3rem;
    font-weight: bold;
    color: #D4842C;
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

.img1 { width: 280px; top: -230px; object-fit: cover; }
.img2 { width: 310px; top: -220px; object-fit: cover; }
.img3 { width: 220px; top: -160px; object-fit: cover; }
.img4 { width: 300px; top: -250px; left: -30px; object-fit: cover; }

.item span {
    background: #e68a00;
    padding: 12px 10px;
    width: 100%;
    text-align: center;
    font-weight: bold;
    border-radius: 0 0 20px 20px;
    display: inline-block;
}

.item:hover {
    transform: scale(1.1);
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
        background: #e68a00;
        color: white;
        font-weight: bold;
        padding: 12px 10px;
        border-radius: 0 0 20px 20px;
        text-align: center;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-size: 100% 100%;
    }

    .carousel-control-prev-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23D48423' viewBox='0 0 16 16'%3E%3Cpath d='M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z'/%3E%3C/svg%3E");
    }

    .carousel-control-next-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23D48423' viewBox='0 0 16 16'%3E%3Cpath d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
    }
}

.conn2 .section-title {
    font-family: 'inter';
}
</style>

<div class="conn2">
    <h2 class="section-title">Menu</h2>

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
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/drinkss.png" class="d-block w-75 mx-auto" alt="Drinks">
                    <span>DRINKS</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/waffles" class="item mx-auto">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/waffless.png" class="d-block w-75 mx-auto" alt="Waffles">
                    <span>WAFFLES</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/pastries" class="item mx-auto">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/pastriess.png" class="d-block w-75 mx-auto" alt="Pastries">
                    <span>PASTRIES</span>
                </a>
            </div>
            <div class="carousel-item">
                <a href="<?php echo FILE_ROOT; ?>/merienda" class="item mx-auto">
                    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/meriendaa.png" class="d-block w-75 mx-auto" alt="Merienda">
                    <span>MERIENDA</span>
                </a>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

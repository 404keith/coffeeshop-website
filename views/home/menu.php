
    <style>
        .conn2{
            padding: 120px 40px;
              background: 
                linear-gradient(to bottom, #FFF6EB 90%,  #FFF6EB 100% );
            text-align: center;
            height:100vh; 
            position: absolute;
            top: 111vh;
            width: 100%;
        }
        .conn2 h2{
            font-family: 'pacifico';
            font-size: 3rem;
            font-weight: bold;
            color: #D4842C;
        }
        .conn3 h2{
            font-family: 'pacifico';
            font-size: 3rem;
            font-weight: bold;
            color: #fff;
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
        .img1{
            width: 280px;
            position: absolute;
            object-fit: cover;
            top: -230px; 
        }
         .img2{
            width: 310px;
             position: absolute;
            object-fit: cover;
            top: -220px; 
        }
         .img3{
            width: 220px;
             position: absolute;
            object-fit: cover;
            top: -160px; 
        }
         .img4{
            width: 300px;
             position: absolute;
            object-fit: cover;
            top: -250px; 
            left: -30px;
        }
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

        .conn3{
            padding: 120px 40px;
              background: 
                linear-gradient(to bottom, rgba(212, 132, 35, 1),  #FFF6EB 100% );
            text-align: center;
            height:140vh; 
            position: absolute;
            top: 210vh;
            width: 100%;
        }
        .map-container {
      width: 100%;
      height: 400px;
    }
    iframe {
      width: 70%;
      height: 100%;
      border: 5px;
    }
        .conn4{
            padding: 120px 40px;
              background: 
                linear-gradient(to bottom, rgba(255, 246, 235, 1),  #FFF6EB 100% );
            text-align: center;
            height:100vh; 
            position: absolute;
            top: 140vh;
            width: 100%;
            left: 0;
        }

    /* Mobile Carousel Fix */
    @media (max-width: 768px) {
      #menuCarousel .carousel-inner {
        display: flex;
        align-items: center;
      }
      #menuCarousel .item {
        width: 260px;
        height: 330px;        /* same box size */
        margin: auto;
        background: white;
        border-radius: 20px;
        padding-top: 120px;   /* spacing for the image */
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
      }

      /* Reset image styles from desktop */
      #menuCarousel .item img {
        position: absolute;
        top: -10px;           /* same placement for all */
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

    </style>

    <div class="conn2">
  <h2>Menu</h2>

  <!-- Desktop/Tablet Menu (Flex Layout) -->
  <div class="menu d-none d-md-flex">
    <a href="#" class="item">
      
      <img class="img1" src="<?php echo FILE_ROOT; ?>/public/assets/images/drinkss.png" alt="Drinks" >
      <!-- <img class="img1" src="../public/assets/images/drinkss.png" alt="Drinks"> -->
      <span>DRINKS</span>
    </a>

    <a href="#" class="item">
            <img class="img2" src="<?php echo FILE_ROOT; ?>/public/assets/images/waffless.png" alt="Drinks" >
      <!-- <img class="img2" src="../public/assets/images/waffless.png" alt="Waffles"> -->
      <span>WAFFLES</span>
    </a>

    <a href="#" class="item">
            <img class="img3" src="<?php echo FILE_ROOT; ?>/public/assets/images/pastriess.png" alt="Drinks" >
      <!-- <img class="img3" src="../public/assets/images/pastriess.png" alt="Pastries"> -->
      <span>PASTRIES</span>
    </a>

    <a href="#" class="item">
            <img class="img4" src="<?php echo FILE_ROOT; ?>/public/assets/images/meriendaa.png" alt="Drinks" >
      <!-- <img class="img4" src="../public/assets/images/meriendaa.png" alt="Merienda"> -->
      <span>MERIENDA</span>
    </a>
  </div>

  <!-- Mobile Menu (Carousel) -->
  <div id="menuCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
    <div class="carousel-inner text-center">

      <div class="carousel-item active">
        <a href="#" class="item mx-auto">
          <img src="<?php echo FILE_ROOT; ?>/public/assets/images/drinkss.png" class="d-block w-75 mx-auto" alt="Drinks">
          <span>DRINKS</span>
        </a>
      </div>

      <div class="carousel-item">
        <a href="#" class="item mx-auto">
          <img class="waf" src="<?php echo FILE_ROOT; ?>/public/assets/images/waffless.png" class="d-block w-75 mx-auto" alt="Waffles">
          <span>WAFFLES</span>
        </a>
      </div>

      <div class="carousel-item">
        <a href="#" class="item mx-auto">
          <img src="<?php echo FILE_ROOT; ?>/public/assets/images/pastriess.png" class="d-block w-75 mx-auto" alt="Pastries">
          <span>PASTRIES</span>
        </a>
      </div>

      <div class="carousel-item">
        <a href="#" class="item mx-auto">
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


<div class=conn3>
  <div>
    <h2>About Us</h2>
    <div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241.24887418612965!2d120.94748347775354!3d14.656963711249894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b4535370f9f7%3A0x441dd0c9b6a53ee5!2s826%20M.%20Naval%20St%2C%20Navotas%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1757057543016!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

  </div>

</div>

<div class="conn4">

</div>
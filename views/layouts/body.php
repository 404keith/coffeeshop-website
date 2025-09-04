<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coffee by Monday Mornings</title>
  <link rel="stylesheet" href="../public/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/assets/css/bootstrap-icons.css">
  <style>
        body {
            margin: 0;
            background: 
                linear-gradient(to bottom,rgba(182, 104, 9, 0.2) 35%,  #FFF6EB 100% ),
                url('../public/assets/images/bg-plain.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: scroll;
        }
        .hero {
            min-height: 100vh;    
            display: flex;          
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .cont {
            color: #fff;      
            font-family: 'Inter', sans-serif;
            margin-top: 10vh; 
            text-align: center;
            padding: 0 15px;
        }

        .cont h2 {
            font-size: 3rem; 
            font-weight: bold;
            margin: 0; 
        }

        .cont p {
            font-size: 1.2rem;
            margin: 5px 0; 
        }

        .orderBtn {
            display: block;
            margin: 30px auto;    
            background-color: #D4842C;  
            color: white;               
            border: none;               
            padding: 12px 40px;         
            border-radius: 50px;         
            font-size: 1.2rem;      
            font-weight: bold;    
            cursor: pointer;           
            transition: all 0.3s ease;  
        }

        .orderBtn:hover {
            background-color: #B66809;  
            transform: scale(1.05);     
        }

      
        .conn2{
            padding: 120px 40px;
              background: 
                linear-gradient(to bottom, #FFF6EB 90%,  #FFF6EB 100% );
            text-align: center;
            height:100vh; 
            position: absolute;
            top: 110vh;
            width: 100%;
        }
        .conn2 h2{
            font-family: 'pacifico';
            font-size: 3rem;
            font-weight: bold;
            color: #D4842C;
        }
        .menu {
            display: flex;
            justify-content: center;
            gap: 140px;
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
            
        object-fit: contain;
        }
        .img1 { width: 280px; top: -230px; }
        .img2 { width: 270px; top: -100px; }
        .img3 { width: 220px; top: -160px; }
        .img4 { width: 300px; top: -250px;  left: -30px;}
        /* .img1{
            width: 280px;
            position: absolute
            object-fit: cover;
            top: -220px; 
           
        }
         .img2{
            width: 270px;
             position: absolute;
            object-fit: cover;
            top: -100px; 
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
        } */
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




        @media (max-width: 768px) {
            .cont h2 {
                font-size: 2rem; 
            }
            .cont p {
                font-size: 1rem;
            }
            .orderBtn {
                font-size: 1rem;
                padding: 10px 30px;
            }
        }

        @media (max-width: 480px) {
            .cont {
                margin-top: 15vh;
            }
            .cont h2 {
                font-size: 1.6rem; 
            }
            .cont p {
                font-size: 0.9rem;
            }
            .orderBtn {
                font-size: 0.9rem;
                padding: 8px 25px;
            }
        }

        #menuCarousel .carousel-item {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 50px 0;
}

#menuCarousel .item {
  width: 220px; /* slightly smaller for mobile */
  margin: auto;
}

#menuCarousel .item img {
  max-width: 100%;
}

  </style>
</head>

<body>
   <?php include('../views/layouts/header.php'); ?>
    <div class="hero">
        <div class="cont">
            <h2>COFFEE THAT WARMS</h2>
            <h2>YOUR HEART</h2>
            <p>Discover our handcrafted brews and delightful breakfast treats</p>
            <p>that brighten your day.</p>
        </div>    
        <button class="orderBtn">Order Now</button>
    </div>

    <div class="conn2">
<h2>Menu</h2>

<!-- Desktop/Tablet Menu (Flex Layout) -->
<div class="menu d-none d-md-flex">
  <a href="drinks.html" class="item">
    <img class="img1" src="../public/assets/images/drinkss.png" alt="Drinks">
    <span>DRINKS</span>
  </a>

  <a href="waffles.html" class="item">
    <img class="img2" src="../public/assets/images/waffless.png" alt="Waffles">
    <span>WAFFLES</span>
  </a>

  <a href="pastries.html" class="item">
    <img class="img3" src="../public/assets/images/pastriess.png" alt="Pastries">  
    <span>PASTRIES</span>
  </a>

  <a href="merienda.html" class="item">
    <img class="img4" src="../public/assets/images/meriendaa.png" alt="Merienda">
    <span>MERIENDA</span>
  </a>
</div>

<!-- Mobile Menu (Carousel) -->
<div id="menuCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
  <div class="carousel-inner text-center">

    <div class="carousel-item active">
      <a href="drinks.html" class="item mx-auto">
        <img src="../public/assets/images/drinkss.png" class="d-block w-75 mx-auto" alt="Drinks">
        <span>DRINKS</span>
      </a>
    </div>

    <div class="carousel-item">
      <a href="waffles.html" class="item mx-auto">
        <img src="../public/assets/images/waffless.png" class="d-block w-75 mx-auto" alt="Waffles">
        <span>WAFFLES</span>
      </a>
    </div>

    <div class="carousel-item">
      <a href="pastries.html" class="item mx-auto">
        <img src="../public/assets/images/pastriess.png" class="d-block w-75 mx-auto" alt="Pastries">
        <span>PASTRIES</span>
      </a>
    </div>

    <div class="carousel-item">
      <a href="merienda.html" class="item mx-auto">
        <img src="../public/assets/images/meriendaa.png" class="d-block w-75 mx-auto" alt="Merienda">
        <span>MERIENDA</span>
      </a>
    </div>

  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#menuCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#menuCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>


  
   <script src="../public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

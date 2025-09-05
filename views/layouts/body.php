<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coffee by Monday Mornings</title>
 <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/mdb.min.css" />  
  <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/assets/css/bootstrap-icons.css">
  <style>
        body {
            margin: 0;
            background: 
                linear-gradient(to bottom,rgba(182, 104, 9, 0.2) 35%,  #FFF6EB 100% ),
                url('<?php echo URL_ROOT; ?>/public/assets/images/bg-plain.png');
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


  </style>
  
</head>

<body>
   <?php include APP_ROOT . '/views/layouts/header.php'; ?>
    <div class="hero">
        <div class="cont">
            <h2>COFFEE THAT WARMS</h2>
            <h2>YOUR HEART</h2>
            <p>Discover our handcrafted brews and delightful breakfast treats</p>
            <p>that brighten your day.</p>
        </div>    
        <button class="orderBtn">Order Now</button>
    </div>

   <script src="<?php echo URL_ROOT; ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>

   <?php include APP_ROOT . '/views/layouts/menu.php'; ?>
   <?php include APP_ROOT . '/views/layouts/footer.php'; ?>


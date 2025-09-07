<?php
   include 'config/config.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>3D Coverflow Carousel</title>
<style>
body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: #FFF6EB;
  margin: 0;
  font-family: sans-serif;
}

.carousel3D {
  position: relative;
  width: 600px;
  height: 300px;
  overflow: visible;
}

.carousel3D .slide {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 250px;
  height: auto;
  border-radius: 15px;
  box-shadow: 0 10px 20px rgba(0,0,0,0.3);
  transition: transform 0.3s ease, opacity 0.1s ease, z-index 0.3s ease;
}

.carousel3D img {
  width: 100%;
  height: 100%;
  border-radius: inherit;
  object-fit: cover;
}

.controls {
  position: absolute;
  top: 100%;
  width: 100%;
  display: flex;
  justify-content: space-between;
  transform: translateY(-50%);
}

.controls button {
  background: #D4842C;
  border: none;
  padding: 10px 20px;
  border-radius: 50px;
  color: #fff;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.1s ease;
}

.controls button:hover {
  background: #B66809;
}
</style>
</head>
<body>

<div class="carousel3D">
  <div class="slide"><img src="<?php echo FILE_ROOT; ?>/public/assets/images/meriendaa.png" alt="Slide 1"></div>
  <div class="slide"><img src="<?php echo FILE_ROOT; ?>/public/assets/images/DRINKSs.png" alt="Slide 2"></div>
  <div class="slide"><img src="<?php echo FILE_ROOT; ?>/public/assets/images/pastriess.png" alt="Slide 3"></div>
  <div class="slide"><img src="<?php echo FILE_ROOT; ?>/public/assets/images/WAFFLESs.png" alt="Slide 4"></div>

  <div class="controls">
    <button id="prev">&#10094;</button>
    <button id="next">&#10095;</button>
  </div>
</div>

<script>
const slides = document.querySelectorAll('.carousel3D .slide');
let index = 0;

function updateCarousel() {
  const len = slides.length;
  slides.forEach((slide, i) => {
    const offset = i - index;

    if(offset === 0) { // center
      slide.style.transform = 'translateX(-50%) translateY(-50%) scale(1) rotateY(0deg)';
      slide.style.zIndex = '3';
      slide.style.opacity = '1';
    } 
    else if(offset === 1 || offset === -len + 1) { // right
      slide.style.transform = 'translateX(150%) translateY(-50%) scale(0.5) rotateY(-10deg)';
      slide.style.zIndex = '2';
      slide.style.opacity = '0.7';
    } 
    else if(offset === -1 || offset === len - 1) { // left
      slide.style.transform = 'translateX(-250%) translateY(-50%) scale(0.5) rotateY(10deg)';
      slide.style.zIndex = '2';
      slide.style.opacity = '0.7';
    } 
    else { // hide other slides
      slide.style.transform = 'translateX(-50%) translateY(-50%) scale(0.7)';
      slide.style.zIndex = '1';
      slide.style.opacity = '0';
    }
  });
}

document.getElementById('next').addEventListener('click', () => {
  index = (index + 1) % slides.length;
  updateCarousel();
});

document.getElementById('prev').addEventListener('click', () => {
  index = (index - 1 + slides.length) % slides.length;
  updateCarousel();
});

window.addEventListener('load', updateCarousel);
</script>

</body>
</html>

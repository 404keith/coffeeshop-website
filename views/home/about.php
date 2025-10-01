<style>
    .conn3 {
        /* padding: 120px 40px; */
        background: linear-gradient(to bottom, rgba(212, 132, 35, 1), #FFF6EB 100%);
        background-image: linear-gradient(to bottom, rgba(255, 254, 252, 0) 50%, #FFF6EB 100%),
                           url('<?php echo FILE_ROOT; ?>/public/assets/images/background-3.png');
        text-align: center;
        height: 140vh;
        width: 100%;
        position: relative;
    }

    .map-container {
        width: 50%;
        height: 300px;
        position: absolute;
        bottom: 70px;
        left: 50px;
    }

    iframe {
        width: 70%;
        height: 100%;
        border: 0;
        border-radius: 20px;
    }

    .section-title2 {
        font-family: 'pacifico';
        color: #fff6eb;
        font-size: 3rem;
        position: relative;
        top: 50px;
        padding-bottom: 50px;
    }

    .title2 {
        color: #fff6eb;
        font-family: 'pacifico';

    }

    
    .tite {
        margin-bottom: 100px;
        color: #fff6eb;
        font-family: 'pacifico';
        font-size: 5rem;
        position: absolute;
        right: 170px;
    }

    .pp{
    color: #fff6eb;
    position: absolute;
    left: 120px;
    font-size: 1.3rem;  
    line-height: 1.8;   
    max-width: 800px; 
    bottom: 420px; 
    }

    .pp2{
    position: absolute;
    right: 70px;
    font-size: 1.3rem;  
    line-height: 1.8;   
    max-width: 700px;  
    bottom: 120px;
    } 

    .image-left img{
        position: absolute;
        width: 550px;
        height: 350px;
        left: 120px;
        border-radius: 25px;
        top: 50px;
    }

    .image-bottom img{
    position: absolute;
    width: 400px;
    height: 300px;
    left: 350px;
    border-radius: 25px;
    bottom: 50px;
    }

    .image-right img{
    position: absolute;
    width: 400px;
    height: 450px;   
    right: 150px;
    border-radius: 25px;
    top: 250px;
    }

    .image-grid {
  display: grid;
  grid-template-areas: 
    "left right"
    "bottom right";
  grid-template-columns: 1fr 1fr;
  gap: 20px;

}
    @media (max-width: 768px) {
  .image-grid {
    grid-template-areas: 
      "left"
      "right"
      "bottom";
    grid-template-columns: 1fr;
  }
}

</style>

<div class="conn3">
    <h2 class="section-title2">About</h2>
    <h1 class="tite">Monday Morning's</h1>
    <br>

  
    <p class="pp">“We’re not just about serving delicious food we’re about creating experiences. <br>Our café is built on the idea
        of togetherness, where every drink warms your heart <br>and every bite sparks joy. Step inside, take a seat, and
        let us be part of your everyday story.”</p>

        <p class="pp2">"At Monday Morning’s, we believe every day deserves a warm start. From the aroma of freshly brewed coffee to the comfort of homemade meals, our café is a space where people gather, connect, and create lasting memories."</p>
    

    <div class="image-grid">
      <div class="image-left">
        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/abt1.jpg" alt="topimg">
      </div>

      <!-- <div class="image-bottom">
        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/abt2.jpg" alt="botimg">
      </div> -->

    <div class="image-right">
        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/abt4.jpg" alt="rimg">
      </div>
    </div>

<div class="map-container">
        <h1 class="title2">Store Location</h1> 
         <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241.24887418612965!2d120.94748347775354!3d14.656963711249894!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b4535370f9f7%3A0x441dd0c9b6a53ee5!2s826%20M.%20Naval%20St%2C%20Navotas%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1757057543016!5m2!1sen!2sph" 
            width="600" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
<?php require_once APP_ROOT . '/config/session.php'; ?>

<?php include APP_ROOT . '/views/layouts/header.php'; ?>

<html>


<section id="section-ig">
   <?php include APP_ROOT . '/views/home/ig-scroll.php'; ?>
</section>

<?php require APP_ROOT . '/views/layouts/body.php'; ?>




<section id="section-menu">
   <?php include APP_ROOT . '/views/home/menu.php'; ?>
</section>





<section id="section-about">
   <?php include APP_ROOT . '/views/home/about.php'; ?>
</section>

</html>
<?php include APP_ROOT . '/views/layouts/footer.php'; ?>
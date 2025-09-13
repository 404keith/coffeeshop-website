<?php include APP_ROOT . '/views/layouts/header.php'; ?>

<style>
    .btn-go-home {
        background-color: rgba(212, 132, 35, 1);
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 10px;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-go-home:hover {
        background-color: rgba(173, 97, 4, 1);
        color: rgba(239, 167, 78, 1);
    }

    .center-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        height: 70vh;
    }
</style>

<div class="center-container">
    <img src="<?php echo FILE_ROOT; ?>/public/assets/images/sad-face.png" alt="Sad face" class="img-fluid mb-4"
        style="max-width: 200px;">
    <h3 class="mb-3">401 Unauthorized</h3>
    <p class="mb-3"> Your existing session token doesn't authorize you any more, so you are unauthorized.</p>
    <a href="/" class="btn btn-go-home">Go back home</a>
</div>
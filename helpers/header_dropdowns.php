<?php
function renderAccountMenu($fileRoot) {
    if (isset($_SESSION['user_id'])) {
        echo '<li class="dropdown-item-text text-center mb-2">Hello, ' . htmlspecialchars($_SESSION['user_firstname']) . '</li>';
    
        if (isset($_SESSION['user_role']) && $_SESSION['user_role']==='admin'){
                echo '<li><a class="btn btn-account " href="' . $fileRoot . '/admin">Dashboard</a></li>';

        } 
                echo '<li><a class="btn btn-account " href="' . $fileRoot . '/logout">Logout</a></li>';




    } else {
        echo '<li><a class="btn btn-account  mb-2" href="' . $fileRoot . '/login">Login</a></li>';
        echo '<li><a class="btn  btn-account" href="' . $fileRoot . '/signup">Signup</a></li>';
    }
}


function renderCartMenu($fileRoot) {
        echo '<li><span class="dropdown-item-text">Your cart: </span></li>';
}
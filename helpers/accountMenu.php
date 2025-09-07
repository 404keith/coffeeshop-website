<?php
function renderAccountMenu($fileRoot) {
    if (isset($_SESSION['user_id'])) {
        echo '<li><span class="dropdown-item-text">Hello, ' . htmlspecialchars($_SESSION['user_username']) . '</span></li>';
        echo '<li><a class="dropdown-item" href="' . $fileRoot . '/logout">Logout</a></li>';
    } else {
        echo '<li><a class="dropdown-item" href="' . $fileRoot . '/login">Login</a></li>';
        echo '<li><a class="dropdown-item" href="' . $fileRoot . '/signup">Signup</a></li>';
    }
}
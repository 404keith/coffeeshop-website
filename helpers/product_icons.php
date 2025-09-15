<?php
function displayProductIcons()
{
    $products = [
        ['uri' => '/drinks', 'def_icon' => 'fi fi-rr-cup-straw-swoosh', 'default_class' => 'fs-5 pt-5', 'name' => 'Drinks', 'b_icon' => 'fi fi-ss-cup-straw-swoosh', 'name_class' => ''],

        ['uri' => '/waffles', 'def_icon' => 'fi fi-rr-pancakes', 'default_class' => 'fs-5 ms-4 pt-5', 'name' => 'Waffles', 'b_icon' => 'fi fi-ss-pancakes', 'name_class' => 'ms-4'],

        ['uri' => '/pastries', 'def_icon' => 'fi fi-rr-croissant', 'default_class' => 'fs-5 ms-4 pt-5', 'name' => 'Pastries', 'b_icon' => 'fi fi-ss-croissant', 'name_class' => 'ms-4'],

        ['uri' => '/merienda', 'def_icon' => 'fi fi-rr-sandwich', 'default_class' => 'fs-5 ms-4 pt-5', 'name' => 'Merienda', 'b_icon' => 'fi fi-ss-sandwich', 'name_class' => 'ms-4 '],
    ];

    $current_uri = $_SERVER['REQUEST_URI'];

    foreach ($products as $product) {
        $href_uri = $product['uri'];
        $icon_class = $product['def_icon'];
        $def_class = $product['default_class'];
        $n_class = $product['name_class'];

        if ($current_uri === $href_uri) {
            $anchor_class = "product-toggle text-decoration-none";
            $icon_class = $product['b_icon'];
            $icon_size_class = "fs-2"; // Larger size
            $product_name = $product['name'];

        } else {
            $anchor_class = "product-toggle text-decoration-none";
            $icon_size_class = "fs-5"; // Default size
            $product_name = '';

        }

        echo '
        <a href="' . $href_uri . '" class="' . $anchor_class . '">
            <i class="' . $icon_class . ' ' . $icon_size_class . ' ' . $def_class . '">  </i>
            <p class="' . $n_class . '">' . $product_name . '</p>
        </a>';
    }

}

<?php
function displayProductIcons()
{
    $products = [
        ['uri' => '/drinks', 'def_icon' => 'fi fi-rr-cup-straw-swoosh', 'default_class' => 'pt-5', 'name' => 'Drinks', 'b_icon' => 'fi fi-ss-cup-straw-swoosh', 'name_class' => ''],
        ['uri' => '/waffles', 'def_icon' => 'fi fi-rr-pancakes', 'default_class' => 'ms-4 pt-5', 'name' => 'Waffles', 'b_icon' => 'fi fi-ss-pancakes', 'name_class' => 'ms-4'],
        ['uri' => '/pastries', 'def_icon' => 'fi fi-rr-croissant', 'default_class' => 'ms-4 pt-5', 'name' => 'Pastries', 'b_icon' => 'fi fi-ss-croissant', 'name_class' => 'ms-4'],
        ['uri' => '/merienda', 'def_icon' => 'fi fi-rr-sandwich', 'default_class' => 'ms-4 pt-5', 'name' => 'Merienda', 'b_icon' => 'fi fi-ss-sandwich', 'name_class' => 'ms-4 '],
    ];

    $current_uri = $_SERVER['REQUEST_URI'];

    foreach ($products as $product) {
        $href_uri = $product['uri'];
        $icon_class = $product['def_icon'];
        $def_class = $product['default_class'];
        $n_class = $product['name_class'];
        $data_category = strtolower($product['name']);

        if ($current_uri === $href_uri) {
            $anchor_class = "product-toggle text-decoration-none category-link active";
            $icon_class = $product['b_icon'];
            $icon_size_class = "fs-2";
        } else {
            $anchor_class = "product-toggle text-decoration-none category-link";
            $icon_size_class = "fs-5";
        }

        echo '
        <a href="#" class="' . $anchor_class . '" data-category="' . $data_category . '" data-uri="' . $href_uri . '">
            <i class="' . $icon_class . ' ' . $icon_size_class . ' ' . $def_class . '" 
               data-default-icon="' . $product['def_icon'] . '" 
               data-active-icon="' . $product['b_icon'] . '">
            </i>
            <p class="' . $n_class . '"></p>
        </a>';
    }
}
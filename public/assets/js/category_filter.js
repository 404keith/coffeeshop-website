
document.addEventListener('DOMContentLoaded', function () {
    const productList = document.getElementById('product-list');
    const categoryLinks = document.querySelectorAll('.category-link');

    categoryLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const category = this.dataset.category;
            const url = this.getAttribute('href');

            // Update the URL in the browser's address bar
            history.pushState({ category: category }, '', url);

            // Send an AJAX request to the server
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `/get_products.php?category=${category}`, true);

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Update the product list with the new products
                    productList.innerHTML = xhr.responseText;
                } else {
                    console.error('Request failed with status:', xhr.status);
                }
            };

            xhr.onerror = function () {
                console.error('Request failed');
            };

            xhr.send();
        });
    });
});

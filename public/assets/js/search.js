
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const productList = document.getElementById('product-list');
    const initialProductListHTML = productList.innerHTML;

    searchInput.addEventListener('keyup', function () {
        const searchQuery = searchInput.value.trim();
        const category = searchInput.dataset.category;

        if (searchQuery === '') {
            productList.innerHTML = initialProductListHTML;
            return;
        }

        // Send an AJAX request to the server
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `/live_search.php?search=${searchQuery}&category=${category}`, true);

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Update the product list with the search results
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

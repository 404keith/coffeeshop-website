
function loadCategory(categoryUrl, event) {
    event.preventDefault();

    // Update the URL in the browser
    history.pushState(null, null, categoryUrl);

    // Fetch the content of the new category
    fetch(categoryUrl, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        // Create a temporary div to hold the new content
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;

        // Find the product list in the new content
        const newProductList = tempDiv.querySelector('#product-list');
        const newTitle = tempDiv.querySelector('h1.welcome-text');
        const newIcons = tempDiv.querySelector('#product-icons');

        // Update the product list, title and icons on the current page
        document.getElementById('product-list').innerHTML = newProductList.innerHTML;
        document.querySelector('h1.welcome-text').innerHTML = newTitle.innerHTML;
        document.getElementById('product-icons').innerHTML = newIcons.innerHTML;
    })
    .catch(error => console.error('Error loading category:', error));
}

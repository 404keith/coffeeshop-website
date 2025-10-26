document.addEventListener('DOMContentLoaded', () => {
    const productIcons = document.querySelectorAll('.product-toggle');
    const productList = document.getElementById('product-list');
    const welcomeText = document.querySelector('.welcome-text');

    productIcons.forEach(icon => {
        icon.addEventListener('click', e => {
            e.preventDefault();
            const url = new URL(icon.href);
            const category = url.pathname.split('/').pop();

            // Fetch new products
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newProductList = doc.getElementById('product-list');
                    const newWelcomeText = doc.querySelector('.welcome-text');

                    // Update the content
                    productList.innerHTML = newProductList.innerHTML;
                    welcomeText.innerHTML = newWelcomeText.innerHTML;

                    // Update the URL
                    history.pushState({ category: category }, '', url);

                    // Update active icon
                    productIcons.forEach(i => i.classList.remove('active'));
                    icon.classList.add('active');
                })
                .catch(error => console.error('Error fetching products:', error));
        });
    });

    // Handle back/forward button navigation
    window.addEventListener('popstate', e => {
        if (e.state && e.state.category) {
            const category = e.state.category;
            const url = `${window.location.origin}/menu/${category}`;

            // Fetch products for the new state
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newProductList = doc.getElementById('product-list');
                    const newWelcomeText = doc.querySelector('.welcome-text');

                    // Update the content
                    productList.innerHTML = newProductList.innerHTML;
                    welcomeText.innerHTML = newWelcomeText.innerHTML;

                    // Update active icon
                    productIcons.forEach(i => {
                        const iconCategory = new URL(i.href).pathname.split('/').pop();
                        if (iconCategory === category) {
                            i.classList.add('active');
                        } else {
                            i.classList.remove('active');
                        }
                    });
                })
                .catch(error => console.error('Error fetching products:', error));
        }
    });
});
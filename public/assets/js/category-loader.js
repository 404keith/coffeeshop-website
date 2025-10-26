document.addEventListener("DOMContentLoaded", function () {
  const categoryLinks = document.querySelectorAll(".category-link");

  const handleCategoryClick = (event) => {
    event.preventDefault();

    const clickedLink = event.currentTarget;
    const url = clickedLink.getAttribute("href");
    const category = clickedLink.dataset.category;

    // --- NEW ICON STYLING LOGIC ---
    // 1. Reset all icons to their default state
    categoryLinks.forEach((link) => {
      const icon = link.querySelector("i");
      link.classList.remove("active");
      icon.classList.remove("fs-2");
      icon.classList.add("fs-5");

      // Swap icon classes using the data attributes
      const activeIconClasses = icon.dataset.activeIcon.split(" ");
      const defaultIconClasses = icon.dataset.defaultIcon.split(" ");
      icon.classList.remove(...activeIconClasses);
      icon.classList.add(...defaultIconClasses);
    });

    // 2. Set the clicked icon to its active state
    const clickedIcon = clickedLink.querySelector("i");
    clickedLink.classList.add("active");
    clickedIcon.classList.remove("fs-5");
    clickedIcon.classList.add("fs-2");

    // Swap icon classes using the data attributes
    const activeIconClasses = clickedIcon.dataset.activeIcon.split(" ");
    const defaultIconClasses = clickedIcon.dataset.defaultIcon.split(" ");
    clickedIcon.classList.remove(...defaultIconClasses);
    clickedIcon.classList.add(...activeIconClasses);
    // --- END OF NEW LOGIC ---

    // Fetch new products from the server (this part is the same as before)
    fetch(url + "?ajax=1")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.text();
      })
      .then((html) => {
        document.getElementById("product-list").innerHTML = html;
        const newTitle = category.charAt(0).toUpperCase() + category.slice(1);
        document.querySelector(".welcome-text").textContent = newTitle;
        document.title = newTitle;
        history.pushState({ path: url }, "", url);
      })
      .catch((error) => console.error("Error loading products:", error));
  };

  categoryLinks.forEach((link) => {
    link.addEventListener("click", handleCategoryClick);
  });
});

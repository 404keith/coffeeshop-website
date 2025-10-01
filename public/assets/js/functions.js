function scrollToSection(id) {
  document.getElementById(id).scrollIntoView({
    behavior: "smooth", // smooth scroll
  });
}

window.addEventListener("load", function () {
  if (performance.getEntriesByType("navigation")[0].type === "reload") {
    window.location.href = "";
  }
});

//for mobile side menu: fixed
document.addEventListener("DOMContentLoaded", function () {
  var myOffcanvas = document.getElementById("mobileMenu");
  var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);

  document
    .getElementById("openMobileMenu")
    .addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();
      bsOffcanvas.toggle();
    });
});

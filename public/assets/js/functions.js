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

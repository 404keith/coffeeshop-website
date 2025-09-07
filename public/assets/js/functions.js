function scrollToSection(id) {
  document.getElementById(id).scrollIntoView({ 
    behavior: 'smooth'   // smooth scroll
  });
}

 window.addEventListener("load", function () {
    // Newer API
    if (performance.getEntriesByType("navigation")[0].type === "reload") {
      window.location.href = "";
    }

    // Fallback for older browsers
    if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
      window.location.href = "";
    }
  });
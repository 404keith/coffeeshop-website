function togglePasswordVisibility() {
  const passwordInput = document.getElementById("passwordInput");
  const toggleIcon = document.getElementById("togglePasswordIcon");

  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);

  // Toggle the eye icon class
  if (type === "password") {
    toggleIcon.classList.remove("fa-eye-slash");
    toggleIcon.classList.add("fa-eye");
  } else {
    toggleIcon.classList.remove("fa-eye");
    toggleIcon.classList.add("fa-eye-slash");
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("userForm");
  const usernameInput = document.getElementById("userName");
  const passwordInput = document.getElementById("userPassword");
  const usernameError = document.getElementById("usernameError");
  const passwordError = document.getElementById("passwordError");
  const togglePassword = document.getElementById("togglePassword");

  // Toggle password visibility
  togglePassword.addEventListener("click", function () {
    const type =
      passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    this.classList.toggle("fa-eye-slash");
  });

  // Validate username
  usernameInput.addEventListener("input", validateUsername);
  usernameInput.addEventListener("blur", validateUsername);

  // Validate password
  passwordInput.addEventListener("input", validatePassword);
  passwordInput.addEventListener("blur", validatePassword);

  // Prevent form submission if validation fails
  form.addEventListener("submit", function (event) {
    const isUsernameValid = validateUsername();
    const isPasswordValid = validatePassword();

    if (!isUsernameValid || !isPasswordValid) {
      event.preventDefault();
    }
  });

  // Validate username function
  function validateUsername() {
    const usernameValue = usernameInput.value.trim();
    if (!/^[a-zA-Z]+$/.test(usernameValue)) {
      usernameError.textContent = "Username must contain only letters";
      usernameError.style.display = "block";
    } else if (usernameValue === "") {
      usernameError.textContent = "Username is required";
      usernameError.style.display = "block";
      return false;
    } else if (usernameValue.length < 3) {
      usernameError.textContent = "Username must be at least 3 characters";
      usernameError.style.display = "block";
      return false;
    } else {
      usernameError.textContent = "";
      usernameError.style.display = "none";
      return true;
    }
  }

  // Validate password function
  function validatePassword() {
    const passwordValue = passwordInput.value.trim();
    if (passwordValue === "") {
      passwordError.textContent = "Password is required";
      passwordError.style.display = "block";
      return false;
    } else if (passwordValue.length < 6) {
      passwordError.textContent = "Password must be at least 6 characters";
      passwordError.style.display = "block";
      return false;
    } else {
      passwordError.textContent = "";
      passwordError.style.display = "none";
      return true;
    }
  }
});

document.addEventListener("DOMContentLoaded", function () {
  if (document.querySelector(".form-box")) {
    const loginBtn = document.querySelector(".login-btn");
    const formBox = document.querySelector(".form-box");
    const overlay = document.querySelector(".overlay");

    if (loginBtn && formBox && overlay) {
      const toggleForm = () => {
        formBox.classList.toggle("active");
        overlay.classList.toggle("active");
        document.querySelector("body").classList.toggle("overflow-hidden");
      };

      loginBtn.addEventListener("click", toggleForm);
    }

    // Toggle password
    const togglePassword = document.getElementById("togglePassword");
    const passwordField = document.getElementById("userPassword");

    if (togglePassword && passwordField) {
      togglePassword.addEventListener("click", function () {
        // Toggle the type attribute between "password" and "text"
        const type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;

        // Toggle the eye icon class
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
      });
    }

    // Toggle form
    let signUpBtn = document.getElementById("signUpBtn");
    let signInBtn = document.getElementById("signInBtn");
    let nameField = document.getElementById("nameField");
    let contactField = document.getElementById("contactField");
    let addressField = document.getElementById("addressField");
    let title = document.getElementById("title");
    let submitName = document.getElementById("form-submit");

    if (signInBtn && signUpBtn) {
      signInBtn.addEventListener("click", function () {
        // Slide up extra fields for Sign In
        nameField.style.maxHeight = "0";
        contactField.style.maxHeight = "0";
        addressField.style.maxHeight = "0";

        // Change title and visibility
        title.innerHTML = "Log In";
        signUpBtn.classList.add("disable");
        signInBtn.classList.remove("disable");

        // Change the name attribute of the submit button
        submitName.setAttribute("name", "sign_in");
      });

      signUpBtn.addEventListener("click", function () {
        // Slide down extra fields for Sign Up
        nameField.style.maxHeight = "60px"; // Adjust based on field height
        contactField.style.maxHeight = "60px"; // Adjust based on field height
        addressField.style.maxHeight = "60px"; // Adjust based on field height

        // Change title and visibility
        title.innerHTML = "Sign Up";
        signInBtn.classList.add("disable");
        signUpBtn.classList.remove("disable");

        // Change the name attribute of the submit button
        submitName.setAttribute("name", "sign_up");
      });
    }

    const form = document.getElementById("userForm");

    if (!form) {
      console.error("Form with id 'userForm' not found.");
      return;
    }

    // Validation functions
    function validateUsername() {
      const nameInput = form.querySelector('input[name="userName"]');
      const nameError = document.getElementById("nameError");
      if (nameInput.value.trim().length < 3) {
        nameError.textContent = "Name must be at least 3 characters long.";
        return false;
      } else {
        nameError.textContent = "";
        return true;
      }
    }

    function validateEmail() {
      const emailInput = form.querySelector('input[name="userEmail"]');
      const emailError = document.getElementById("emailError");
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(emailInput.value.trim())) {
        emailError.textContent = "Enter a valid email address.";
        return false;
      } else {
        emailError.textContent = "";
        return true;
      }
    }

    function validatePassword() {
      const passwordInput = form.querySelector('input[name="userPassword"]');
      const passwordError = document.getElementById("passwordError");
      if (passwordInput.value.trim().length < 6) {
        passwordError.textContent =
          "Password must be at least 6 characters long.";
        return false;
      } else {
        passwordError.textContent = "";
        return true;
      }
    }

    function validatePhoneNumber() {
      const contactInput = form.querySelector('input[name="userContact"]');
      const contactError = document.getElementById("contactError");
      const contactRegex = /^9[678]\d{8}$/; // Adjust regex based on your requirements
      if (!contactRegex.test(contactInput.value.trim())) {
        contactError.textContent =
          "Phone number must start with 9, followed by 6, 7, or 8, and be 10 digits long.";
        return false;
      } else {
        contactError.textContent = "";
        return true;
      }
    }

    function validateAddress() {
      const addressInput = form.querySelector('input[name="userAddress"]');
      const addressError = document.getElementById("addressError");
      const wordCount = addressInput.value.trim().split(/\s+/).length;
      if (wordCount <= 2) {
        addressError.textContent = "Address must contain more than 2 words.";
        return false;
      } else {
        addressError.textContent = "";
        return true;
      }
    }

    // Validate form on input change
    form
      .querySelector('input[name="userName"]')
      .addEventListener("input", validateUsername);
    form
      .querySelector('input[name="userEmail"]')
      .addEventListener("input", validateEmail);
    form
      .querySelector('input[name="userPassword"]')
      .addEventListener("input", validatePassword);
    form
      .querySelector('input[name="userContact"]')
      .addEventListener("input", validatePhoneNumber);
    form
      .querySelector('input[name="userAddress"]')
      .addEventListener("input", validateAddress);

    // Validate sign-up
    function validateSignUp() {
      return (
        validateUsername() &&
        validateEmail() &&
        validatePassword() &&
        validatePhoneNumber() &&
        validateAddress()
      );
    }

    // Validate sign-in
    function validateSignIn() {
      return validateEmail() && validatePassword();
    }

    // Add event listener for form submission
    form.addEventListener("submit", function (event) {
      // Determine if the form is in sign-up or sign-in mode
      const isSignUpMode = submitName.getAttribute("name") === "sign_up";

      // Validate based on the mode
      let isValid;
      if (isSignUpMode) {
        isValid = validateSignUp();
      } else {
        isValid = validateSignIn();
      }

      // If the form is not valid, prevent submission
      if (!isValid) {
        event.preventDefault();
      }
    });
  }
});

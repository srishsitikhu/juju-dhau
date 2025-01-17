<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="logcs.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
</head>

<body>
    <div class="form-box">
        <h2 id="title">Log In</h2>
        <form id="userForm" action="logentry.php" method="post">
            <div class="input-group">
                <div class="input-field">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="userName" id="userName" placeholder="Username" />
                    <div class="error-message" id="usernameError"></div>
                </div>
                <div class="input-field">
                    <input type="password" id="userPassword" name="userPassword" placeholder="Password" />
                    <i class="fa fa-eye" id="togglePassword" aria-hidden="true"></i>
                    <div class="error-message" id="passwordError"></div>
                </div>
                <button type="submit" id="form-submit" name="sign_in">Log in</button>
            </div>
        </form>
    </div>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('userForm');
            const usernameInput = document.getElementById('userName');
            const passwordInput = document.getElementById('userPassword');
            const usernameError = document.getElementById('usernameError');
            const passwordError = document.getElementById('passwordError');
            const togglePassword = document.getElementById('togglePassword');

            
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });

            
            usernameInput.addEventListener('input', validateUsername);
            usernameInput.addEventListener('blur', validateUsername);

            
            passwordInput.addEventListener('input', validatePassword);
            passwordInput.addEventListener('blur', validatePassword);

            
            form.addEventListener('submit', function (event) {
                const isUsernameValid = validateUsername();
                const isPasswordValid = validatePassword();

                if (!isUsernameValid || !isPasswordValid) {
                    event.preventDefault(); 
                }
            });

            
            function validateUsername() {
                const usernameValue = usernameInput.value.trim();
                if (usernameValue === '') {
                    usernameError.textContent = 'Username is required';
                    return false;
                } else if (usernameValue.length < 3) {
                    usernameError.textContent = 'Username must be at least 3 characters';
                    return false;
                } else {
                    usernameError.textContent = '';
                    return true;
                }
            }

            
            function validatePassword() {
                const passwordValue = passwordInput.value.trim();
                if (passwordValue === '') {
                    passwordError.textContent = 'Password is required';
                    return false;
                } else if (passwordValue.length < 6) {
                    passwordError.textContent = 'Password must be at least 6 characters';
                    return false;
                } else {
                    passwordError.textContent = '';
                    return true;
                }
            }
        });
    </script> -->
</body>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('userForm');
  const usernameInput = document.getElementById('userName');
  const passwordInput = document.getElementById('userPassword');
  const usernameError = document.getElementById('usernameError');
  const passwordError = document.getElementById('passwordError');
  const togglePassword = document.getElementById('togglePassword');

  // Toggle password visibility
  togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
  });

  // Validate username
  usernameInput.addEventListener('input', validateUsername);
  usernameInput.addEventListener('blur', validateUsername);

  // Validate password
  passwordInput.addEventListener('input', validatePassword);
  passwordInput.addEventListener('blur', validatePassword);

  // Prevent form submission if username or password is invalid
  form.addEventListener('submit', function (event) {
    const isUsernameValid = validateUsername();
    const isPasswordValid = validatePassword();

    if (!isUsernameValid || !isPasswordValid) {
      event.preventDefault();
    }
  });

  // Validate username function
  function validateUsername() {
    const usernameValue = usernameInput.value.trim();
    if (usernameValue === '') {
      usernameError.textContent = 'Username is required';
      return false;
    } else if (usernameValue.length < 3) {
      usernameError.textContent = 'Username must be at least 3 characters';
      return false;
    } else {
      usernameError.textContent = '';
      return true;
    }
  }

  // Validate password function
  function validatePassword() {
    const passwordValue = passwordInput.value.trim();
    if (passwordValue === '') {
      passwordError.textContent = 'Password is required';
      return false;
    } else if (passwordValue.length < 6) {
      passwordError.textContent = 'Password must be at least 6 characters';
      return false;
    } else {
      passwordError.textContent = '';
      return true;
    }
  }
});
</script> -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('userForm');
  const usernameInput = document.getElementById('userName');
  const passwordInput = document.getElementById('userPassword');
  const usernameError = document.getElementById('usernameError');
  const passwordError = document.getElementById('passwordError');
  const togglePassword = document.getElementById('togglePassword');

  // Toggle password visibility
  togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
  });

  // Validate username
  usernameInput.addEventListener('input', validateUsername);
  usernameInput.addEventListener('blur', validateUsername);

  // Validate password
  passwordInput.addEventListener('input', validatePassword);
  passwordInput.addEventListener('blur', validatePassword);

  // Prevent form submission if username or password is invalid
  form.addEventListener('submit', function (event) {
    const isUsernameValid = validateUsername();
    const isPasswordValid = validatePassword();

    if (!isUsernameValid || !isPasswordValid) {
      event.preventDefault();
    } else {
      const usernameValue = usernameInput.value.trim();
      const passwordValue = passwordInput.value.trim();

      // Send a request to the server to check if the username and password match
      fetch('/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          username: usernameValue,
          password: passwordValue
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // If the username and password match, redirect to the dashboard
          window.location.href = '/dashboard';
        } else {
          // If the username or password is invalid, display an error message
          usernameError.textContent = 'Invalid username or password';
          usernameError.style.display = 'block';
        }
      })
      .catch(error => {
        console.error(error);
      });
    }
  });

  // Validate username function
  function validateUsername() {
    const usernameValue = usernameInput.value.trim();
    if (usernameValue === '') {
      usernameError.textContent = 'Username is required';
      usernameError.style.display = 'block';
      return false;
    } else if (usernameValue.toLowerCase() != "luffy") {
      usernameError.textContent = 'Invalid user name';
      usernameError.style.display = 'block';
      return false;
    } else {
      usernameError.textContent = '';
      usernameError.style.display = 'none';
      return true;
    }
    
  }

  // Validate password function
  function validatePassword() {
    const passwordValue = passwordInput.value.trim();
    if (passwordValue === '') {
      passwordError.textContent = 'Password is required';
      passwordError.style.display = 'block';
      return false;
    } else if ( passwordValue.toLowerCase()!="mugiwara" || passwordValue.length < 6 ) {
      passwordError.textContent = 'Invalid Password';
      passwordError.style.display = 'block';
      return false;
    } else {
      passwordError.textContent = '';
      passwordError.style.display = 'none';
      return true;
    }
  }
});
</script>
</html>

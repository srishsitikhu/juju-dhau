<?php include "header.php"; ?>
<?php
if (isset($_GET['notify'])) {
    $message = ($_GET['notify'] == 3) ? "Please login to continue" : ($_GET['notify'] == 4 ? "Invalid email or password" : "");
    $icon = ($_GET['notify'] == 3) ? "fas fa-sign-in-alt" : ($_GET['notify'] == 4 ? "fas fa-times-circle" : "fas fa-exclamation-circle");
    if ($message) {
        echo "<script>
            $(document).ready(function () {
                $('#notification-container .alert')
                    .addClass('alert-danger show')
                    .find('.notifyMsg')
                    .text('$message');
                $('#notification-container .alert i')
                    .addClass('$icon')
                    .css('color', 'red');
            });
        </script>";
    }
}
?>



<section class="form-section section-gaps">
    <div class="container">
    <div class="form-box">
    <div class="btn-field">
        <button type="button" name="sign_up" id="signUpBtn">Sign Up</button>
        <button type="button" name="sign_in" class="disable" id="signInBtn">Log In</button>
    </div>
    <h2 id="title">Sign Up</h2>
    <form id="userForm" action="login-register.php" method="post">
        <div class="input-group">
            <div class="input-field" id="nameField">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="userName" placeholder="Name" />
                <div class="error-message" id="nameError"></div>
            </div>
            <div class="input-field">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="userEmail" placeholder="Email" />
                <div class="error-message" id="emailError"></div>
            </div>
            <div class="input-field">
                <i class="fa-solid fa-key"></i>
                <input type="password" id="userPassword" name="userPassword" placeholder="Password" />
                <i class="fa fa-eye" id="togglePassword" aria-hidden="true"></i>
                <div class="error-message" id="passwordError"></div>
            </div>
            <div class="input-field" id="contactField">
                <i class="fa-solid fa-phone"></i>
                <input type="tel" name="userContact" placeholder="Phone Number" />
                <div class="error-message" id="contactError"></div>
            </div>
            <div class="input-field" id="addressField">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" name="userAddress" placeholder="Address" />
                <div class="error-message" id="addressError"></div>
            </div>
            <button type="submit" id="form-submit" name="sign_up">Submit</button>
        </div>
    </form>
</div>
    </div>
</section>
<?php include "footer.php"; ?>

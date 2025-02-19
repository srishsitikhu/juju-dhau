<?php include "header.php"; ?>



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
            </div>
            <div class="error-message" id="nameError"></div>
            <div class="input-field">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="userEmail" placeholder="Email" />
            </div>
            <div class="error-message" id="emailError"></div>
            <div class="input-field">
                <i class="fa-solid fa-key"></i>
                <input type="password" id="userPassword" name="userPassword" placeholder="Password" />
                <i class="fa fa-eye" id="togglePassword" aria-hidden="true"></i>
            </div>
            <div class="error-message" id="passwordError"></div>
            <div class="input-field" id="contactField">
                <i class="fa-solid fa-phone"></i>
                <input type="tel" name="userContact" placeholder="Phone Number" />
            </div>
            <div class="error-message" id="contactError"></div>
            <div class="input-field" id="addressField">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" name="userAddress" placeholder="Address" />
            </div>
            <div class="error-message" id="addressError"></div>
            <button type="submit" id="form-submit" name="sign_up">Submit</button>
        </div>
    </form>
</div>
    </div>
</section>
<?php include "footer.php"; ?>

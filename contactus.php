<?php
include("header.php"); // Include header for navigation
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>


    <script>
       document.addEventListener("DOMContentLoaded", function () {
    let nameField = document.getElementById("name");
    let emailField = document.getElementById("email");
    let messageField = document.getElementById("message");

    let nameError = document.getElementById("nameError");
    let emailError = document.getElementById("emailError");
    let messageError = document.getElementById("messageError");

    // Name validation on input
    nameField.addEventListener("input", function () {
        let name = nameField.value.trim();
        nameError.innerHTML = "";
        if (name === "") {
            nameError.innerHTML = "Name is required.";
        }
    });

    // Email validation on input
    emailField.addEventListener("input", function () {
        let email = emailField.value.trim();
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        emailError.innerHTML = "";
        if (!email.match(emailPattern)) {
            emailError.innerHTML = "Enter a valid email.";
        }
    });

    // Message validation on input
    messageField.addEventListener("input", function () {
        let message = messageField.value.trim();
        messageError.innerHTML = "";
        if (message.length < 10) {
            messageError.innerHTML = "Message must be at least 10 characters.";
        }
    });
});


    </script>
</head>

<body>

    <section class="contact-us-section">
        <div class="container">
            <h2>Contact Us</h2>
            <p class="text-center lead">We would love to hear from you! Fill out the form below or reach us through the
                given details.</p>

            <div class="row mt-5">
                <!-- Contact Details -->
                <div class="col-md-5">
                    <div class="card shadow p-4">
                        <h3 class="text-center text-secondary">📍 Our Office</h3>
                        <div class="contact-info">
                            <p><strong>Address:</strong> Bhaktapur</p>
                            <p><strong>Phone:</strong> 9822222222</p>
                            <p><strong>Email:</strong> <a href="mailto:jujudhau@gmail.com"> jujudhau@gmail.com</a></p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="col-md-7">
                    <div class="card shadow p-4">
                        <h3 class="text-center text-secondary">📩 Send Us a Message</h3>
                        <form action="process_contact.php" method="POST" id="contactForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                                <div class="error-message" id="nameError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                                <div class="error-message" id="emailError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                                <div class="error-message" id="messageError"></div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>

<?php
include("footer.php"); // Include footer for the page
?>
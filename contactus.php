<?php
include("header.php"); // Include header for navigation
?>

<section class="contact-us-section">
    <div class="container">
        <h2>Contact Us</h2>
        <p class="text-center lead">We would love to hear from you! Fill out the form below or reach us through the given details.</p>

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
`
            <!-- Contact Form -->
            <div class="col-md-7">
                <div class="card shadow p-4">
                    <h3 class="text-center text-secondary">📩 Send Us a Message</h3>
                    <form action="process_contact.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include("footer.php"); // Include footer for the page
?>

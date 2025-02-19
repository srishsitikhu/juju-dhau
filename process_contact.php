<?php
@session_start();
include("database/connect.php"); // Include database connection
include("header.php"); // Include header for navigation
?>



   <div class="contact-response">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Insert the data into the database
        $query = "INSERT INTO contact_us (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo '<i class="fas fa-check-circle icon success-icon"></i>';
            echo "<h2 class='text-success mt-3'>Thank you, $name!</h2>";
            echo "<p>Your message has been received. We will get back to you soon.</p>";
        } else {
            echo '<i class="fas fa-times-circle icon error-icon"></i>';
            echo "<h2 class='text-danger mt-3'>Oops! Something went wrong.</h2>";
            echo "<p>We couldn't process your message. Please try again later.</p>";
        }
        
        $stmt->close();
        $conn->close();
    }
    ?>

    <a href="contactus.php" class="btn btn-primary btn-back"><i class="fas fa-arrow-left"></i> Back to Contact</a>
    <a href="index.php" class="btn btn-secondary btn-back"><i class="fas fa-home"></i> Back to Home</a>
</div>
<?php
include("footer.php"); // Include footer for the page  
?>
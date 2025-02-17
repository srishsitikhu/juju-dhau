<?php
@session_start();
if (isset($_SESSION['userid'])) {
    $userName = $_SESSION['name'];
}
$user_search_data_value = "";
if (isset($_GET['search_keyword'])) {
    $user_search_data_value = $_GET['search_keyword'];
}
include('function/common-function.php');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/all.css" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery.js"></script>
<script src="js/notify.js"></script>

    <title>Juju-Dhau</title>
</head>


<body>
    <nav>
        <div class="navTop">
            <div class="navItem">
                <a href="index.php">

                    <img src="image/logo.png" alt="" class="logoImg">
                </a>

            </div>
            <div class="navItem">
                <div class="search">
                    <form action="search.php" method="get" class="search-form">
                        <input type="search" class="searchInput" name="search_keyword" placeholder="Search..." />
                        <button type="submit" class="searchButton">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <div id="suggestionsList" class="suggestions-list"></div>
                    </form>
                </div>
            </div>

            <div class="navItem">
                <ul class="nav-icon">
                    <li>
                        <span class="icon">
                            <a href="#">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <ul class="dropdown">
                                <?php
                                if (isset($_SESSION['userid'])) {
                                    echo '<li><span class="text"> Welcome, ' . $userName . '</span></li>';
                                    echo '<li><a href="user_profile.php" class="text">Profile</a></li>';
                                    echo '<li><a href="logout.php" class="text">Logout</a></li>';
                                } else {
                                    echo '<li><a href="form-box.php" class="login-btn">Login | Register</a></li>';
                                }
                                ?>

                            </ul>
                        </span>
                    </li>
                    <li>
                        <span class="icon"><a href="cart.php"><i class="fa-solid fa-cart-shopping"><span
                                        class="cart-no"><sup><?php total_product_cart(); ?></sup></span></i></a></span>
                    </li>
                    <span class="icon"><a href="order_list.php">Your Orders</a></span>
                </ul>
            </div>
        </div>
        <div class="overlay"></div>
    </nav>
<?php
if (isset($_GET['notify'])) {
    // Notifications data (message, icon, and icon color)
    $notifications = [
        1 => ["Registration Successful", "fas fa-check-circle", "green"],
        2 => ["Login Successful", "fas fa-check-circle", "green"],
        3 => ["Please login to continue", "fas fa-sign-in-alt", "red"],
        4 => ["Invalid email or password", "fas fa-times-circle", "red"],
        5 => ["Logout Successful", "fas fa-sign-out-alt", "green"],
        6 => ["Product removed successfully", "fas fa-trash-alt", "green"],
        7 => ["Cart updated successfully!", "fas fa-cart-plus", "green"],
        8 => ["Order placed successfully", "fas fa-check-circle", "green"],
        9 => ["Please add items to your cart", "fas fa-info-circle", "orange"],
        10 => ["Your account has been deleted successfully", "fas fa-user-times", "red"],
        11 => ["Profile updated successfully!", "fas fa-user-check", "green"],
        12 => ["Order deleted successfully", "fas fa-trash-alt", "green"],
        13 => ["Item added to cart successfully", "fas fa-cart-plus", "green"],
        14 => ["Item already in cart", "fas fa-info-circle", "orange"],
        15 => ["Order status updated successfully", "fas fa-sync-alt", "green"]
    ];

    // Mapping colors to alert classes
    $alertClasses = [
        'green' => 'alert-success',
        'red' => 'alert-danger',
        'orange' => 'alert-warning'
    ];

    if (isset($notifications[$_GET['notify']])) {
        list($message, $icon, $color) = $notifications[$_GET['notify']];
        $alertClass = isset($alertClasses[$color]) ? $alertClasses[$color] : 'alert-info'; // Default to info if color is not mapped
        $iconColor = $color;

        echo "<script>
        $(document).ready(function () {
            $('#notification-container .alert')
                .addClass('$alertClass show')
                .find('.notifyMsg')
                .text('$message');
            $('#notification-container .alert i')
                .addClass('$icon')
                .css('color', '$iconColor');
        });
        </script>";
    }
}
?>
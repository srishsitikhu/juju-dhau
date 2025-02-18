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
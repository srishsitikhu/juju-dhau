<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=close,grid_view,person_outline,receipt_long,settings,add" /> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="style.css">
</head>

<?php
// Start session at the top before any output
session_start();

// Check if the admin session exists
if (!isset($_SESSION['admin'])) {
    // Redirect to login page if session is invalid
    header('Location: login/login.php');
    exit;
}
?>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarLinks = document.querySelectorAll(".sidebar a");

        // Retrieve last active menu from localStorage
        const activePage = localStorage.getItem("activeMenu");

        if (activePage) {
            sidebarLinks.forEach(link => {
                if (link.getAttribute("href") === activePage) {
                    link.classList.add("active");
                } else {
                    link.classList.remove("active");
                }
            });
        }

        sidebarLinks.forEach(link => {
            link.addEventListener("click", function () {
                // Remove 'active' class from all links
                sidebarLinks.forEach(link => link.classList.remove("active"));

                // Add 'active' class to the clicked link
                this.classList.add("active");

                // Store the active menu in localStorage
                localStorage.setItem("activeMenu", this.getAttribute("href"));
            });
        });
    });

</script>

<body>
    <div class="container">
        <div class="left">
            <div class="top">
                <div class="logo">Juju Dhau</div>
                <div class="close">
                    <!-- Ensure the icon name is correct -->
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="index.php">
                    <span class="material-symbols-outlined">
                        grid_view
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="order_list.php" class="active">
                    <span class="material-symbols-outlined">
                        person_outline
                    </span>
                    <h3>Orders</h3>
                </a>
                <a href="product.php">
                    <span class="material-symbols-outlined">
                        receipt_long
                    </span>
                    <h3>Products</h3>
                </a>
                <a href="contactus.php">
                    <span class="material-symbols-outlined">
                        contact_support
                    </span>
                    <h3>Contact us</h3>
                </a>
                <a href="insert_product.php">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                    <h3>Add Product</h3>
                </a>
                <a href="user_list.php">
                    <span class="material-symbols-outlined">
                        person_outline
                    </span>
                    <h3>Users</h3>
                </a>
                <a href="login/logout.php">
                    <span class="material-symbols-outlined">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>

            </div>
        </div>
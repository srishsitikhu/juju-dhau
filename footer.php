<?php
include("database/connect.php");
?>


<footer>
    <div class="footerLeft">
        <div class="footerMenu">
            <h1 class="fMenuTitle">About Us</h1>
            <ul class="fList">
                <li class="fListItem"><a href="aboutus.php">About us</a></li>
                <li class="fListItem"><a href="contactus.php">Contact us</a></li>
                <li class="fListItem"><a href="shop_list.php">shop list</a></li>
            </ul>
        </div>
        <div class="footerMenu">
            <h1 class="fMenuTitle">Products</h1>
            <ul class="fList">
                <?php
                $titleQuery = "SELECT * FROM products";
                $result = mysqli_query($conn, $titleQuery);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $title = $row['list_title'];
                        $productId = $row['product_id']; // Correct column name for product ID
                        $productTitle = $row['title'];   // Correct column name for product title
                
                        // Output each title as a list item with proper concatenation
                        echo "<li class='fListItem'>
                                <a href='product-single-page.php?id=" . $productId . "' title='" . htmlspecialchars($productTitle) . "'>
                                    $title
                                </a>
                            </li>";
                    }
                } else {
                    echo "Error fetching titles: " . mysqli_error($conn);
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="footerRight">
        <div class="fRightMenu">
            <h1 class="fMenuTitle">Follow Us!</h1>
            <ul class="fIcons">
                <li><a href="#" title=""><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="#" title=""><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#" title=""><i class="fa-brands fa-whatsapp"></i></a></li>
            </ul>
        </div>
        <div class="fRightMenu">
            <span class="copyright">copyright@All rights reserved 2024</span>
        </div>
    </div>
</footer>

<script src="js/jquery.js"></script>
<script src="js/user_login.js"></script>
<script src="js/cart.js"></script>
<script src="js/search.js"></script>
<script src="js/script.js"></script>

<div id="notification-container" style="position: fixed; top: 10px; right: 10px; z-index: 1050; width: 300px;">
    <div class="alert alert-dismissible fade" role="alert">
        <i style="margin right: 10px;"></i>
        <span class="notifyMsg"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".btn-close").on("click", function () {
          $(".alert").remove();
        });
    });
    setTimeout(function () {
      $(".alert.show").fadeOut(500, function () {
        $(this).remove();
      });
    }, 3000);
</script>
   
</body>

</html>

<?php include('form-box.php'); ?>
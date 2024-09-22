<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        // $dynamicTitle = '';
        
        if (isset($dynamicTitle) && $dynamicTitle !== '') {
            echo $dynamicTitle;
        } else {
            echo 'Juju Dhau';
        }
        ?>
    </title>
    <link rel="icon" href="image/..." type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="site-header">
        <div class="top-header">
            <div class="container">
                <div class="announcement-bar">
                    <div class="item half">
                        <div class="announcement-text">
                            <p class="text">MID-SEASON SALE UP TO 70% OFF. USE CODE: “SALE70”. <a href="#" title="">Shop now</a></p>
                        </div>
                    </div>
                    <div class="item half-half">
                        <ul class="account-wishlist">
                            <li>
                                <a href="#" title="" class="text">My Account</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-header">
            <nav>
                <div class="container">
                    <div class="header-menu">
                        <div class="logo">
                            <a href="index.php" title="">
                                <img src="image/logo.png" style="width: 100px; height: 90px;" alt="logo">
                            </a>
                        </div>
                        <div class="nav-bar">
                            <ul class="primary-menu">
                                <li>
                                    <a href="#" title="">shop now</a>
                                </li>
                                <li>
                                    <a href="#" title="">Juju Dhau benefits</a>
                                </li>
                                <li>
                                    <a href="#" title="">about</a>
                                </li>
                                <li>
                                    <a href="#" title="">blogs</a>
                                </li>
                                <li>
                                    <a href="#" title="">contact</a>
                                </li>
                            </ul>
                            <ul class="search-cart">
                                <li class="item">
                                    <span class="icon search-icon">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16.0392 14.6244C17.2714 13.084 18.0082 11.1301 18.0082 9.00409C18.0082 4.03127 13.9769 0 9.00409 0C4.03127 0 0 4.03127 0 9.00409C0 13.9769 4.03127 18.0082 9.00409 18.0082C11.1301 18.0082 13.084 17.2714 14.6244 16.0392L20.2921 21.707C20.6828 22.0977 21.3163 22.0977 21.707 21.707C22.0977 21.3163 22.0977 20.6828 21.707 20.2921L16.0392 14.6244ZM9.00409 16.0173C5.13079 16.0173 1.99087 12.8774 1.99087 9.00409C1.99087 5.13079 5.13079 1.99087 9.00409 1.99087C12.8774 1.99087 16.0173 5.13079 16.0173 9.00409C16.0173 12.8774 12.8774 16.0173 9.00409 16.0173Z" fill="#11232E"/>
                                        </svg>                            
                                    </span>
                                    <div class="search-box">
                                        <form action="">
                                            <div class="form-wrap">
                                                <div class="form-group">
                                                    <input type="text" class="form-input" placeholder="Search for products...">
                                                </div>
                                                <span class="close-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="23.074" height="22.075" viewBox="0 0 23.074 22.075">
                                                        <g id="Group_122" data-name="Group 122" transform="translate(12477.207 332.207)">
                                                          <path id="Path_51" data-name="Path 51" d="M-12462.724-331.674l20.66,20.66" transform="translate(-12.776 0.174)" fill="none" stroke="#060d24" stroke-width="2"/>
                                                          <path id="Path_52" data-name="Path 52" d="M-12462.724-331.674l20.66,20.66" transform="translate(-12144.825 -12773.563) rotate(-90)" fill="none" stroke="#060d24" stroke-width="2"/>
                                                        </g>
                                                      </svg>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="item">
                                    <button>
                                        <span class="icon cart-icon">
                                            <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.91595 19.1931C3.38078 21 6.10708 21 11.5597 21H12.4403C17.8929 21 20.6192 21 22.084 19.1931M1.91595 19.1931C0.45111 17.3864 0.953535 14.6432 1.9584 9.15712C2.673 5.25565 3.0303 3.30491 4.38679 2.15245M22.084 19.1931C23.5489 17.3864 23.0465 14.6432 22.0417 9.15712C21.327 5.25565 20.9697 3.30491 19.6132 2.15245M19.6132 2.15245C18.2567 1 16.318 1 12.4403 1H11.5597C7.68209 1 5.74329 1 4.38679 2.15245" stroke="#11232E" stroke-width="2"/>
                                                <path d="M8.54541 6C9.04829 7.45649 10.4052 8.5 12.0002 8.5C13.5952 8.5 14.9522 7.45649 15.455 6" stroke="#11232E" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </span>
                                        <span class="text">Cart</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

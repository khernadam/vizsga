<?php
    $inactive = 600; 
    ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 10 minutes
    
    session_start();
    
    if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
        // last request was more than 10 minutes ago
        session_unset();     // unset $_SESSION variable for this page
        session_destroy();   // destroy session data
    }
    $_SESSION['testing'] = time(); // Update session
?>

<!DOCTYPE html>
    <html lang="hu">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <title>e-Turi</title>
            <link rel="icon" href="css/logo_icon.png" type="image/gif">
        </head>
        <body>
        <header>
            <nav>
                <div class="name"><img src="Logo.png" alt="Logo"></div>
                <form action="search.php" method="POST">
                    <input type="search" name="search" class="search" id="#" placeholder="Search" onfocus="this.placeholder='I can search here'" onblur="this.placeholder='Search'">
                    <button type="submit" name="submit-search" class="search-button"></button>
                </form>
                <label for="btn" class="icon">
                    <span>+</span>
                </label>
                <input type="checkbox" class="check" id="btn">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li>
                        <label for="btn-1" class="show">Products +</label>
                        <a href="products.php">Products</a>
                        <input type="checkbox" class="check" id="btn-1">
                        <ul>
                            <li>
                                <label for="btn-2" class="show">Men +</label>
                                <a href="men.php">Men</a>
                                <input type="checkbox" class="check" id="btn-2">
                                <ul>
                                    <li><a href="mjackets.php">Jackets</a></li>
                                    <li><a href="mshirts.php">Shirts</a></li>
                                    <li><a href="mt-shirts.php">T-Shirts</a></li>
                                    <li><a href="msweatshirts.php">Sweatshirts</a></li>
                                    <li><a href="mpants.php">Pants</a></li>
                                    <li><a href="mhats.php">Hats</a></li>
                                    <li><a href="mbags.php">Bags</a></li>
                                    <li><a href="maccessories.php">Accessories</a></li>
                                </ul>
                            </li>
                            <li>
                                <label for="btn-3" class="show">Women +</label>
                                <a href="women.php">Women</a>
                                <input type="checkbox" class="check" id="btn-3">        
                                <ul>
                                    <li><a href="wjackets.php">Jackets</a></li>
                                    <li><a href="wshirts.php">Shirts</a></li>
                                    <li><a href="wt-shirts.php">T-Shirts</a></li>
                                    <li><a href="wsweatshirts.php">Sweatshirts</a></li>
                                    <li><a href="wpants.php">Pants</a></li>
                                    <li><a href="whats.php">Hats</a></li>
                                    <li><a href="wbags.php">Bags</a></li>
                                    <li><a href="waccessories.php">Accessories</a></li>
                                </ul>
                            </li>
                            <li>
                                <label for="btn-4" class="show">Kids +</label>
                                <a href="kids.php">Kids</a>
                                <input type="checkbox" class="check" id="btn-4">        
                                <ul>
                                    <li><a href="kjackets.php">Jackets</a></li>
                                    <li><a href="kshirts.php">Shirts</a></li>
                                    <li><a href="kt-shirts.php">T-Shirts</a></li>
                                    <li><a href="ksweatshirts.php">Sweatshirts</a></li>
                                    <li><a href="kpants.php">Pants</a></li>
                                    <li><a href="khats.php">Hats</a></li>
                                    <li><a href="kbags.php">Bags</a></li>
                                    <li><a href="kaccessories.php">Accessories</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="about_me.php">About me</a></li>
                    <?php
                        if (isset($_SESSION["username"]) and isset($_SESSION["userid"])) {
                            echo "<li><a href='profile.php'>Profile page</a></li>";
                            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                        }
                        else {
                            echo "<li><a href='signup.php'>Sign up</a></li>";
                            echo "<li><a href='login.php'>Log in</a></li>";
                        }
                    ?>
                </ul>
            </nav>
        </header>
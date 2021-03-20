<?php
    include_once 'header.php';
?>
    <div id="container">
        <section class="wrapper">
            <div class="signup-form" id="sig">
                <h1>Log In</h1>
                <form action="includes/login.inc.php" method="post">
                    <p>Name or e-mail</p>
                    <input type="text" name="name" placeholder="Name or e-mail"><br>
                    <p>Password</p>
                    <input type="password" name="pwd" placeholder="Password"><br>
                    <button type="submit" id="open-popup" name="submit">Log In</button><br>
                    <a href="#">Forgot your password?</a><br>
                    <a href="signup.php">Don't have an account?</a>
                </form>
            </div>
            
            <div class="popup center">
                <div class="icon2">
                    <p class="fa">X</p>
                </div>
                <div class="title">
                    Oops!
                </div>
                <div class="desc">
                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo "Fill in all fields!";
                            }
                            elseif ($_GET["error"] == "wronglogin") {
                                echo "Incorrect name or e-mail!";
                            }
                            elseif ($_GET["error"] == "wrongpassword") {
                                echo "Incorrect password!";
                            }
                            elseif ($_GET["error"] == "none") {
                                echo "Hello, there!";
                            }
                        }
                    ?>
                </div>
                <div class="dismiss">
                    <button id="dismiss-popup">
                        Dismiss
                    </button>
                </div>
            </div>

            <script>
                var fromPHP = '<?php echo $_GET["error"]; ?>';
                                    
                if(fromPHP == 'wrongpassword' || 'wronglogin' || 'emptyinput'){
                    document.getElementsByClassName('popup')[0].classList.add('active');
                }
                else if(fromPHP == 'none'){
                    document.getElementsByClassName('popup'),[0].classList.add('success');
                }
            </script>
        </section>
    </div>
<?php
    include_once 'footer.php';
?>
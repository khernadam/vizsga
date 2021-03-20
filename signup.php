<?php
    include_once 'header.php';
?>
    <div id="container">
        <section class="wrapper">
            <div class="signup-form">
                <h1>Sign Up</h1>
                <form action="includes/signup.inc.php" method="post">
                    <p>Name</p>
                    <input type="text" name="name" placeholder="Name" autofocus><br>
                    <p>E-mail</p>
                    <input type="text" name="email" placeholder="E-mail"><br>
                    <p>Birthday</p>
                    <input type="date" name="birthday"><br>
                    <p>Gender</p>
                    <input type="radio" name="gender" value="male">
                    <label for="male">Male</label>
                    <input type="radio" name="gender" value="female">
                    <label for="female">Female</label>
                    <input type="radio" name="gender" value="other">
                    <label for="other">Other</label>
                    <p>Tel. number</p>
                    <input type="tel" name="tel" placeholder="Tel. number"><br>
                    <p>Password</p>
                    <input type="password" name="pwd" placeholder="Password"><br>
                    <p>Repeat password</p>
                    <input type="password" name="pwd-rep" placeholder="Repeat password"><br>
                    <button type="submit" name="submit">Sign Up</button>
                </form>
            </div>

            <div class="popup center">
                <div class="icon2" id="i2">
                    <p class="fa" id="f">X</p>
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
                            elseif ($_GET["error"] == "invalidname") {
                                echo "Choose a proper username!";
                            }
                            elseif ($_GET["error"] == "invalidemail") {
                                echo "Choose a proper e-mail!";
                            }
                            elseif ($_GET["error"] == "passwordsdontmatch") {
                                echo "Passwords doesn't match!";
                            }
                            elseif ($_GET["error"] == "stmtfailed") {
                                echo "Something went wrong, try again!";
                            }
                            elseif ($_GET["error"] == "nametaken") {
                                echo "Name already taken!";
                            }
                            elseif ($_GET["error"] == "none") {
                                echo "You have signed up!";
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
                                    
                if(fromPHP == 'passwordsdontmatch' || 'invalidname' || 'invalidemail' || 'stmtfailed' || 'nametaken' || 'emptyinput'){
                    document.getElementsByClassName('popup')[0].classList.add('active');
                }
                else if(fromPHP == 'none'){
                    document.getElementsByClassName('popup')[0].className.add('active');
                    document.getElementById('i2').style.border = "2px solid green";
                    document.getElementById('f').style.color = "green";
                }
            </script>
        </section>
    </div>
<?php
    include_once 'footer.php';
?>
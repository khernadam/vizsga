<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
?>
    <div id="container">
        <section class="board">
            <?php
            if (isset($_SESSION["username"]) and isset($_SESSION["userid"])) {
                $name = $_SESSION["username"];

                $sql = "SELECT * FROM users WHERE usersName = '$name';";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['usersId'];
                        $sqlImg = "SELECT * FROM profimg WHERE userid='$id'";
                        $resultImg = mysqli_query($conn, $sqlImg);
                        while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                            echo "<div>";
                                if ($rowImg['status'] == 0) {
                                    echo "<img src='uploads/profile". $id .".png?". mt_rand() ."' alt='Profile picture' class='profpic'>";
                                }
                                else {
                                    echo "<img src='uploads/profpicdefault.png' alt='Profile picture' class='profpic'>";
                                }
                            echo "</div>";
                        }
                    }
                }
            }
            ?>
                
            <div class="profboard">
                <table class="profdata">
                    <caption class="profcaption">Personal data</caption>
                    <?php
                    if (isset($_SESSION["username"]) and isset($_SESSION["userid"])) {
                        $name = $_SESSION["username"];

                        $sql = "SELECT * FROM users WHERE usersName = '$name';";
                        $results = mysqli_query($conn, $sql);
                        $resultsCheck = mysqli_num_rows($results);
                    
                        if ($resultsCheck > 0) {
                            while ($row = mysqli_fetch_assoc($results)) {
                                echo
                                                "<tr>
                                                    <td>
                                                        Name:
                                                    </td>
                                                    <td>"
                                                        . $row['usersName'] .
                                                    "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        E-mail:
                                                    </td>
                                                    <td>"
                                                        . $row['usersEmail'] .
                                                    "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Date of birth:
                                                    </td>
                                                    <td>"
                                                        . $row['usersBday'] .
                                                    "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Gender:  
                                                    </td>
                                                    <td>"
                                                        . $row['usersGender'] .                        
                                                    "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Telefon number:
                                                    </td>
                                                    <td>"
                                                        . $row['usersTel'] .
                                                    "</td>
                                                </tr>";
                            }
                        }
                    }    
                    ?>
                </table>
            </div>        
            <div class="profimg-up">
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <input type="file" name="file">
                    <button type="submit" name="submit" style="padding-left: 70px; padding-right: 70px;">UPLOAD</button>
                </form>
                <form action="delete.php" method="POST">
                    <button type="submit" name="submit" style="padding-left: 70px; padding-right: 70px;">DELETE</button>
                </form>
            </div>
            <hr class="separator2">
        </section>

        <section class="own-stuffs">
            <div class="board">
                <h2 class="separator">Own Stuffs</h2>
                <div class="os-container">
                    <?php
                    if (isset($_SESSION["userid"])){
                        $id = $_SESSION["userid"];

                        $sql = "SELECT * FROM products WHERE userId = '$id';";
                        $results = mysqli_query($conn, $sql);
                        $resultsCheck = mysqli_num_rows($results);

                        if ($resultsCheck > 0) {
                        
                            $sql = "SELECT * FROM products WHERE userId = '$id' ORDER BY id DESC;";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "SQL statment failed!";
                            }
                            else {
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo
                                    '<a href="selected_product.php?id='. $row["id"] .'">
                                    <div style="background-image: url(prodgallery/'. $row["productsName"] .');" class="item"></div>
                                    <h3>'. $row["productsTitle"] .'</h3>
                                    <p>Category: '. $row["productsCat"] .'</p>
                                    <p>Type: '. $row["productsType"] .'</p>
                                    <p>Size: '. $row["productsSize"] .'</p>
                                    <p>Condition: 10/'. $row["productsCond"] .'</p>
                                    <p>Price: '. $row["productsPrice"] .'Ft</p>
                                    </a>';
                                }
                            }
                        }
                    }
                    ?>
                </div>

                <h2 class="separator" id="upload-title">Stuff Upload</h2>

                <div id="sig">
                    <form action="includes/prod_uploads.inc.php" method="POST" enctype="multipart/form-data">
                        <p>Filename</p>
                        <input type="text" name="filename" placeholder="FileName" required>
                        <p>Title</p>
                        <input type="text" name="filetitle" placeholder="Title" required>
                        <p>Category</p>
                        <select name="prodcategory" class="select" required>
                            <option value="0">--Category--</option>
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                            <option value="Kids">Kids</option>
                        </select><br>
                        <p>Type</p>
                        <select name="prodtype" class="select" required>
                            <option value="0">--Type--</option>
                            <option value="Jackets">Jackets</option>
                            <option value="Shirts">Shirts</option>
                            <option value="T-Shirts">T-Shirts</option>
                            <option value="Sweatshirts">Sweatshirts</option>
                            <option value="Pants">Pants</option>
                            <option value="Hats">Hats</option>
                            <option value="Bags">Bags</option>
                            <option value="Accessories">Accessories</option>
                        </select><br>
                        <p>Size</p>
                        <select name="prodsize" class="select" required>
                            <option value="0">--Size--</option>
                            <option value="One Size">One size</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select><br>
                        <p>Condition</p>
                        <input type="number" name="prodcondition" placeholder="10/?" min="1" max="10" required>
                        <p>Price</p>
                        <input type="number" name="prodprice" placeholder="pl: 10000" required>
                        <input type="file" name="file" required>
                        <button type="submit" name="submit2">UPLOAD</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
<?php
    include_once 'footer.php';
?>
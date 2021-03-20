<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
?>
    <div id="container">
        <div class="back">
            <?php
                $id = $_GET['id'];

                $sql = "SELECT productsCat, productsType FROM products WHERE id = '$id';";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['productsCat'] == "Men") {
                            echo "<a href='products.php'>&lt Products</a><a href='". strtolower($row["productsCat"]) .".php'>&lt ". $row["productsCat"] ."</a><a href='m". strtolower($row["productsType"]) .".php'>&lt ". $row["productsType"] ."</a>";
                        }
                        elseif ($row['productsCat'] == "Women") {
                            echo "<a href='products.php'>&lt Products</a><a href='". strtolower($row["productsCat"]) .".php'>&lt ". $row["productsCat"] ."</a><a href='w". strtolower($row["productsType"]) .".php'>&lt ". $row["productsType"] ."</a>";
                        }
                        elseif ($row['productsCat'] == "Kids") {
                            echo "<a href='products.php'>&lt Products</a><a href='". strtolower($row["productsCat"]) .".php'>&lt ". $row["productsCat"] ."</a><a href='k". strtolower($row["productsType"]) .".php'>&lt ". $row["productsType"] ."</a>";
                        }
                    }
                }
            ?>
            
            <hr style="background-color: black; border: 1px solid black;">
        </div>

        <section class="board">
        
            <?php
                $id = $_GET['id'];

                $sql = "SELECT * FROM products WHERE id = '$id';";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                    
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo
                        "<div>
                            <img src='prodgallery/". $row["productsName"] ."' alt='Product picture' class='prodpic'>
                        </div>";
                    }
                }
            ?>
                
            <div class="prodboard">
                <table class="proddetails">
                    <caption class="profcaption">Details</caption>
                    <?php
                        $id = $_GET['id']; 
                    
                        $sql = "SELECT * FROM products WHERE id = '$id';";
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
                                                        . $row['productsTitle'] .
                                                    "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Category:
                                                    </td>
                                                    <td>"
                                                        . $row['productsCat'] .
                                                    "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Type:
                                                    </td>
                                                    <td>"
                                                        . $row['productsType'] .
                                                    "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Size:  
                                                    </td>
                                                    <td>"
                                                        . $row['productsSize'] .                        
                                                    "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Condition:
                                                    </td>
                                                    <td>
                                                        10/". $row['productsCond'] .
                                                    "</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Price:
                                                    </td>
                                                    <td>"
                                                        . $row['productsPrice'] ."Ft
                                                    </td>
                                                </tr>";
                            }
                        }
                    ?>
                </table>
                <table class="seller">
                    <caption class="profcaption">Seller</caption>
                    <?php
                        $id = $_GET['id']; 
                    
                        $sql = "SELECT users.usersName, users.usersEmail, users.usersTel FROM users inner join products on users.usersId = products.userId WHERE products.id = '$id';";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
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
                                        Telefon number:
                                    </td>
                                    <td>"
                                        . $row['usersTel'] .
                                    "</td>
                                </tr>";
                        }
                    ?>
                </table>
            </div>
            <?php
            if (isset($_SESSION["userid"])) {
                $id = $_GET['id'];
                $sessionid = $_SESSION["userid"];

                $sql = "SELECT userId, productsName FROM products WHERE id = '$id';";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result);

                if ($row["userId"] == $sessionid) {
                    echo
                    "<div class='prod-buttons'>
                        <form action='#' method='POST' enctype='multipart/form-data'>
                            <button type='submit' name='submit' class='prod-button' style='float: left;'>EDIT</button>
                        </form>
                        <form action='includes/prod_deletes.inc.php?prodname=". $row['productsName'] ."' method='POST'>
                            <button type='submit' name='submit' class='prod-button' style='float: right;'>DELETE</button>
                        </form>
                    </div>";
                }
            }
            ?>
            <hr class="separator2">
        </section>

        <section class="more-stuff-box">
            <div class="separator">Products from the same seller</div>
            <div class="os-container">
                <?php
                    $id = $_GET['id']; 
                        
                    $userid = "SELECT userId FROM products WHERE id = '$id';";
                    $result = mysqli_query($conn, $userid);
                    $r = mysqli_fetch_assoc($result);

                    $sql = "SELECT * FROM products WHERE userId = '$r[userId]' AND id != '$id' ORDER BY id DESC;";
                    $results = mysqli_query($conn, $sql);
                    $resultsCheck = mysqli_num_rows($results);

                    if ($resultsCheck > 0) {                    
                        while ($row = mysqli_fetch_assoc($results)) {
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
                    else {
                        echo "<p style='margin: auto;'>The seller have no more product!</p>";
                    }
                ?>
            </div>
        </section>
    </div>
<?php
    include_once 'footer.php';
?>
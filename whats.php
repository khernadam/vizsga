<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
?>
    <div id="container">
        <div class="back">
            <a href="products.php">&lt Products</a><a href="women.php">&lt Women</a>
            <hr style="background-color: black; border: 1px solid black;">
        </div>

        <section class="board">
            <div class="os-container">
                <?php
                    $sql = "SELECT * FROM products WHERE productsCat = 'Women' AND productsType = 'Hats' ORDER BY id DESC;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        
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
                ?>
            </div>
        </section>
    </div>
<?php
    include_once 'footer.php';
?>
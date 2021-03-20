<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
?>
    <div id="container">
        
                <?php
                    if (isset($_POST['submit-search'])) {
                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                        $sql = "SELECT * FROM products WHERE productsTitle LIKE '%$search%' OR productsCat LIKE '%$search%' OR productsType LIKE '%$search%' OR productsSize LIKE '%$search%' OR productsCond LIKE '%$search%' OR productsPrice LIKE '%$search%';";
                        $result = mysqli_query($conn, $sql);
                        $searcChek = mysqli_num_rows($result);

                        echo "<h2 class='search-result'>There are ". $searcChek ." results!</h2>";

                        if ($searcChek > 0) {
                            echo
                            "<section class='new-stuff-box' id='new-stuffs'>
                            <div class='os-container'>";
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
                            echo
                            "</div>
                            </section>";
                        }
                        else {
                            echo "<h2 class='search-result'>There are no results matching your search or the product(s) was deleted!</h2>";
                        }
                    }
                ?>

    </div>
<?php
    include_once 'footer.php';
?>
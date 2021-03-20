<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
?>

    <div id="container">
        <section class="auto-slider">
            <div id="slider">
                    <figure>
                        <img src="crossfade3.png" alt="Men">
                        <img src="crossfade3.png" alt="Women">
                        <img src="crossfade3.png" alt="Akcio">
                    </figure>
                <div class="indicator"></div>
            </div>
        </section>

        <section class="news-box" id="news-box">
            <div class="separator">Shortcuts</div>
            <div class="news">
                <table>
                    <tr>
                        <td rowspan="2"><a href="#new-stuffs"><img src="new_label.png" class="item2"></a></td>
                        
                        <td><a href="women.php"><img src="women.jpg" class="item1"></a></td>
                        <td><a href="men.php"><img src="men.jpg" class="item1"></a></td>
                    </tr>
                    <tr>
                        <td colspan="2"><a href="#"><img src="sale.jpg" class="item3"></a></td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="new-stuff-box" id="new-stuffs">
            <div class="separator">New Stuffs</div>
            <div class="os-container">
                <?php
                    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 8;";
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
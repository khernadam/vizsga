<?php

session_start();
include_once 'dbh.inc.php';
$id = $_SESSION['userid'];

if (isset($_POST['submit2'])) {
    $newFileName = $_POST['filename'];
    if (empty($newFileName)) {
        $newFileName = "gallery";
    }
    else {
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $prodTitle = $_POST['filetitle'];
    $prodCat = $_POST['prodcategory'];
    $prodType = $_POST['prodtype'];
    $prodSize = $_POST['prodsize'];
    $prodCond = $_POST['prodcondition'];
    $prodPrice = $_POST['prodprice'];

    $file = $_FILES['file'];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 4000000) {
                $prodFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                $fileDestination = "../prodgallery/" . $prodFullName;

                if (empty($prodTitle) || empty($prodCat) || empty($prodType) || empty($prodSize) || empty($prodCond) || empty($prodPrice)) {
                    header("location: ../profile.php?upload2=empty");
                    exit();
                }
                else {
                    $sql = "SELECT * FROM products;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL statment failed!";
                    }
                    else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOrder = $rowCount + 1;

                        $sql = "INSERT INTO products (userId, productsName, productsTitle, productsCat, productsType, productsSize, productsCond, productsPrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL statment failed!";
                        }
                        else {
                            mysqli_stmt_bind_param($stmt, "ssssssss", $id, $prodFullName, $prodTitle, $prodCat, $prodType, $prodSize, $prodCond, $prodPrice);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName, $fileDestination);

                            header("location: ../profile.php?upload2=success");
                        }
                    }
                }
            }
            else {
                echo "File size is too big!";
                exit();
            }
        }
        else {
            echo "You had an error!";
            exit();
        }
    }
    else {
        echo "You need to upload a proper file type!";
        exit();
    }

}
?>
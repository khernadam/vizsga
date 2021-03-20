<?php

session_start();
include_once 'dbh.inc.php';
$prodName = $_GET['prodname'];


$filename = "prodgallery/". $prodName;
$fileinfo = glob($filename);

$file = "prodgallery/". $prodName;

if (!unlink($file)) {
    echo "File was not deleted!";
}
else {
    echo "File was deleted!";
}

$sql = "DELETE FROM products WHERE productsName = '$prodName';";
mysqli_query($conn, $sql);

header("location: ../profile.php?deletesuccess");

?>
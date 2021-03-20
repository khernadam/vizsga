<?php

session_start();
include_once 'includes/dbh.inc.php';
$id = $_SESSION['userid'];

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = "profile" . $id . "." . $fileActualExt;
                $fileDestination = 'uploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "UPDATE profimg SET status = 0 WHERE userid = '$id';";
                $result = mysqli_query($conn, $sql);

                header("location: profile.php?uploadsucces");
            }
            else {
                echo "Your file is too big!";
            }
        }
        else {
            echo "There was an error uploding your file!";
        }
    }
    else {
        echo "You cannot upload files of this type!";
    }
}

?>
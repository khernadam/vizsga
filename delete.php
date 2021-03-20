<?php

session_start();
include_once 'includes/dbh.inc.php';
$sessionid = $_SESSION['userid'];

$filename = "uploads/profile". $sessionid ."*";
$fileinfo = glob($filename);
$fileext = explode(".", $filename[0]);
$fileactualext = $fileext[1];

$file = "uploads/profile". $sessionid .".". $fileactualext;

if (!unlink($file)) {
    echo "File was not deleted!";
}
else {
    echo "File was deleted!";
}

$sql = "UPDATE profimg SET status = 1 WHERE userid = '$sessionid';";
mysqli_query($conn, $sql);

header("location: profile.php?deletesuccess");

?>
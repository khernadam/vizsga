<?php

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];
    $tel = $_POST["tel"];
    $pwd = $_POST["pwd"];
    $pwdRep = $_POST["pwd-rep"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $pwd, $pwdRep) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidName($name) !== false) {
        header("location: ../signup.php?error=invalidname");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRep) !== false) {
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if (nameExists($conn, $name, $email) !== false) {
        header("location: ../signup.php?error=nametaken");
        exit();
    }

    createUser($conn, $name, $email, $birthday, $gender, $tel, $pwd);
}
else{
    header("location: ../signup.php");
}
?>
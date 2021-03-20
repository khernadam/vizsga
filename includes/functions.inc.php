<?php

//Sign up functions:

function emptyInputSignup($name, $email, $pwd, $pwdRep){
    $result = false;
    if (empty($name) || empty($email)|| empty($pwd) || empty($pwdRep)) {
        $result = true;
    }
    return $result;
}

function invalidName($name){
    //var_dump($_POST);
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9\s]*$/", $name)) {
        $result = true;
    }
    return $result;
}

function invalidEmail($email){
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRep){
    $result = false;
    if ($pwd !== $pwdRep) {
        $result = true;
    }
    return $result;
}

function nameExists($conn, $name, $email){
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";
    echo $sql;
    echo $name . $email;
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $birthday, $gender, $tel, $pwd){
    $sql = "INSERT INTO users (usersName, usersEmail, usersBday, usersGender, usersTel, usersPwd) VALUES (?, ?, ?, ?, ?, ?);";
    echo $sql;
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $birthday, $gender, $tel, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql = "SELECT * FROM users WHERE usersName = '$name' AND usersEmail = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $userid = $row['usersId'];
            $sql = "INSERT INTO profimg (userid, status) VALUES ('$userid', 1)";
            mysqli_query($conn, $sql);
        }
    }

    header("location: ../signup.php?error=none");
    exit();
}


//Log in functions:

function emptyInputLogin($name, $pwd){
    $result = false;
    if (empty($name) || empty($pwd)) {
        $result = true;
    }
    return $result;
}

function loginUser($conn, $name, $pwd){
    $nameExists = nameExists($conn, $name, $name);

    if ($nameExists === false) {
        header ("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $nameExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header ("location: ../login.php?error=wrongpassword");
        exit();
    }
    elseif ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $nameExists["usersId"];
        $_SESSION["username"] = $nameExists["usersName"];
        header ("location: ../home.php?");
        exit();
    }
}
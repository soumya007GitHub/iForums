<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['signinemail'];
    $pass = $_POST['signinpassword'];

    // check whether user already exists or not
    $exists_sql = "SELECT * FROM `users` WHERE user_email = '$email'";
    $result = mysqli_query($conn, $exists_sql);
    $rows = mysqli_num_rows($result);
    if($rows == 1){
        $row = mysqli_fetch_assoc($result);
            if(password_verify($pass, $row['user_pass'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sl'] = $row['sl'];
                $_SESSION['username'] = $email;
            }
            header("Location: /forum/index.php");
        }
    }
 ?>
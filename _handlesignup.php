<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_dbconnect.php';
    $user_email = $_POST['signupemail'];
    $user_pass = $_POST['signuppassword'];
    $user_cpass = $_POST['signupcpassword'];

    // check whether user already exists or not
    $exists_sql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $exists_sql);
    $exists = 0;
    $rows = mysqli_num_rows($result);
    if($rows>0){
        $exists = 1;
        header("Location: /forum/index.php?alert=userexists");
          }
    else{
        if($user_pass == $user_cpass){
            $hash = password_hash($user_pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `time`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $exists = 2;
                header("Location: /forum/index.php?alert=success");
                exit();
            }
        }
        else{
            echo "Password doesn't match.";
        }
    }
}
 ?>


    
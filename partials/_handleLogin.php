<?php
session_start(); 
ob_start();
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){

    include '_dbconnect.php';

    $email = $_POST['login-email'];
    $pass = $_POST['login-password'];

    $sql = "select * from `users` where user_email='$email' and acc_status='active'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1 ){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['password'])){
            
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['useremail'] = $email;
            // $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['user_name'];
            // echo "logged in ".$email;
            header("Location: /ThePlayerHub/index.php?logginsuccess=true");
            exit();

        }
        else{
            
            header("Location: /ThePlayerHub/?logginsuccess=false&&error=false");
            exit();
        }
    }
    header("Location: /ThePlayerHub/?invalid=true");

}
?>
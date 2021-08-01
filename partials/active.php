<?php

session_start();

include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $token = $_GET['token'];

    $statusUpdate = "UPDATE `users` SET `acc_status` = 'active' WHERE `users`.`token` = '$token'";

    $query = mysqli_query($conn, $statusUpdate);

    if($query){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Account has been activated successfully.";
            header('location:../index.php');
        }else{
            $_SESSION['msg'] = "You are logged out.";
        }
    }else{
        $_SESSION['msg'] = "Failed to activate your account.";
    }
}


?>
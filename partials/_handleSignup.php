<?php

session_start();

$showError = "false";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    include '_dbconnect.php';
    
    $username = $_POST['user_name'];
    $email = $_POST['user_email'];
    $contact = $_POST['user_contact'];
    $password = $_POST['user_password'];
    $cPass = $_POST['user_cPassword'];


    // chekc whether entered email exits or not

    $email_verify = "select * from `users` where user_email ='$email'";
    $queryForEmail = mysqli_query($conn, $email_verify);
    $emailCount = mysqli_num_rows($queryForEmail);

    if($emailCount > 0){

        header("Location: /ThePlayerHub/index.php?existsemail=true");
        exit();

    }else{
        if($password === $cPass){

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(15));

            $sql = "INSERT INTO `users` (`user_name`, `user_email`, `contact`, `password`, `token`, `acc_status`) VALUES ('$username','$email', '$contact', '$hash', '$token', 'inactive')";

            $result = mysqli_query($conn, $sql);

            if($result){
                $subject = "Active your ThePlyerHub Account";
                $body = "Dear,". $username." . Welcome to ThePlayerHub .Take the next step to confrim your ThePlyerHub account.
                Click this link to active your account http://localhost/ThePlayerHub/partials/active.php?token=$token
                
                If you failed to activate your account.. Do not hesitate to contact with us
                Email: info@theplayerhub.net
                Phone : +60108969253

                Regards 
                ThePlayerHub Community
                
                ";
                $server_Email = "From: alam.server.my@gmail.com";

                if (mail($email, $subject, $body, $server_Email)){
                    $_SESSION['email'] = $email;
                }else{
                    echo "Failed to send email";
                }

                $showAlert = true;
                header("Location: /ThePlayerHub/index.php?signupsuccess=true");
                exit();
            }



        }else{

            $showError = "Password doesn't matched";
            
        }
    }

    header("Location: /ThePlayerHub/index.php?signupsuccess=false&error=$showError");
    exit();




}





?>
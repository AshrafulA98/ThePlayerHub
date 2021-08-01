<?php 
ob_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/653364a29a.js" crossorigin="anonymous"></script>

    <style type="text/css">
    #question-container {
        min-height: 790px;
    }
    </style>

    <title>Create New Password</title>
</head>

<body>
    <?php include '_dbconnect.php'?>
    <?php include 'header.php'; ?>

    <?php
        
        
        if(isset($_POST['passReco'])){
        
            if(isset($_GET['token'])){
            $token = $_GET['token'];
            $newPassword = $_POST['password'];
            $confrimNewPass =$_POST['conpass'];
            

            if($newPassword===$confrimNewPass)
            {
               $newhash = password_hash($newPassword, PASSWORD_DEFAULT);
               $password_Update = "UPDATE `users` SET `password`= '$newhash' WHERE `users`.`token` = '$token'";

            // $password_Update = "update users set password='$newhash' where token='$token'";

            $query = mysqli_query($conn, $password_Update);

               if($query){
                echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
              <strong>Well Done !</strong> Password has been updated.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>';
               }

            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
              <strong>Error !</strong> Failed to update the password.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>';
            }

        }
           
        }
        
        ?>


    <div class="container col-md-6 my-5" id="question-container">
        <div class="justify-content-center align-items-center  m-auto ">
            <h1>Create New Password</h1>
            <form class="my-3 justify-content-center align-items-center col-md-6" action="" class="sign-in-form"
                method="post">
                <div class="input-group-prepend text-center mb-2">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    <input type="password" class="form-control shadow-none" id="newpassword" name="password"
                        placeholder="New Password" autocomplete="off">
                </div>
                <div class="input-group-prepend text-center">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    <input type="password" class="form-control shadow-none" id="confrimNewPass" name="conpass"
                        placeholder="Confrim Password" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-success my-3 px-5 p-3" name="passReco">Update password</button>
            </form>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
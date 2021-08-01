
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/653364a29a.js" crossorigin="anonymous"></script>

    <style type="text/css">
    #question-container {
        min-height: 733px;
    }
    </style>

    <title>Password Recovery</title>
  </head>
  <body>

  <?php include 'partials/_dbconnect.php';?>
  <?php include 'partials/header.php'; ?>

  <!-- <nav class="navbar navbar-dark bg-dark my-0">
        <a class="navbar-brand" href="index.php">
            Home
        </a>
    </nav> -->

    <?php
        
        if(isset($_POST['reset-request-submit'])){

            $user_email = mysqli_real_escape_string($conn, $_POST['recoverEmail']);
            $email_chekcer = "select * from `users` where user_email='$user_email'";
            $email_count = mysqli_query($conn, $email_chekcer);

            $user_data = mysqli_fetch_assoc($email_count);

            $user_name = $user_data['user_name'];
            $token = $user_data['token'];

            if( $email_count){
                $subject = "Password Recovery";
                $body = "Hi,". $user_name." . Gretting from ThePlyerHub Community. We have received a password recovery request from you. Click the link to reset your password  
                http://localhost/ThePlayerHub/partials/create-new-password.php?token=$token
                
                If you failed to reset your password..Do not hesitate to contact with us
                Email: info@theplayerhub.net
                Phone : +60108969253

                Regards 
                ThePlayerHub Community
                ";
                $server_Email = "From: alam.server.my@gmail.com";
                $email_found = true;
                if (mail($user_email, $subject, $body, $server_Email)) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Well done!</strong> A password recovery link has been sent to <b>'.$user_email.'</b>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
                }

            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Invalid email adress. Use the valid e-mail.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
            }

        }
        
        
        ?>

    <div class="container col-md-6 my-5" id="question-container">
        <div class="justify-content-center align-items-center  m-auto ">
            <h1>Reset your password</h1>
            <p>An e-mail will be send to you with instruction on how to reset your password</p>
            <form class="my-3 justify-content-center align-items-center col-md-6"
            action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
                <div class="input-group-prepend text-center mb-2">
                    <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                    <input type="email" class="form-control shadow-none" id="email" name="recoverEmail"
                        placeholder="Enter your e-mail adress" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-success my-3 px-4 p-3" name="reset-request-submit">Receive new password by e-mail</button>
            </form>
        </div>
    </div>


       

        <?php include 'partials/footer.php';?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
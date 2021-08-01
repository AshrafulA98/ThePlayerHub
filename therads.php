<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/653364a29a.js" crossorigin="anonymous"></script>

    <style type="text/css">
    #question-container {
        min-height: 433px;
    }
    </style>

    <title>ThePlayerHub</title>
</head>

<body>

    <?php include 'partials/_dbconnect.php'?>
    <?php include 'partials/header.php'?>

    <!-- Query to fetch the Question -->

    <?php
        $id = $_GET['theradid'];
        $sql = "SELECT * FROM `therads` WHERE therad_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        // Use whille loop for the iteration
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $theard_id = $row['therad_id'];
            $ttile = $row['therad_title'];
            $desc = $row['therad_desc'];
            $post_time = $row['timestamp'];       
    }


    ?>

    <!-- Query to insert the comments -->

    <?php
    
    $method = $_SERVER["REQUEST_METHOD"];

    if($method == 'POST'){

        $th_id = $_GET['theradid'];
        
        $comments = $_POST['comments'];

        $comments = str_replace("<","&lt", $comments);
        $comments = str_replace(">","&gt", $comments);

        // value of userid from usertable
        $userid = $_POST['user_id'];

        $sql = "INSERT INTO `comments` (`comments_content`, `therad_id`, `comments_by`) VALUES ('$comments', ' $th_id','$userid')";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Well done!</strong> Comments has been posted.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Failed to post the comments. Please fill up all the fields properly.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }


    }

    
    ?>

    <!-- Quetion Container -->

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo  $ttile; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is peer to peer forum to sharing knowledge with each other. All the member should follow the rules
                listed below</p>
            <ul>
                <li>No Spam / Advertising / Self-promote in the forums</li>
                <li>Do not post copyright-infringing material.</li>
                <li>Do not post “offensive” posts, links or images</li>
                <li>Do not cross post questions.</li>
                <li>Remain respectful of other members at all times</li>
            </ul>

            <?php 
                 if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                    echo '<p>Posted by : <b>'.$_SESSION['username'].'</b></p>';
                }
            ?>
            
            <!-- <p>Posted by : <b><?php echo $_SESSION['username'];?></b></p> -->
        </div>
    </div>


    <!-- Comments form start here  -->
    <?php 
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

        echo'<div class="container">
        <h1 class="py-2">Post your comments</h1>
        <p>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                Click Me!
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">

                <form action=" '.$_SERVER["REQUEST_URI"].'" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><strong>Type your comments</strong></label>
                        <textarea class="form-control" id="comments" name="comments" rows="3" required></textarea>
                        <input type="hidden" name="user_id" value="'.$_SESSION["user_id"].'">
                    </div>
                    <button type="submit" class="btn btn-success">Post Comment</button>
                </form>

            </div>
        </div>
    </div>';

    }else{
        echo'<div class="container">
        <h2 class="py-2">Post a Comment</h2>
            <div class="jumbotron jumbotron-fluid">
            <div class="container">
           <h1 class="display-4">You are not Logged in.</h1>
             <p class="lead"> Please Login or Signup to post any pomments.</p>
            </div>
            </div>
        </div> ';
    }


    ?>

    <!-- Comments form Ends  -->




    <!--  fetch the   Comments -->
    <div class="container" id="question-container">
        <h1 class="py-2">Comments</h1>

        <?php
        $th_id = $_GET['theradid'];
        $sql = "SELECT * FROM `comments` WHERE therad_id=$th_id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        // Use whille loop for the iteration
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $postTime = $row['time']; 
            $contents = $row['comments_content'];
            $userName = $row['comments_by'];
            $stTime = strtotime($post_time);

            // Query to get the username from users table
            $sqlForUser = "SELECT user_name FROM `users` WHERE user_id='$userName'";
            $getResult = mysqli_query($conn, $sqlForUser);
            $row2 = mysqli_fetch_assoc($getResult);

            echo '<div class="media my-3">
            <img src="img/user.png" class="mr-3" width="34px" alt="...">
            <div class="media-body">
                <p class="font-weight-bold my-0">'.$row2['user_name'].' at '.date('j F Y', $stTime).'</p>
                '.$contents.'
            </div>
        </div>';
       
       
    }

    // Message if there is no comments

    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">No Comments Found</h1>
          <p class="lead">Be the Frist Person by Post a Comment.</p>
        </div>
      </div>';
    }

    ?>

    </div>

    <?php include 'partials/footer.php'?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>
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

    <?php include 'partials/_dbconnect.php' ?>
    <?php include 'partials/header.php' ?>
    <!-- Query to fetch the thead data  -->
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    // Use whille loop for the iteration
    while ($row = mysqli_fetch_assoc($result)) {

        $cate_name = $row['category_name'];
        $cate_desc = $row['category_desc'];
    }

    ?>


    <!-- Query to insert the Therads -->

    <?php
    
    $method = $_SERVER["REQUEST_METHOD"];

    if($method == 'POST'){

        $form_id = $_GET['catid'];
        $form_title = $_POST['title'];
        $form_desc = $_POST['desc'];

        // To protect from XSS Attck
        $form_title = str_replace("<","&lt",$form_title);
        $form_title = str_replace(">","&gt",$form_title);

        $form_desc = str_replace("<","&lt", $form_desc);
        $form_desc = str_replace(">","&gt", $form_desc);

        // value of userid from usertable
        $userid = $_POST['user_id'];

        $sql = "INSERT INTO `therads` (`therad_title`, `therad_desc`, `therad_cate_id`, `therad_user_id`) VALUES ('$form_title', '$form_desc', '$form_id', '$userid')";

        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Well done!</strong> Your therad has been added! wait for the community to the response.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Failed to submit. Please fill up all the fields properly.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }


    }

    
    
    ?>

    <!-- Therads Container Start here  -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $cate_name; ?> Forum</h1>
            <p class="lead"><?php echo $cate_desc; ?></p>
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
            <p>Posted by : <b>ThePlayerHub Community</b></p>
        </div>
    </div>


    <!-- Question  form start here  -->

    <?php  

   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

    echo'<div class="container">
    <h1 class="py-2">Ask your Question here</h1>
        <p>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                Click Me!
            </button>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">

                <form action=" '. $_SERVER["REQUEST_URI"] .'" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><strong>Title</strong></label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                        <small id="emailHelp" class="form-text text-muted">Keep your title as crisp as possible.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><strong>Description</strong></label>
                        <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                        <input type="hidden" name="user_id" value="'.$_SESSION["user_id"].'">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>
        </div>
    </div>';
  }else{
    echo'
    <div class="container">
    <h2 class="py-2">Start a Discussion</h2>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">You are not Logged in.</h1>
            <p class="lead"> Please Login or Signup to start a Discussion.</p>
        </div>
        </div>
    </div>   
    ';
  }

    ?>


    <!-- Question  form Ends -->


    <div class="container" id="question-container">
        <h1 class="py-2">Browse Question</h1>

        <!-- Query to fetch the question  -->

        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `therads` WHERE therad_cate_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        // Use whille loop for the iteration
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $theard_id = $row['therad_id'];
            $theard_user_id = $row['therad_user_id'];
            $ttile = $row['therad_title'];
            $desc = $row['therad_desc'];
            $post_time = $row['timestamp'];
            $stTime = strtotime($post_time);

            // Query to get the username from users table
            $sqlForUser = "SELECT user_name FROM `users` WHERE user_id='$theard_user_id'";
            $getResult = mysqli_query($conn, $sqlForUser);
            $row2 = mysqli_fetch_assoc($getResult);
           
            echo '<div class="media my-3">
            <img src="img/user.png" class="mr-3" width="34px" alt="...">
            <div class="media-body">
                <h5 class="mt-0"><a href="therads.php?theradid='.$theard_id.'">'.$ttile.'</a></h5>
                '.substr($desc, 0, 40) .'...
            </div><p class="font-weight-bold my-0">Asked By: '. $row2['user_name'].' at '.date('j F Y', $stTime).'</p>
        </div>';
       
       
    }

    // Message if the therad list is empty

    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">No Therads Found</h1>
          <p class="lead">Be the Frist Person by Ask a Question.</p>
        </div>
      </div>';
    }

    ?>

    </div>

    <?php include 'partials/footer.php' ?>

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
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
        min-height: 100vh;
    }
    </style>

    <title>ThePlayerHub</title>
</head>

<body>

    <?php include 'partials/_dbconnect.php'?>
    <?php include 'partials/header.php'?>

    <div class="container my-3" id="question-container">
        <h1 class="py-3">Search Result for <em>"<?php echo $_GET['query']?>"</em></h1>

        <?php

        $query = $_GET['query'];
        $noResult = true;
        $sql = "SELECT * FROM `therads` WHERE MATCH (therad_title, therad_desc) AGAINST ('$query')";
        $result = mysqli_query($conn, $sql);
        // Use whille loop for the iteration
        while ($row = mysqli_fetch_assoc($result)) {

            $title = $row['therad_title'];
            $desc = $row['therad_desc'];
            $id = $row['therad_id'];
            $noResult = false;

            echo '<div class="result">
            <h3><a href="therads.php?theradid='.$id.'" class="text-dark">'.$title.'</a></h3>
            <p>'.$desc.'</p>
           </div>';
        }

        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">Your search - <strong>'.$query.'</strong> - did not match any therads</h1>
              <p class="lead">
              Suggestions:
                <ul>
                <li>Make sure that all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Try more general keywords.</li>
                </ul>
              </p>
            </div>
          </div>';
        }

       ?>
    </div>
    <!-- ALTER TABLE therads ADD FULLTEXT(`therad_title`, `therad_desc`); -->
    <!-- ; -->

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
<?php

session_start();

echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/ThePlayerHub">ThePlayerHub</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/ThePlayerHub">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Top Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

      $sql = "SELECT category_name, category_id  FROM `categories` LIMIT 3";
      $result = mysqli_query($conn, $sql);
      while($row= mysqli_fetch_assoc($result)){
          $cate_id= $row['category_id'];
          $cateName= $row['category_name'];
          echo'<a class="dropdown-item" href="theradsList.php?catid='.$cate_id.'">'.$cateName.'</a>';
      }
      echo'</div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="contact.php" tabindex="-1">Contact Us</a>
    </li>
  </ul>
  <div class="row mx-2">';

  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo' <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
      <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
      <p class="text-light my-0 mx-2">Welcome '.$_SESSION['username'].'</p>
      <a  role="button" href="partials/_logout.php" class="btn btn-outline-success ml-2" >Logout</a>
  </form>';
  } else{
    echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get">
        <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <buttton class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</buttton>
        <buttton class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signUpModal">Signup</buttton>
        </div>';

  }
    

echo '</div>
      </nav>';

include 'loginModal.php';
include 'signUpModal.php';

// signup error and suceess alert

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){

  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
     <strong>Here We Go !</strong> Your account has been created . A verfication email has been sent to <b>'. $_SESSION['email'].'</b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

}

if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
  echo '<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
            <strong>Warning !</strong> Password does not matched.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>';
}

if(isset($_GET['existsemail']) && $_GET['existsemail']=="true"){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Warning !</strong> Email is already exists. You can receover your account by clcik the forogt password link in Login page.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>';
}
if(isset($_GET['resetemail']) && $_GET['resetemail']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Well done !</strong> An password receovery link has been sent your e-mail.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>';
}

// Login Error

if(isset($_GET['logginsuccess']) && $_GET['logginsuccess']=="false"){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> Invalid username or pssword.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>';
}

if(isset($_GET['invalid']) && $_GET['invalid']=="true"){

  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> Your account is not active. Chekc your mailbox for activation link.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </div>';

}

?>
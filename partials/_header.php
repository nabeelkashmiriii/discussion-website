<?php 
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand text-success fs-3 fw-bold fst-italic" href="index.php">QDiscuss!</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Catagories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
           
           $sql = "SELECT * FROM `categories` LIMIT 3";
          $result = mysqli_query($conn, $sql);
        // use loop for itterte categories
          while ($row = mysqli_fetch_assoc($result))
          {
            $id = $row['category_id'];
            $tittle = $row['category_tittle'];
            echo '<a class="dropdown-item" href="threadlist.php?id='.$id.'">'.$tittle.'</a>';
          }
          
       echo '</div>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="contact.php" tabindex="-1" >ContactUs</a>
      </li>
    </ul>';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    {
      echo '<form class="d-flex nav-item" action="search.php" method="get" >
      <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      <p class="text-light my-0 mx-2"> Welcome '.$_SESSION['useremail']. '</p>
      <a href="partials/_logout.php" class="btn btn-outline-success mx-2" >LogOut</a>
    </form>';
    
    }
    else
    {
      echo '<form class="d-flex nav-item" action="search.php" method="get" >
      <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
    </form>
    <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">LogIn</button>
    <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
    }

     
   echo '</div>
   </div>
    </nav>';

   include 'partials/_login.php';
   include 'partials/_signup.php';
   if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true")
   {
     echo '<div class="alert alert-success alert-dismissible my-0 fade show" role="alert">
     <strong>Congrats!</strong> Account has been created...
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
   } 
   if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false")
   {
     $error = $_GET['error'];
     echo '<div class="alert alert-danger alert-dismissible my-0 fade show" role="alert">
     <strong>Sorry!</strong> '.$error.'...
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
   }

?>
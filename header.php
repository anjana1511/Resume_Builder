<?php
$directoryURI = $_SERVER['REQUEST_URI'];  // /Resume_Builder/header_single.php
$page = $_SERVER['PHP_SELF'];             // /Resume_Builder/header_single.php
$path = parse_url($directoryURI, PHP_URL_PATH);  ///Resume_Builder/header_single.php

$currentpage = ucwords(str_replace("-"," ",(basename($page,".php")))); //Header_single
$currentdir = ucwords(basename(dirname($page))); //Resume_Builder
$topdir = basename(dirname(dirname($page)));    //Resume_Builder

//echo $currentpage;exit;


$components = explode('/', $path);
$first_part = $components[2];    //header_single.php


 /*if( isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin']) )
  {
    
    $id=$_SESSION["id"];
    $username=$_SESSION["username"];
  } */
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Resume Creation</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body id="page-top">

  <!-- ======= Header/ Navbar ======= -->
  <nav class="navbar navbar-b navbar-trans navbar-expand-md fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll" href="#page-top">Resume Creation</a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll <?php if ($first_part=="index.php") {echo "active"; } else  {echo "noactive";}?>" href="index.php">Home</a>
		  </li>
		  <?php
             if(!(isset($_SESSION['loggedin'])) && empty($_SESSION['loggedin']) )
			 {
		  ?>
          <li class="nav-item">

                        <?php if($currentpage == 'Registration' ) { ?> 
            <a class="nav-link js-scroll" href="index.php#login">Login</a>
          <?php }
            else {
           ?>
                       <a class="nav-link js-scroll" href="#login">Login</a>
         <?php } ?>
          </li>
		  <li class="nav-item">
            <a class="nav-link js-scroll <?php if ($first_part=="Registration.php") {echo "active"; } else  {echo "noactive";}?>" href="Registration.php">Registration</a>
          </li>
			 <?php } if( isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin']) ) {
              $id=$_SESSION["id"];
              $username=$_SESSION["username"];

			 ?>
		  <li class="nav-item">
            <a class="nav-link js-scroll" href="logout.php">Logout</a>
          </li>
		  <?php } ?>
          <li class="nav-item">
            <a class="nav-link js-scroll" href="#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <!-- ======= Intro Section ======= -->
<div id="home" class="intro route bg-image" style="background-image: url(assets/img/bg2.jpg)">
    <div class="overlay-itro"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
          <!--<p class="display-6 color-d">Hello, world!</p>-->
          <h1 class="intro-title mb-4">I am Vasava Anjana</h1>
          <p class="intro-subtitle"><span class="text-slider-items">PHP Developer,Backend Developer,Frontend Developer,Laravel Developer</span><strong class="text-slider"></strong></p>
          <!-- <p class="pt-3"><a class="btn btn-primary btn js-scroll px-4" href="#about" role="button">Learn More</a></p> -->
        </div>
      </div>
    </div>
  </div><!-- End Intro Section -->
    <div class="overlay-itro"></div>
	<body id="page-top">
	
	
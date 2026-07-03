<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$directoryURI = $_SERVER['REQUEST_URI'];  // /Resume_Builder/header_single.php
// $page = $_SERVER['PHP_SELF'];             // /Resume_Builder/header_single.php
$path = parse_url($directoryURI, PHP_URL_PATH);  ///Resume_Builder/header_single.php


// $currentpage = ucwords(str_replace("-"," ",(basename($page,".php")))); //Header_single

$pageName = basename($_SERVER['PHP_SELF'], ".php");
$pageTitle = ucwords(str_replace(["-","_"]," ",$pageName));

// $currentdir = ucwords(basename(dirname($page))); //Resume_Builder
// $topdir = basename(dirname(dirname($page)));    //Resume_Builder

$components = explode('/', $path);
$first_part = $components[2];    //header_single.php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - DevFolio Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo BASE_URL; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="<?php echo BASE_URL; ?>assets/css/main.css" rel="stylesheet">

  <link href="<?php echo BASE_URL; ?>assets/css/style.css" rel="stylesheet">


<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/nicEdit.js"></script>
<script type="text/javascript">
  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

</head>
<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Resume Creation</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
           <?php if(basename($_SERVER['PHP_SELF']) == "index.php") { ?>
          <li><a href="#hero" class="<?php if($first_part=="index.php") echo "active"; ?>">Home<br></a></li>
          <li><a href="#services">Our Services</a></li>
          <li><a href="#portfolio">Designs</a></li>
          <li><a href="#contact">Contact</a></li>
          <?php } else if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
           ?>

          <li><a href="<?php echo BASE_URL; ?>resume/home.php#portfolio">Designs</a></li>
          <li><a href="<?php echo BASE_URL; ?>resume/home.php#contact">Contact</a></li>
          <?php    } 
               else{  ?>
          <li><a href="<?php echo BASE_URL; ?>index.php#services">Our Services</a></li>
          <li><a href="<?php echo BASE_URL; ?>index.php#portfolio">Designs</a></li>
          <li><a href="<?php echo BASE_URL; ?>index.php#contact">Contact</a></li>
          <?php   }       
               if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){ 
            
                          $id=$_SESSION["id"];
                          $username=$_SESSION["username"];
            ?>
                     <li class="dropdown"><a href="#"><span>Create</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>

              <li><a href="<?php echo BASE_URL; ?>resume/create_profile.php">Create Profile</a></li>
              <li><a href="<?php echo BASE_URL; ?>resume/education.php">Education</a></li>
              <li><a href="<?php echo BASE_URL; ?>resume/expirence.php">Expirence</a></li>
              <li><a href="<?php echo BASE_URL; ?>resume/skills.php">Skill & language</a></li>
              <li><a href="<?php echo BASE_URL; ?>resume/summary.php">Summary</a></li>
            </ul>
          </li>
              <li> <a href="<?php echo BASE_URL; ?>Auth/logout.php">Logout</a></li>
          <?php } else { ?>    
          
          <li><a href="<?php echo BASE_URL; ?>Auth/login.php">Login</a></li>
          <?php } ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>
  <main class="main">

  <?php if(basename($_SERVER['PHP_SELF']) == "index.php") { ?>
  <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <img src="assets/img/hero-img.jpg" alt="" data-aos="fade-in">

      <div class="container d-flex flex-column align-items-center justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
        <h2>Create Your Professional Resume</h2>
        <p><span class="typed" data-typed-items="Easy Resume Builder,Modern Resume Templates,Create Resume in Minutes,Download Resume PDF,Professional CV Maker"></span></p>
      </div>

    </section>
    <!-- /Hero Section -->
<?php } else {  ?>
        <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0"><?php if ($pageTitle == "Home") { echo "Welcome To Our Site";} else { echo $pageTitle; } ?></h1>
        <nav class="breadcrumbs">
          <ol>
            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){ 
            ?>
            <li><a href="<?php echo BASE_URL; ?>home.php">Dashboard</a></li>
            <li class="current"><?php if ($pageTitle == "Home") { echo ""; } else { echo $pageTitle; } ?></li>
           <?php } else {?>
            <li><a href="<?php echo BASE_URL; ?>index.php">Dashboard</a></li>
            <li class="current"><?php if ($pageTitle == "Home") { echo ""; } else { echo $pageTitle; } ?></li>
           <?php } ?>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->
    <?php } ?>
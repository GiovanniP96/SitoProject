<?php 
include 'config.php';
?>

<!-- header file -->

<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>FeedBack</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/plugins/bootstrap/bootstrap.min.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="assets/plugins/themify-icons/themify-icons.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="assets/plugins/slick/slick.css">
  <!-- venobox popup -->
  <link rel="stylesheet" href="assets/plugins/Venobox/venobox.css">
  <!-- aos -->
  <link rel="stylesheet" href="assets/plugins/aos/aos.css">

  <!-- Main Stylesheet -->
  <link href="assets/css/style.css" rel="stylesheet">
  
  <!--Favicon-->
  <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

</head>

<body>
  

<!-- navigation -->
<section class="fixed-top navigation">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand" href="index.php">
        <h4>Azienda</h4>
      </a>
      <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- navbar -->
      <div class="collapse navbar-collapse text-center" id="navbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="quiz.php">Quiz</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="feedback.php">Feedback</a>
          </li>
          
        
        </ul>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a class="nav-link page-scroll tn btn-primary ml-lg-3 primary-shadow" href="logout.php">Logout</a>
          <?php elseif(!isset($_SESSION['user_id'])): ?>
            <!-- <a class="btn btn-primary ml-lg-3 primary-shadow" href="register.php">Register</a> -->
            <a class=" btn btn-primary ml-lg-3 primary-shadow" href="login.php">Login</a>
          <?php endif; ?>
        <!-- <a href="feedback.php" class="btn btn-primary ml-lg-3 primary-shadow">Feedback</a> -->
      </div>
    </nav>
  </div>
</section>
<!-- /navigation -->
<section id="over_flow">
<!-- hero area -->
<section class="hero-section hero" data-background="" style="background-image: url(assets/images/hero-area/banner-bg.png);">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center zindex-1">
        <h1 class="mb-3">Corso di Formazione sulla
          Valutazione del Rischio
        </h1>
        <p class="mb-4">Forma il tuo team su tutti i temi normativi, porta in azienda 
          la cultura della sicurezza e assolvi agli obblighi di legge</p>
          <!-- PDF /pdf folder  -->
        <a href="assets/pdf/Valutazione_del_rischio.pdf" class="btn btn-secondary btn-lg" download>Download PDF</a>
        <!-- banner image -->
        <img class="img-fluid w-100 banner-image" src="assets/images/hero-img.png" alt="banner-img">
      </div>
    </div>
  </div>
  <!-- background shapes -->
  <div id="scene">
    <img class="img-fluid hero-bg-1 up-down-animation" src="assets/images/background-shape/feature-bg-2.png" alt="">
    <img class="img-fluid hero-bg-2 left-right-animation" src="assets/images/background-shape/seo-ball-1.png" alt="">
    <img class="img-fluid hero-bg-3 left-right-animation" src="assets/images/background-shape/seo-half-cycle.png" alt="">
    <img class="img-fluid hero-bg-4 up-down-animation" src="assets/images/background-shape/green-dot.png" alt="">
    <img class="img-fluid hero-bg-5 left-right-animation" src="assets/images/background-shape/blue-half-cycle.png" alt="">
    <img class="img-fluid hero-bg-6 up-down-animation" src="assets/images/background-shape/seo-ball-1.png" alt="">
    <img class="img-fluid hero-bg-7 left-right-animation" src="assets/images/background-shape/yellow-triangle.png" alt="">
    <img class="img-fluid hero-bg-8 up-down-animation" src="assets/images/background-shape/service-half-cycle.png" alt="">
    <img class="img-fluid hero-bg-9 up-down-animation" src="assets/images/background-shape/team-bg-triangle.png" alt="">
  </div>
</section>
<!-- /hero-area -->
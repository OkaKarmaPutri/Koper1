<!DOCTYPE html>
<html lang="en">
<head>
<title>Realestate Bootstrap Theme </title>
<meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="assets/style.css"/>
  



<!-- Owl stylesheet -->
<link rel="stylesheet" href="assets/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="assets/owl-carousel/owl.theme.css">

<!-- Owl stylesheet -->


<!-- slitslider -->
    <link rel="stylesheet" type="text/css" href="assets/slitslider/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/slitslider/css/custom.css" />
    
<!-- slitslider -->

<style type="text/css">
  #login-form-link, #register-form-link{
    background-color: white;
    border: 2px solid #72b70f;
    color: black; 
    padding: 16px 64px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
  }

  #login-form-link:hover, #register-form-link:hover{
    background-color: #72b70f;
    color: white;
  }

  body{background:#eee;font-family:Verdana, Helvetica, Arial, sans-serif;margin:0;padding:0}
.example{background:#FFF;width:1000px;font-size:80%;border:1px #000 solid;margin:0.5em 10% 0.5em;padding:1em 2em 2em;-moz-border-radius:3px;-webkit-border-radius:3px}
#content p{text-indent:20px;text-align:justify;}
#pagingControls ul{display:inline;padding-left:0.5em}
#pagingControls li{display:inline;padding:0 0.5em}
</style>
</head>

<body>

<?php 
  include '../database/koneksi.php';
  $page = 'home';

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }
?>

<!-- Header Starts -->
<div class="navbar-wrapper">

        <div class="navbar-inverse" role="navigation">
          <div class="container">
            <div class="navbar-header">


              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

            </div>


            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
              <ul class="nav navbar-nav navbar-right">
               <li class="active"><a href="index.php">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="#" id="login">Login</a></li>
                <li><a href="">register</a></li>
              </ul>
            </div>
            <!-- #Nav Ends -->

          </div>
        </div>

    </div>
<!-- #Header Starts -->

<div class="container">

<!-- Header Starts -->
<div class="header" style="padding: 1%">
<a href="index.php"><img src="images/logo.jpg" width="18%" alt="Realestate"></a>

              <ul class="pull-right">
                <li><a href="index.php?page=property">Rumah</a></li>
                <li><a href="index.php?page=property">Kos</a></li>
              </ul>
</div>
<!-- #Header Starts -->
</div>

<?php
  if($page == 'home'){
    include 'pages/home.php';
  }
  elseif($page == 'property'){
    include 'pages/buysalerent.php';
  }
?>

<div class="footer">

<div class="container">



<div class="row">
            <div class="col-lg-3 col-sm-3">
                   <h4>Information</h4>
                   <ul class="row">
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about.php">About</a></li>
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="agents.php">Agents</a></li>         
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="blog.php">Blog</a></li>
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="contact.php">Contact</a></li>
              </ul>
            </div>
            
            <div class="col-lg-3 col-sm-3">
                    <h4>Newsletter</h4>
                    <p>Get notified about the latest properties in our marketplace.</p>
                    <form class="form-inline" role="form">
                            <input type="text" placeholder="Enter Your email address" class="form-control">
                                <button class="btn btn-success" type="button">Notify Me!</button></form>
            </div>
            
            <div class="col-lg-3 col-sm-3">
                    <h4>Follow us</h4>
                    <a href="#"><img src="images/facebook.png" alt="facebook"></a>
                    <a href="#"><img src="images/twitter.png" alt="twitter"></a>
                    <a href="#"><img src="images/linkedin.png" alt="linkedin"></a>
                    <a href="#"><img src="images/instagram.png" alt="instagram"></a>
            </div>

             <div class="col-lg-3 col-sm-3">
                    <h4>Contact us</h4>
                    <p><b>Bootstrap Realestate Inc.</b><br>
<span class="glyphicon glyphicon-map-marker"></span> 8290 Walk Street, Australia <br>
<span class="glyphicon glyphicon-envelope"></span> hello@bootstrapreal.com<br>
<span class="glyphicon glyphicon-earphone"></span> (123) 456-7890</p>
            </div>
        </div>
<p class="copyright">Copyright 2013. All rights reserved. </p>

</div></div>

<!-- Modal -->
<div id="loginpop" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="panel-heading">
        <div class="row">
          <ul class="menu">
            <div class="col-xs-6">
              <a href="#" id="login-form-link">Login</a>
            </div>
            <div class="col-xs-6">
              <a href="#" id="register-form-link">Register</a>
            </div>
          </ul>
        </div>
          <hr>
      </div>
      <div class="row">
        <div class="col-sm-12 login">
          <form class="" id="login-form" role="form" style="display: block">
            <div class="form-group">
              <label class="sr-only"></label>
              <input type="email" class="form-control" name="us" placeholder="Username or Email">
            </div>
            <div class="form-group">
              <label class="sr-only">Password</label>
              <input type="password" class="form-control" name="pass" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>   
          </form>
          <form class="" id="register-form" role="form" style="display: none">
            <div class="form-group">
              <label class="sr-only">Username</label>
              <input type="email" class="form-control" name="us" placeholder="Username">
            </div>
            <div class="form-group">
              <label class="sr-only">Email address</label>
              <input type="email" class="form-control" name="em" placeholder="Email Address">
            </div>
            <div class="form-group">
              <label class="sr-only">Password</label>
              <input type="password" class="form-control" name="pass" placeholder="Password">
            </div>
            <div class="form-group">
              <label class="sr-only">Confirm Password</label>
              <input type="password" class="form-control" name="cpass" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-success">Register</button>   
          </form>       
            
        </div>

      </div>
    </div>
  </div>
</div>
<!-- /.modal -->

</body>
  <script src="js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.js"></script>
  <script src="assets/script.js"></script>
  <script src="assets/owl-carousel/owl.carousel.js"></script>
  <script type="text/javascript" src="assets/slitslider/js/modernizr.custom.79639.js"></script>
  <script type="text/javascript" src="assets/slitslider/js/jquery.ba-cond.min.js"></script>
  <script type="text/javascript" src="assets/slitslider/js/jquery.slitslider.js"></script>
  <script type="text/javascript" src="js/pagination.js"></script>

<script type="text/javascript">
  function login1(){
    alert("tes");
  }

  $("#login").click(function(){
    $("#loginpop").modal('show');
  })

  $('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });

  var pager = new Imtech.Pager();
  $(document).ready(function() {
      pager.paragraphsPerPage = 5; // set amount elements per page
      pager.pagingContainer = $('#content'); // set of main container
      pager.paragraphs = $('div.z', pager.pagingContainer); // set of required containers
      pager.showPage(1);
  });



</script>
</html>
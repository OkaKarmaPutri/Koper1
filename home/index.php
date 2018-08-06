<?php 
  session_start();
  include '../database/koneksi.php';

  if(!isset($_SESSION['koper']))
    $page = 'home';

  if(isset($_POST['signin'])){
    $us = $_POST['us'];
    $ps = md5($_POST['pass']);

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE USERNAME = '$us' AND PASSWORD = '$ps'") or die(mysqli_error($koneksi));
    $cek = mysqli_num_rows($query);

    if($cek > 0){
      $data = mysqli_fetch_array($query);
      $nama = $data['nama'];

      $_SESSION['koper']['us'] = $us;
      $_SESSION['koper']['nama'] = $nama;
    }
  }

  if(isset($_POST['register'])){
    $us     = $_POST['us'];
    $nm     = $_POST['nm'];
    $em     = $_POST['em'];
    $hp     = $_POST['hp'];
    $pass   = $_POST['pass'];
    $cpass  = $_POST['cpass'];

    // $query = mysqli_query($koneksi, "SELECT ")
  }

  $page = 'home';

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Koper</title>
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

  #pagingControls a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
  }

  #pagingControls a.active {
    background-color: #4CAF50;
    color: white;
  }

  #pagingControls a:hover:not(.active) {
    background-color: #ddd;}
  }

  #pagingControls ul li:hover:not(.active) {
    background-color: #ddd;
  }
</style>
</head>

<body>

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
               <li><a href="index.php">Home</a></li>
                <li><a href="index.php?page=kontak">Contact</a></li>
                <?php 
                if(isset($_SESSION['koper'])){
                  ?>
                  <li><a href="#"><?php echo $_SESSION['koper']['nama'] ?></a></li>
                  <li><a href="aksi/aksi_logout.php">Logout</a></li>
                  <?php
                }
                else{
                  ?>
                  <li><a href="#" id="login">Login</a></li>
                  <?php
                }
                ?>
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
                <li><a href="?page=property&tipe=Rumah">Rumah</a></li>
                <li><a href="?page=property&tipe=Kos">Kos</a></li>
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
  elseif($page == 'detail')
    include 'pages/property-detail.php';
  else if($page == 'kontak')
    include 'page/contact.php';
?>

<div class="footer">

<div class="container">



<div class="row">
            <div class="col-lg-3 col-sm-3">
                   <h4>Information</h4>
                   <ul class="row">
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about.php">About</a></li>
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
          <form class="" id="login-form" method="post" role="form" style="display: block">
            <div class="form-group">
              <label class="sr-only"></label>
              <input type="text" class="form-control" name="us" required placeholder="Username or Email">
            </div>
            <div class="form-group">
              <label class="sr-only">Password</label>
              <input type="password" class="form-control" required name="pass" placeholder="Password">
            </div>
            <button type="submit" name="signin" class="btn btn-success">Sign in</button>   
          </form>
          <form class="" id="register-form" role="form" style="display: none" method="post" action="">
            <div class="form-group">
              <label class="sr-only">Username</label>
              <input type="email" class="form-control" name="us" placeholder="Username">
            </div>
            <div class="form-group">
              <label class="sr-only"></label>
              <input type="text" class="form-control" name="nm" required placeholder="Nama">
            </div>
            <div class="form-group">
              <label class="sr-only">Email address</label>
              <input type="email" class="form-control" name="em" placeholder="Email Address">
            </div>
            <div class="form-group">
              <label style="padding-top: 12px; padding-left: 10px">+62</label>
              <input type="number" class="form-control pull-right" name="hp" placeholder="Nomor HP" style="width: 90%">
            </div>
            <div class="form-group">
              <label class="sr-only">Password</label>
              <input type="password" class="form-control" name="pass" placeholder="Password">
            </div>
            <div class="form-group">
              <label class="sr-only">Confirm Password</label>
              <input type="password" class="form-control" name="cpass" placeholder="Confirm Password">
            </div>
            <button type="submit" name="register" class="btn btn-success">Register</button>   
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
      pager.paragraphsPerPage = 10; // set amount elements per page
      pager.pagingContainer = $('#content'); // set of main container
      pager.paragraphs = $('div.z', pager.pagingContainer); // set of required containers
      pager.showPage(1);
  });

  var id = '';

  <?php 
    if(isset($_GET['id'])){
      ?>
      var id = <?php echo $_GET['id'] ?>;
      <?php
      $id = $_GET['id'];
      $query = mysqli_query($koneksi, "SELECT * from properti where ID = $id") or die(mysqli_error($koneksi));

      $a = mysqli_fetch_assoc($query);
      ?>
      var lat = <?php echo $a['LAT'] ?>, lon = <?php echo $a['LON'] ?>, tipe = "<?php echo $a['TIPE'] ?>";

      if(tipe == 'Rumah')
        var label = 'R'
      else
        var label = 'K'
      <?php
    }
    else{
      ?>
      var data = [], i = 0;
      <?php
      $query = mysqli_query($koneksi, "SELECT * from properti") or die(mysqli_error($koneksi));

      while($a = mysqli_fetch_assoc($query)){
        ?>
        var lat1 = <?php echo $a['LAT'] ?>, lon1 = <?php echo $a['LON'] ?>, content = "<a href='index.php?page=detail&id=<?php echo $a['ID'] ?>'><h6><?php echo $a['NAMA_PROPERTI']; ?></h6></a>";
        if("<?php echo $a['TIPE'] ?>" == 'Rumah')
          var label = 'R'
        else
          var label = 'K';
        data[i] = [
          {
            coords : {lat : lat1, lng : lon1},
            label : label,
            content : content
          }
        ];
        i++
        <?php
      }
    }
  ?>

  function initMap(){

    console.log(id)

    if(id != ''){
      var options = {
        zoom  : 11,
        center  : {
          lat: lat,
          lng: lon
        }
      }

      var map = new google.maps.Map(document.getElementById('map'), options);

      // var marker = new google.maps.Marker({
      //   position : {
      //     lat: lat,
      //     lng: lon
      //   },
      //   map : map,
      //   label : 'K'
      // })

      addMarker({
        coords  : {lat : lat, lng : lon},
        label   : label
      });

      function addMarker(props){
        var marker = new google.maps.Marker({
          position : props.coords,
          map : map,
          label : props.label
        })
      }
    }
    else{
      var options_semua_properti = {
        zoom  : 12,
        center  : {
          lat: -5.1114743,
          lng: 119.4625408
        }
      }

      var map_semua_properti = new google.maps.Map(document.getElementById('semua_properti'), options_semua_properti);
      // alert(JSON.stringify(data))

      for(var i = 0; i < data.length; i++){
        addMarkerSemuaProperti(data[i][0])
      }

      function addMarkerSemuaProperti(props){
        // console.log(props.lat);
        var marker = new google.maps.Marker({
          position : props.coords,
          map : map_semua_properti,
          label : props.label
        })

        var infoWindow = new google.maps.InfoWindow({
          content : props.content
        });

        marker.addListener('click', function(){
          infoWindow.open(map_semua_properti, marker);
        });
      }
    }    
  }

</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD201zgl1ql28BZMqs0lG9Scz0lnV4Fx7Y&callback=initMap">
</script>
</html>
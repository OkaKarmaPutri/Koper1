<!-- banner -->
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="#">Home</a> / Detail</span>
    <h2>Detail Properti</h2>
</div>
</div>
<!-- banner -->


<div class="container">
<div class="properties-listing spacer">

<div class="row">
<div class="col-lg-3 col-sm-4 hidden-xs">

<div class="hot-properties hidden-xs">
<h4>Hot Properties</h4>
<?php 
          $query = mysqli_query($koneksi, "SELECT * from properti limit 5") or die(mysqli_error($koneksi));

          while($a = mysqli_fetch_assoc($query)){
            $query1 = mysqli_query($koneksi, "SELECT gambar from gmbr_properti where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
            $b = mysqli_fetch_row($query1);
            ?>
            <div class="row">
              <div class="col-lg-4 col-sm-5"><img src="../images/<?php echo $a['ID_USERNAME']."/".$b[0]; ?>" class="img-responsive img-circle" alt="properties"></div>
              <div class="col-lg-8 col-sm-7">
                <h5><a href="index.php?page=detail&id=<?php echo $a['ID'] ?>"><?php echo $a['NAMA_PROPERTI'] ?></a></h5>
                <?php 
                          $query1 = mysqli_query($koneksi, "SELECT * from tb_harga where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
                          $i = 0;
                          while($b = mysqli_fetch_assoc($query1)){
                            ?>
                            <p class="price"><?php echo "Rp".number_format($b['harga'], 0, ',', '.').' '.$b['tipe_harga']; ?></p>
                            <?php
                            $i++;
                          }
                        ?>
              </div>
            </div>
            <?php
          }
        ?>

</div>

</div>

<div class="col-lg-9 col-sm-8 ">

<?php 
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * from properti where ID = $id") or die(mysqli_error($koneksi));

    $a = mysqli_fetch_assoc($query);
    ?>
    <h2><?php echo $a['NAMA_PROPERTI'] ?></h2>
    <?php
  }
?>

<div class="row">
  <div class="col-lg-8">
  <div class="property-images">
    <!-- Slider Starts -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators hidden-xs">
        <?php 
          if(isset($_GET['id'])){            
            $query1 = mysqli_query($koneksi, "SELECT gambar from gmbr_properti where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
            $jumlah = mysqli_num_rows($query1);
            $count = 0;
            for($i = 0; $i < $jumlah; $i++){
              ?>
              <li data-target="#myCarousel" data-slide-to="<?php echo $i ?>" class="<?php if($count == 0) {echo 'active'; $count++;} ?>"></li>
              <?php
            }
          }          
        ?>
      </ol>
      <div class="carousel-inner">
        <?php           
          $count = 0;
          while($b = mysqli_fetch_row($query1)){
            ?>
            <!-- Item 1 -->
            <div class="item <?php if($count == 0) {echo 'active'; $count++;} ?>">
              <img src="../images/<?php echo $a['ID_USERNAME']."/".$b[0]; ?>" class="properties" alt="properties" style="height: 358px; display: block; margin-left: auto; margin-right: auto"/>
            </div>
            <!-- #Item 1 -->
            <?php
          }
        ?>
        
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
<!-- #Slider Ends -->

  </div>
  



  <div class="spacer">

  </div>
  <div><h4><span class="glyphicon glyphicon-map-marker"></span> Location</h4>
<div class="well">
  <div id="map" style="width: 515px;height: 370px;"></div>
</div>
  </div>

  </div>
  <div class="col-lg-4">
  <div class="col-lg-12  col-sm-6">
<div class="property-info">
  <?php 
                          $query1 = mysqli_query($koneksi, "SELECT * from tb_harga where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
                          $i = 0;
                          while($b = mysqli_fetch_assoc($query1)){
                            ?>
                            <p class="price" style="font-size: 20px"><?php echo "Rp".number_format($b['harga'], 0, ',', '.').' '.$b['tipe_harga']; ?></p>
                            <?php
                            $i++;
                          }
                        ?>
  <p class="area"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $a['ALAMAT'] ?></p>
</div>

    <h6><span class="glyphicon glyphicon-home"></span> Availabilty</h6>
    <div class="listing-detail">
      <?php 
                            $query1 = mysqli_query($koneksi, "SELECT * from detail_fasilitas where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
                            while($b = mysqli_fetch_assoc($query1)){
                              ?>
                              <span data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $b['fasilitas'] ?>"><?php echo $b['jum_fasilitas'] ?></span>
                              <?php
                            }
                          ?>
    </div>

</div>
<div class="col-lg-12 col-sm-6 ">
<div class="enquiry">
  <h6><span class="glyphicon glyphicon-envelope"></span> Post Enquiry</h6>
  <form role="form">
                <input type="text" class="form-control" placeholder="Full Name"/>
                <input type="text" class="form-control" placeholder="you@yourdomain.com"/>
                <input type="text" class="form-control" placeholder="your number"/>
                <textarea rows="6" class="form-control" placeholder="Whats on your mind?"></textarea>
      <button type="submit" class="btn btn-primary" name="Submit">Send Message</button>
      </form>
 </div>         
</div>
  </div>
</div>
</div>
</div>
</div>
</div>
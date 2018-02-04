<div class="">
    

            <div id="slider" class="sl-slider-wrapper">

        <div class="sl-slider">

          <?php 
            $query = mysqli_query($koneksi, "SELECT * from properti limit 5") or die(mysqli_error($koneksi));

            while($a = mysqli_fetch_assoc($query)){
              $query1 = mysqli_query($koneksi, "SELECT gambar from gmbr_properti where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
              $b = mysqli_fetch_row($query1);
              ?>

              <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1">
                <div class="sl-slide-inner">
                  <div class="bg-img" style="background-image: url(../images/<?php echo $a['ID_USERNAME']."/".$b[0]; ?>)"></div>
                  <h2><a href="index.php?page=detail&id=<?php echo $a['ID'] ?>"><?php echo $a['NAMA_PROPERTI'] ?></a></h2>
                  <blockquote>              
                  <p class="location"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $a['ALAMAT'] ?></p>
                  <?php 
                    $query1 = mysqli_query($koneksi, "SELECT * from tb_harga where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));

                    while($b = mysqli_fetch_assoc($query1)){
                      ?>
                      <cite><?php echo "Rp ".number_format($b['harga'], 0, ',', '.').' '.$b['tipe_harga']; ?></cite><br><br>
                      <?php
                    }
                  ?>
                  </blockquote>
                </div>
              </div>

              <?php
            }
          ?>
        </div><!-- /sl-slider -->



        <nav id="nav-dots" class="nav-dots">
          <span class="nav-dot-current"></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </nav>

      </div><!-- /slider-wrapper -->
</div>



<div class="banner-search">
  <div class="container"> 
    <!-- banner -->
    <h3>Rent</h3>
    <div class="searchbar">
      <div class="row">
        <div class="col-lg-6 col-sm-6">
          <form action="index.php">
            <input type="hidden" name="page" value="property">
            <input name="data" type="text" class="form-control" placeholder="Search of Properties">
            <div class="row">
              <div class="col-lg-3 col-sm-4">
                <select name="harga" class="form-control">
                  <option>Price</option>
                  <option value="1">Rp100.000 - Rp1.000.000</option>
                  <option value="2">Rp1.000.000 - Rp10.000.000</option>
                  <option value="3">Rp10.000.000 - above</option>
                </select>
              </div>
              <div class="col-lg-3 col-sm-4">
              <select name="tipe" class="form-control">
                  <option>Properti</option>
                  <option>Rumah</option>
                  <option>Kos</option>
                </select>
                </div>
                <div class="col-lg-3 col-sm-4">
                <button class="btn btn-success" type="submit">Find Now</button>
                </div>
            </div>
          </form>         
        </div>
      </div>
    </div>
  </div>
</div>

<!-- google maps -->
<div class="container">
  <div class="spacer">
    
  </div>
  <div><h4><span class="glyphicon glyphicon-map-marker"></span> Location</h4>
<div class="well">
  <div id="semua_properti" style="width: 100%;height: 550px;"></div>
</div>
  </div>
</div>


<!-- banner -->
<div class="container">
  <div class="properties-listing spacer"> <a href="index.php?page=property" class="pull-right viewall">View All Listing</a>
    <h2>Featured Properties</h2>
    <div id="owl-example" class="owl-carousel">
      <?php 
        $query = mysqli_query($koneksi, "SELECT * from properti limit 5, 15") or die(mysqli_error($koneksi));

        while($a = mysqli_fetch_assoc($query)){
          $query1 = mysqli_query($koneksi, "SELECT gambar from gmbr_properti where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
          $b = mysqli_fetch_row($query1);
          ?>
          <div class="properties">
            <div class="image-holder"><img src="../images/<?php echo $a['ID_USERNAME'].'/'.$b[0] ?>" class="img-responsive" alt="properties" style="height: 128px"/>
              <div class="status sold">Sold</div>
            </div>
            <h4><a href="property-detail.php"><?php echo $a['NAMA_PROPERTI'] ?></a></h4>
            <p class="price">Tipe : <?php echo $a['TIPE'] ?></p>
                        <?php 
                          $query1 = mysqli_query($koneksi, "SELECT * from tb_harga where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
                          $i = 0;
                          while($b = mysqli_fetch_assoc($query1)){
                            ?>
                            <p class="price">Price: <?php echo "Rp".number_format($b['harga'], 0, ',', '.').' '.$b['tipe_harga']; ?></p>
                            <?php
                            $i++;
                          }
                          if($i < 3){
                            for($i; $i < 3; $i++){
                              ?>
                              <p class="price">Price: -</p>
                              <?php
                            }
                          }
                        ?>
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
            <a class="btn btn-primary" href="index.php?page=detail&id=<?php echo $a['ID'] ?>">View Details</a>
          </div>
          <?php
        }
      ?>      
    </div>
  </div>
  <div class="spacer">
    <div class="row">
      <div class="col-lg-12 col-sm-9 recent-view">
        <h3>About Us</h3>
        <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br><a href="about.php">Learn More</a></p>
      
      </div>
    </div>
  </div>
</div>
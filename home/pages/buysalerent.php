<!-- banner -->
<div class="inside-banner">
  <div class="container"> 
    <span class="pull-right"><a href="index.php">Home</a> / Properti</span>
    <h2>Properti</h2>
  </div>
</div>
<!-- banner -->


<div class="container">
  <div class="properties-listing spacer">

    <div class="row">
      <div class="col-lg-3 col-sm-4 ">

        <form action="index.php">
          <input type="hidden" name="page" value="property">
          <div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
            <input type="text" name="data" class="form-control" placeholder="Search of Properties">
            <div class="row">
              <div class="col-lg-6">
                <select name="tipe" class="form-control">
                    <option>Properti</option>
                    <option>Rumah</option>
                    <option>Kos</option>
                  </select>
              </div>
              <div class="col-lg-6">
                <select name="harga" class="form-control">
                    <option>Price</option>
                    <option value="1">Rp100.000 - Rp1.000.000</option>
                    <option value="2">Rp1.000.000 - Rp10.000.000</option>
                    <option value="3">Rp10.000.000 - above</option>
                  </select>
              </div>
            </div>
            <button class="btn btn-primary">Find Now</button>
          </div>
        </form>

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

      <?php 
        $base_url = $_SERVER['REQUEST_URI'];

              $hal = 0;
              $where = '';

              if(isset($_GET['hal'])){
                $hal = $_GET['hal'] - 1;
                $tes = explode('&hal', $base_url);
                $base_url = $tes[0];
              }

              if(isset($_GET['tipe']) || isset($_GET['harga']) || isset($_GET['data'])){
                $result = 0;
                $where = 'where ';
                if(isset($_GET['tipe'])){
                  if($_GET['tipe'] != 'Properti'){
                    $where .= "(TIPE = '$_GET[tipe]')";
                    $result++;
                  }
                }

                if(isset($_GET['harga'])){
                  $harga = $_GET['harga'];
                  $where_harga = '';
                  if($harga != 'Price'){
                    if($result == 1)
                      $where .= ' and ';
                    if($harga == 1){
                      $where_harga = 'where harga between 100000 and 1000000';
                      $result++;
                    }
                    else if($harga == 2){
                      $where_harga = 'where harga between 1000000 and 10000000';
                      $result++;
                    }
                    else if($harga == 3){
                      $where_harga = 'where harga >= 20000000';
                      $result++;
                    }

                    $query1 = mysqli_query($koneksi, "SELECT id_properti from tb_harga $where_harga") or die(mysqli_error($koneksi));
                    $where .= '(';
                    while($a = mysqli_fetch_assoc($query1)){
                      $where .= 'ID = '.$a['id_properti'].' or ';
                    }
                    if($harga != 3)
                      $where = substr($where, 0, -4);
                    $where .= ')';
                    $cek_id_harga = explode('ID', $where);
                    if(!isset($cek_id_harga[1])){
                      if($result == 1)
                        $where = 'where ID = 0';
                      else
                        $where = substr($where, 0, -7);
                    }
                  }
                }

                if(isset($_GET['data'])){
                  $like = $_GET['data'];
                  if($result > 0)
                    $where .= ' and ';
                  $where .= "(NAMA_PROPERTI LIKE '%".$like."%' or ALAMAT LIKE '%".$like."%')";
                  $result++;
                }

                if($result == 0)
                  $where = '';
              }

              
                
              $limit = $hal * 10;
              $query = mysqli_query($koneksi, "SELECT * from properti $where limit $limit, 9") or die(mysqli_error($koneksi));

              $query1 = mysqli_query($koneksi, "SELECT * from properti $where") or die(mysqli_error($koneksi));

              $jumlah = mysqli_num_rows($query);
              $jumlah1 = mysqli_num_rows($query1);
      ?>

      <div class="col-lg-9 col-sm-8">
        <div class="sortby clearfix">
        <div class="pull-left result">Showing: <?php echo $jumlah ?> of <?php echo $jumlah1 ?></div>
        <!-- <div class="pull-right">
          <select class="form-control">
            <option>Sort by</option>
            <option>Price: Low to High</option>
            <option>Price: High to Low</option>
          </select>
        </div> -->

        </div>
        <div class="row">
            <?php 
              while($a = mysqli_fetch_array($query, MYSQLI_ASSOC)){
                ?>
                        <!-- properties -->
                    <div class="col-lg-4 col-sm-6">
                      <div class="properties">
                        <?php 
                          $query1 = mysqli_query($koneksi, "SELECT gambar from gmbr_properti where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
                          $b = mysqli_fetch_row($query1)
                        ?>

                        <div class="image-holder"><center><img src="../images/<?php echo $a['ID_USERNAME'].'/'.$b[0] ?>" class="img-responsive" alt="properties" style="height: 157px"></center>
                                                
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
                    </div>
                    <!-- properties -->
                <?php
              }
            ?>

        </div>
        <div class="center">
          <ul class="pagination">
            <li><a href="#">«</a></li>
            <?php 
              $query = mysqli_query($koneksi, "SELECT count(*) from properti limit $limit, 9") or die(mysqli_error($koneksi));

              $a = mysqli_fetch_row($query);
              for($i = 0; $i < $a[0]/10; $i++){
                $j = $i + 1
                ?>
                <li class="<?php if($hal == $i) echo 'active' ?>"><a href="<?php echo $base_url.'&hal='.$j; ?>"><?php echo $j ?></a></li>
                <?php
              }
            ?>
            <li><a href="#">»</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
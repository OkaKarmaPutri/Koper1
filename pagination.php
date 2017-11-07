<html>
   
   <head>
      <title>Paging Using PHP</title>
   </head>
   
   <body>
      <?php
         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = '';
         
         $rec_limit = 10;
         $conn = mysql_connect($dbhost, $dbuser, $dbpass);
         
         if(!$conn ) {
            die('Could not connect: ' . mysql_error());
         }
         mysql_select_db('rapat');
         ?>

         <table border="1">
  <tr>
    <th>No</th>
    <th>Nama</th>                         
  </tr>
  <?php 
  $halaman = 10;
  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  $result = mysql_query("SELECT * FROM jabatan");
  $total = mysql_num_rows($result);
  $pages = ceil($total/$halaman);            
  $query = mysql_query("select * from jabatan LIMIT $mulai, $halaman")or die(mysql_error);
  $no =$mulai+1;
 
 
  while ($data = mysql_fetch_assoc($query)) {
    ?>
    <tr>
      <td><?php echo $no++; ?></td>                  
      <td><?php echo $data['jabatan']; ?></td>              
                  
    </tr>
 
    <?php               
  } 
  ?>
  
 
</table>          
 
<div class="">
  <?php for ($i=1; $i<=$pages ; $i++){ ?>
  <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
 
  <?php } ?>
 
</div>
   </body>
</html>
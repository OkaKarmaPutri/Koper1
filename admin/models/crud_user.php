<?php 
	include '../../database/koneksi.php';

	$crud = $_POST['crud'];
	$table = $_POST['table'];

	if($crud == 'select'){
		$query = mysqli_query($koneksi, "SELECT * from $table") or die(mysqli_error($koneksi));

		$data = array();

		while($a = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$data[count($data)] = array(
				'id'		=> $a['ID'],
				'username'	=> $a['USERNAME'],
				'nama'		=> $a['nama'],
				'role'		=> $a['ROLE'],
				'gambar'	=> $a['GAMBAR'],
				'email'		=> $a['EMAIL'],
				'hp'		=> $a['no_hp']
				);
		}
		echo json_encode($data);
	}

	else if($crud == 'insert'){
		$hp = $_POST['hp'];
		$nama = $_POST['nama'];
		$us = $_POST['us'];
		$em = $_POST['em'];
		$ps = md5($_POST['ps']);
		if(!empty($ft_name = $_FILES['ft']['name'])){
			$ft_tipe = $_FILES["ft"]["type"];
			$allowedExts = array("jpeg", "jpg", "png", "JPEG", 'JPG', 'PNG');
			$temp = explode(".", $ft_name);
			$extension = end($temp);
			if ((($ft_tipe == "image/jpeg")
			|| ($ft_tipe == "image/jpg")
			|| ($ft_tipe == "image/pjpeg")
			|| ($ft_tipe == "image/x-png")
			|| ($ft_tipe == "image/png"))
			&& in_array($extension, $allowedExts)){
				if ($_FILES["ft"]["error"] > 0) {
			        echo "Return Code: " . $_FILES["ft"]["error"] . "<br>";
			    }
			    else {
			    	$query = mysqli_query($koneksi, "SELECT AUTO_INCREMENT 
						FROM information_schema.tables
						WHERE table_name = 'user'
						and table_schema = 'koper'") or die(mysqli_error($koneksi));
					$ai = mysqli_fetch_assoc($query);
					$a_i = $ai['AUTO_INCREMENT'];
			    	if(!is_dir("../../images/".$a_i)){
			    		mkdir("../../images/".$a_i);
			    	}
			        $filename = date('YmdHis').$_FILES["ft"]["name"];
			        // echo "Size: " . ($_FILES["ft"]["size"] / 1024) . " kB<br>";
			        // echo "Temp file: " . $_FILES["ft"]["tmp_name"] . "<br>";
			        if (file_exists("../../images/".$a_i."/".$filename)) {
			            echo $filename . " already exists. ";
			        }
			        else {
			            move_uploaded_file($_FILES["ft"]["tmp_name"], "../../images/".$a_i."/".$filename);
				        echo "Stored in: " . "../../images/" . $filename;
				    }
	    		}	
			}
		}
			
		$query = mysqli_query($koneksi, "INSERT into $table set
			nama 		= '$nama',
			no_hp 		= '$hp',
			USERNAME	= '$us',
			GAMBAR      = '$filename',
			EMAIL		= '$em',
			PASSWORD	= '$ps',
			ROLE		= '2'")
		or die(mysqli_error($koneksi));
	}

	else if($crud == 'cek_us'){
		$us = $_POST['us'];
		$query = mysqli_query($koneksi, "SELECT * FROM $table where USERNAME = '$us'") or die(mysqli_error($koneksi));
		if(isset($_POST['us_lama'])){
			if(mysqli_num_rows($query) > 0 && $us != $_POST['us_lama']){
				echo "error";
			}
		}
		else{
			if(mysqli_num_rows($query) > 0){
				echo "error";
			}
		}
	}

	else if($crud == 'tampil_edit'){
		$query = mysqli_query($koneksi, "select * from $table where ID = '$_POST[id]'") or die(mysqli_error($koneksi));
		$data = array();
		while($a = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$data[count($data)] = array(
				'id'		=> $a['ID'],
				'username'	=> $a['USERNAME'],
				'email'		=> $a['EMAIL'],
				'gambar'	=> $a['GAMBAR'],
				'nama'		=> $a['nama'],
				'hp'		=> $a['no_hp']
				);
		}
		echo json_encode($data);
	}

	else if($crud == 'update'){
		$hp = $_POST['hp'];
		$nama = $_POST['nama'];
		$us = $_POST['us'];
		$id = $_POST['id'];
		$em = $_POST['em'];
		$ps = md5($_POST['ps']);
		if(!empty($ft_name = $_FILES['ft']['name'])){
			$ft_tipe = $_FILES["ft"]["type"];
			$allowedExts = array("jpeg", "jpg", "png", "JPEG", 'JPG', 'PNG');
			$temp = explode(".", $ft_name);
			$extension = end($temp);
			if ((($ft_tipe == "image/jpeg")
			|| ($ft_tipe == "image/jpg")
			|| ($ft_tipe == "image/pjpeg")
			|| ($ft_tipe == "image/x-png")
			|| ($ft_tipe == "image/png"))
			&& in_array($extension, $allowedExts)){
				if ($_FILES["ft"]["error"] > 0) {
			        echo "Return Code: " . $_FILES["ft"]["error"] . "<br>";
			    }
				else {    	
				    if(!is_dir("../../images/".$id)){
				   		mkdir("../../images/".$id);
				   	}
				    $filename = date('YmdHis').$_FILES["ft"]["name"];
			        // echo "Size: " . ($_FILES["ft"]["size"] / 1024) . " kB<br>";
			        // echo "Temp file: " . $_FILES["ft"]["tmp_name"] . "<br>";

			        if (file_exists("../../images/".$id."/".$filename)) {
			            echo $filename . " already exists. ";
				    }
				    else {
			        	unlink('../../images/'.$id.'/'.$_POST['ft_lama']);

				        move_uploaded_file($_FILES["ft"]["tmp_name"],
			            "../../images/".$id."/".$filename);
			            echo "Stored in: " . "../../images/" . $filename;
				    }

				    $query = mysqli_query($koneksi, "UPDATE $table set
				    	nama 		= '$nama',
						no_hp 		= '$hp',
						USERNAME	= '$us',
						GAMBAR      = '$filename',
						EMAIL		= '$em',
						PASSWORD	= '$ps'
						where ID 	= '$id'
						") or die(mysqli_error($koneksi));
	    		}	
			}
			else
				echo "Bukan Gambar";
		}
		else{
			$query = mysqli_query($koneksi, "UPDATE $table set
				nama 		= '$nama',
				no_hp 		= '$hp',
				USERNAME	= '$us',
				EMAIL		= '$em',
				PASSWORD	= '$ps'
				where ID 	= '$id'
				") or die(mysqli_error($koneksi));
		}
	}

	else if($crud == 'delete'){
		$id = $_POST['id'];
		$dir = "../../images/".$id;
		rrmdir($dir);

		$query = mysqli_query($koneksi, "SELECT ID from properti where ID_USERNAME = '$id'") or die(mysqli_error($koneksi));

		while($a = mysqli_fetch_assoc($query)){
			mysqli_query($koneksi, "DELETE from tb_harga where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
			mysqli_query($koneksi, "DELETE from gmbr_properti where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
			mysqli_query($koneksi, "DELETE from detail_fasilitas where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
		}

		mysqli_query($koneksi, "DELETE from properti where ID_USERNAME = '$id'") or die(mysqli_error($koneksi));
		mysqli_query($koneksi, "DELETE from $table where ID = '$id'") or die(mysqli_error($koneksi));
	}

	function rrmdir($dir){
	    if (is_dir($dir)) {
	      	$objects = scandir($dir);
	      	foreach ($objects as $object) {
	        	if ($object != "." && $object != "..") {
	          		if (filetype($dir."/".$object) == "dir") 
	             		rrmdir($dir."/".$object); 
	          		else unlink   ($dir."/".$object);
	        	}
	      	}
	      	reset($objects);
	      	rmdir($dir);
	    }
	}
?>
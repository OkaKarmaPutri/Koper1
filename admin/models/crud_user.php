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
				'role'		=> $a['ROLE'],
				'gambar'	=> $a['GAMBAR'],
				'email'		=> $a['EMAIL']
				);
		}
		echo json_encode($data);
	}

	else if($crud == 'insert'){
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
			        $filename = $label.$_FILES["file"]["name"];
			        echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			        echo "Type: " . $_FILES["file"]["type"] . "<br>";
			        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			        if (file_exists("uploads/" . $filename)) {
			            echo $filename . " already exists. ";
			        }
			        else {
			            move_uploaded_file($_FILES["file"]["tmp_name"],
			            "uploads/" . $filename);
			            echo "Stored in: " . "uploads/" . $filename;
			        }
    			}	
			}
		}
		
		
		$query = mysqli_query($koneksi, "INSERT into $table set
			USERNAME	= '$us',
			EMAIL		= '$em',
			PASSWORD	= '$ps',
			ROLE		= '2'")
		or die(mysqli_error($koneksi));
	}

	else if($crud == 'tampil_edit'){
		$query = mysqli_query($koneksi, "select * from $table where ID = '$_POST[id]'") or die(mysqli_error($koneksi));
		// echo json_encode(mysqli_fetch_array($query, MYSQLI_ASSOC));
		$data = array();
		while($a = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$data[count($data)] = array(
				'id'		=> $a['ID'],
				'username'	=> $a['USERNAME'],
				'email'		=> $a['EMAIL'],
				'password'	=> md5($a['PASSWORD']),
				'gambar'	=> $a['GAMBAR']
				);
		}
		echo json_encode($data);
	}
?>
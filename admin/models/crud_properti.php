<?php 
	include '../../database/koneksi.php';

	$crud = $_POST['crud'];
	$table = 'properti';

	if($crud == 'select'){
		$query = mysqli_query($koneksi, "SELECT * from $table") or die(mysqli_error($koneksi));

		$data = array();

		while($a = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$query1 = mysqli_query($koneksi, "SELECT USERNAME from user where ID = '$a[ID_USERNAME]'") or die(mysqli_error($koneksi));
			$id_username = mysqli_fetch_row($query1);

			$query1 = mysqli_query($koneksi, "SELECT harga, tipe_harga from tb_harga where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
			$harga = '<ul>';
			while($b = mysqli_fetch_assoc($query1)){
				$harga .= '<li>'.$b['harga'].$b['tipe_harga'].'</li>';
			}
			$harga = $harga.'</ul>';

			$query1 = mysqli_query($koneksi, "SELECT fasilitas, jum_fasilitas from detail_fasilitas where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
			$fas = '<ul>';
			$jumFas = '<ul>';
			while($b = mysqli_fetch_assoc($query1)){
				$fas .= '<li>'.$b['fasilitas'].'</li>';
				$jumFas .= '<li>'.$b['jum_fasilitas'].'</li>';
			}
			$fas = $fas.'</ul>';
			$jumFas = $jumFas.'</ul>';

			$query1 = mysqli_query($koneksi, "SELECT gambar from gmbr_properti where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
			$gmbr = '<ul>';
			$jumGmbr = 0;
			while($b = mysqli_fetch_assoc($query1)){
				$gmbr .= '<img src="../images/'.$a['ID_USERNAME'].'/'.$b['gambar'].'" width="100px">';
				if($jumGmbr % 2 == 1)
					$gmbr .= '</br>';
				$jumGmbr++;
			}

			$data[count($data)] = array(
				'id'		=> $a['ID'],
				'us'		=> $id_username[0],
				'tipe'		=> $a['TIPE'],
				'nm_pro'	=> $a['NAMA_PROPERTI'],
				'fas'		=> $fas,
				'jumFas'	=> $jumFas,
				'harga'		=> $harga,
				'jumKmr'	=> $a['jum_kamar'],
				'kmrSedia'	=> $a['kamar_sedia'],
				'al'		=> $a['ALAMAT'],
				'gambar'	=> $gmbr,
				'lat'		=> $a['LAT'],
				'lon'		=> $a['LON']
				);
		}
		echo json_encode($data);
	}

	else if($crud == 'insert'){
		$query = mysqli_query($koneksi, "SELECT AUTO_INCREMENT 
			FROM information_schema.tables
			WHERE table_name = 'properti'
			and table_schema = 'koper'") or die(mysqli_error($koneksi));
		$ai = mysqli_fetch_assoc($query);
		$a_i = $ai['AUTO_INCREMENT'];

		$us 		= $_POST['us'];
		$tp_pro 	= $_POST['tp_pro'];
		$nm_pro 	= $_POST['nm_pro'];
		$harga 		= json_decode($_POST['harga']);
		$tp_harga 	= json_decode($_POST['tp_harga']);
		$fas 		= json_decode($_POST['fas']);
		$jumFas		= json_decode($_POST['jumFas']);
		$jumKmr		= $_POST['jumKamar'];
		$kmrSedia	= $_POST['kmrSedia'];
		$al			= $_POST['al'];

		if($tp_pro == 'Rumah')
			$kmrSedia = 0;

		$query = mysqli_query($koneksi, "INSERT into $table set
			ID_USERNAME		= '$us',
			TIPE  			= '$tp_pro',
			NAMA_PROPERTI	= '$nm_pro',
			ALAMAT			= '$al',
			jum_kamar		= '$jumKmr',
			kamar_sedia		= '$kmrSedia'")
			or die(mysqli_error($koneksi));

		for($i = 0; $i < count($harga); $i++){
			$tipe = '/'.$tp_harga[$i];
			$query1 = mysqli_query($koneksi, "INSERT into tb_harga set
				id_properti	= '$a_i',
				harga 		= '$harga[$i]',
				tipe_harga	= '$tipe'")
				or die(mysqli_error($koneksi));
		}

		for($i = 0; $i < count($fas); $i++){
			$query1 = mysqli_query($koneksi, "INSERT into detail_fasilitas set
				id_properti		= '$a_i',
				fasilitas		= '$fas[$i]',
				jum_fasilitas	= '$jumFas[$i]'")
				or die(mysqli_error($koneksi));
		}

		for($i = 0; $i < count($_FILES['ft']['name']); $i++){
			if($_FILES['ft']['name'][$i] != ''){
				$ft_name = $_FILES['ft']['name'][$i];
				$ft_tipe = $_FILES["ft"]["type"][$i];
				$allowedExts = array("jpeg", "jpg", "png", "JPEG", 'JPG', 'PNG');
				$temp = explode(".", $ft_name);
				$extension = end($temp);
				if ((($ft_tipe == "image/jpeg")
				|| ($ft_tipe == "image/jpg")
				|| ($ft_tipe == "image/pjpeg")
				|| ($ft_tipe == "image/x-png")
				|| ($ft_tipe == "image/png"))
				&& in_array($extension, $allowedExts)){
					if ($_FILES["ft"]["error"][$i] > 0) {
				        echo "Return Code: " . $_FILES["ft"]["error"][$i] . "<br>";
				    }
				    else {
				    	if(!is_dir("../../images/".$us)){
				    		mkdir("../../images/".$us);
				    	}
				        $filename = date('YmdHis').$_FILES["ft"]["name"][$i];
				        // echo "Size: " . ($_FILES["ft"]["size"] / 1024) . " kB<br>";
				        // echo "Temp file: " . $_FILES["ft"]["tmp_name"] . "<br>";
				        if (file_exists("../../images/".$us."/".$filename)) {
				            echo $filename . " already exists. ";
				        }
				        else {
				            move_uploaded_file($_FILES["ft"]["tmp_name"][$i], "../../images/".$us."/".$filename);
					        echo "Stored in: " . "../../images/" . $filename;
					    }
		    		}	
				}

				$query1 = mysqli_query($koneksi, "INSERT into gmbr_properti set
					id_properti		= '$a_i',
					gambar			= '$filename'")
					or die(mysqli_error($koneksi));
			}	
		}
		// echo json_encode($_POST);
	}

	else if($crud == 'tampil_edit'){
		$query = mysqli_query($koneksi, "SELECT * from $table where ID = '$_POST[id]'") or die(mysqli_error($koneksi));
		$data = array();
		while($a = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$query1 = mysqli_query($koneksi, "SELECT USERNAME from user where ID = '$a[ID_USERNAME]'") or die(mysqli_error($koneksi));
			$id_username = mysqli_fetch_row($query1);

			$query1 = mysqli_query($koneksi, "SELECT fasilitas, jum_fasilitas from detail_fasilitas where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
			$fas = array();
			while($b = mysqli_fetch_assoc($query1)){
				$fas[count($fas)] = array(
					'fas'		=> $b['fasilitas'],
					'jumFas'	=> $b['jum_fasilitas']
				);
			}

			$query1 = mysqli_query($koneksi, "SELECT harga, tipe_harga from tb_harga where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
			$harga = array();
			while($b = mysqli_fetch_assoc($query1)){
				$harga[count($harga)] = array(
					'hrg'		=> $b['harga'],
					'tp_hrg'	=> substr($b['tipe_harga'], 1)
				);
			}

			$query1 = mysqli_query($koneksi, "SELECT gambar from gmbr_properti where id_properti = '$a[ID]'") or die(mysqli_error($koneksi));
			$gambar = array();
			while($b = mysqli_fetch_assoc($query1)){
				$gambar[count($gambar)] = array(
					'gmbr'		=> $b['gambar']
				);
			}

			$data[count($data)] = array(
				'id'		=> $a['ID'],
				'us'		=> $a['ID_USERNAME'],
				'tipe'		=> $a['TIPE'],
				'nm_pro'	=> $a['NAMA_PROPERTI'],
				'fas'		=> $fas,
				'harga'		=> $harga,
				'jumKmr'	=> $a['jum_kamar'],
				'kmrSedia'	=> $a['kamar_sedia'],
				'al'		=> $a['ALAMAT'],
				'gambar'	=> $gambar,	
				'lat'		=> $a['LAT'],
				'lon'		=> $a['LON']
				);
		}
		echo json_encode($data);
	}

	else if($crud == 'update'){
		$id 		= $_POST['id'];
		$us 		= $_POST['us'];
		$tp_pro 	= $_POST['tp_pro'];
		$nm_pro 	= $_POST['nm_pro'];
		$harga 		= json_decode($_POST['harga']);
		$tp_harga 	= json_decode($_POST['tp_harga']);
		$fas 		= json_decode($_POST['fas']);
		$jumFas		= json_decode($_POST['jumFas']);
		$jumKmr		= $_POST['jumKamar'];

		if($tp_pro == 'Rumah')
			$kmrSedia = 0;
		else
			$kmrSedia	= $_POST['kmrSedia'];
		
		$al			= $_POST['al'];
		$ft_lama	= $_POST['ft_lama'];

		

		$query = mysqli_query($koneksi, "UPDATE $table set
			ID_USERNAME		= '$us',
			TIPE  			= '$tp_pro',
			NAMA_PROPERTI	= '$nm_pro',
			ALAMAT			= '$al',
			jum_kamar		= '$jumKmr',
			kamar_sedia		= '$kmrSedia'
			where ID = '$id'")
			or die(mysqli_error($koneksi));

		$query = mysqli_query($koneksi, "DELETE from tb_harga where id_properti = '$id'") or die(mysqli_error($koneksi));

		for($i = 0; $i < count($harga); $i++){
			$tipe = '/'.$tp_harga[$i];
			$query1 = mysqli_query($koneksi, "INSERT into tb_harga set
				id_properti	= '$id',
				harga 		= '$harga[$i]',
				tipe_harga	= '$tipe'")
				or die(mysqli_error($koneksi));
		}

		$query = mysqli_query($koneksi, "DELETE from detail_fasilitas where id_properti = '$id'") or die(mysqli_error($koneksi));

		for($i = 0; $i < count($fas); $i++){
			$query1 = mysqli_query($koneksi, "INSERT into detail_fasilitas set
				id_properti		= '$id',
				fasilitas		= '$fas[$i]',
				jum_fasilitas	= '$jumFas[$i]'")
				or die(mysqli_error($koneksi));
		}

		$where = "where id_properti = ".$id." and";
		$j = 0;
		for($i = 0; $i < count($ft_lama); $i++){
			while(!isset($ft_lama[$j]))
				$j++;
			
			$where .= " gambar <> '".$ft_lama[$j]."' and";
			
			$j++;
		}
		$where = substr($where, 0, -4);

		$query = mysqli_query($koneksi, "SELECT gambar from gmbr_properti $where") or die(mysqli_error($koneksi));

		while($a = mysqli_fetch_assoc($query)){
			unlink('../../images/'.$us.'/'.$a['gambar']);
		}

		$query = mysqli_query($koneksi, "DELETE from gmbr_properti where id_properti = '$id'") or die(mysqli_error($koneksi));
		$z = 0;
		$i = 0;
		for($j = 0; $j < count($_FILES['ft']['name']); $j++){
			while(!isset($_FILES['ft']['name'][$i]))
				$i++;
			
			if($_FILES['ft']['name'][$i] != ''){
				$ft_name = $_FILES['ft']['name'][$i];
				$ft_tipe = $_FILES["ft"]["type"][$i];
				$allowedExts = array("jpeg", "jpg", "png", "JPEG", 'JPG', 'PNG');
				$temp = explode(".", $ft_name);
				$extension = end($temp);
				if ((($ft_tipe == "image/jpeg")
				|| ($ft_tipe == "image/jpg")
				|| ($ft_tipe == "image/pjpeg")
				|| ($ft_tipe == "image/x-png")
				|| ($ft_tipe == "image/png"))
				&& in_array($extension, $allowedExts)){
					if ($_FILES["ft"]["error"][$i] > 0) {
				        echo "Return Code: " . $_FILES["ft"]["error"][$i] . "<br>";
				    }
				    else {
				        $filename = date('YmdHis').$_FILES["ft"]["name"][$i];
				        // echo "Size: " . ($_FILES["ft"]["size"] / 1024) . " kB<br>";
				        // echo "Temp file: " . $_FILES["ft"]["tmp_name"] . "<br>";
				        if (file_exists("../../images/".$us."/".$filename)) {
				        	move_uploaded_file($_FILES["ft"]["tmp_name"][$i], "../../images/".$us."/".$z.$filename);
				        	$filename = $z.$filename;
				            echo $filename . " already exists. ";
				            $z++;
				        }
				        else {
				            move_uploaded_file($_FILES["ft"]["tmp_name"][$i], "../../images/".$us."/".$filename);
					        echo "Stored in: " . "../../images/" . $filename;
					    }
		    		}	
				}

				$query1 = mysqli_query($koneksi, "INSERT into gmbr_properti set
					id_properti		= '$id',
					gambar			= '$filename'")
					or die(mysqli_error($koneksi));
			}
			$i++;	
		}

		$j = 0;
		for($i = 0; $i < count($ft_lama); $i++){
			while(!isset($ft_lama[$j]))
				$j++;
			
			$query = mysqli_query($koneksi, "INSERT into gmbr_properti set
				id_properti	= '$id',
				gambar		= '$ft_lama[$j]'")
			or die(mysqli_error($koneksi));
			$j++;
		}

		// echos $_FILES['ft']['name'][1];
	}

	else if($crud == 'delete'){
		$id = $_POST['id'];

		$query1 = mysqli_query($koneksi, "SELECT ID_USERNAME from $table where ID = '$id'") or die(mysqli_error($koneksi));
		$id_username = mysqli_fetch_row($query1);

		$query = mysqli_query($koneksi, "SELECT gambar from gmbr_properti where id_properti = '$id'") or die(mysqli_error($koneksi));
		while($a = mysqli_fetch_assoc($query)){
			unlink('../../images/'.$id_username[0].'/'.$a['gambar']);
		}

		mysqli_query($koneksi, "DELETE from detail_fasilitas where id_properti = '$id'") or die(mysqli_error($koneksi));
		mysqli_query($koneksi, "DELETE from gmbr_properti where id_properti = '$id'") or die(mysqli_error($koneksi));
		mysqli_query($koneksi, "DELETE from tb_harga where id_properti = '$id'") or die(mysqli_error($koneksi));
		mysqli_query($koneksi, "DELETE from $table where ID = '$id'") or die(mysqli_error($koneksi));
	}
?>
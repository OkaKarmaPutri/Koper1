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
		$kmrSedia	= $_POST['kmrSedia'];
		$al			= $_POST['al'];

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

		echo json_encode($_POST);
	}
?>
<?php 
	include '../../database/koneksi.php';

	$crud = $_POST['crud'];
	$table = 'transaksi';

	if($crud == 'select'){
		$query = mysqli_query($koneksi, "SELECT * from $table") or die(mysqli_error($koneksi));

		$data = array();

		while($a = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$query1 = mysqli_query($koneksi, "SELECT USERNAME from user where ID = '$a[id_user]'") or die(mysqli_error($koneksi));
			$username = mysqli_fetch_row($query1);

			$query1 = mysqli_query($koneksi, "SELECT NAMA from pembeli where ID = '$a[id_pembeli]'") or die(mysqli_error($koneksi));
			$pembeli = mysqli_fetch_row($query1);

			$query1 = mysqli_query($koneksi, "SELECT NAMA_PROPERTI from properti where ID = '$a[id_properti]'") or die(mysqli_error($koneksi));
			$properti = mysqli_fetch_row($query1);

			if($a['status'] == 1)
				$status = 'Belum Bayar';
			else
				$status = 'Sudah Bayar';

			if(empty($username[0]))
				$username[0] = '-';

			if(empty($pembeli[0]))
				$pembeli[0] = '-';

			$data[count($data)] = array(
				'id'			=> $a['id'],
				'us'			=> $username[0],
				'pembeli'		=> $pembeli[0],
				'id_pembeli'	=> $a['id_pembeli'],
				'properti'		=> $properti[0],
				'id_properti'	=> $a['id_properti'],
				'status'		=> $status,
				'rek'			=> $a['no_rek']
				);
		}
		echo json_encode($data);
	}

	else if($crud == 'insert'){
		$id_us 		= $_POST['id_us'];
		$id_pembeli	= $_POST['id_pembeli'];
		$nm_pro 	= $_POST['nm_pro'];
		$id_st		= $_POST['id_st'];
		$rek 		= $_POST['rek'];
		$query = mysqli_query($koneksi, "INSERT into $table set
			id_user		= '$id_us',
			id_pembeli  = '$id_pembeli',
			id_properti	= '$nm_pro',
			status		= '$id_st',
			no_rek		= '$rek'")
			or die(mysqli_error($koneksi));
	}

	else if($crud == 'tampil_edit'){
		$id = $_POST['id'];
		$query = mysqli_query($koneksi, "SELECT * from $table where ID = '$id'") or die(mysqli_error($koneksi));
		$data = array();
		$a = mysqli_fetch_array($query, MYSQLI_ASSOC);

		if($a['id_user'] == 0)
			$a['id_user'] = '--Pilih--';
		else
			$a['id_pembeli'] = '--Pilih--';
			

		$data[count($data)] = array(
			'id'		=> $a['id'],
			'us'		=> $a['id_user'],
			'pembeli'	=> $a['id_pembeli'],
			'pro'		=> $a['id_properti'],
			'status'	=> $a['status'],
			'rek'		=> $a['no_rek']
			);
		
		echo json_encode($data);
	}

	else if($crud == 'update'){
		$id 		= $_POST['id'];
		$id_us 		= $_POST['id_us'];
		$id_pembeli	= $_POST['id_pembeli'];
		$nm_pro 	= $_POST['nm_pro'];
		$id_st		= $_POST['id_st'];
		$rek 		= $_POST['rek'];

		$query = mysqli_query($koneksi, "UPDATE $table set
			id_user		= '$id_us',
			id_pembeli  = '$id_pembeli',
			id_properti	= '$nm_pro',
			status		= '$id_st',
			no_rek		= '$rek'
			where ID 	= $id")
			or die(mysqli_error($koneksi));
	}

	else if($crud == 'delete'){
		$id = $_POST['id'];
		mysqli_query($koneksi, "DELETE from $table where ID = '$id'") or die(mysqli_error($koneksi));
	}
?>
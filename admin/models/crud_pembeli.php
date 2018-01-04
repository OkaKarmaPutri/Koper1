<?php 
	include '../../database/koneksi.php';

	$crud = $_POST['crud'];
	$table = 'pembeli';

	if($crud == 'select'){
		$query = mysqli_query($koneksi, "SELECT * from $table") or die(mysqli_error($koneksi));

		$data = array();

		while($a = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$data[count($data)] = array(
				'id'		=> $a['ID'],
				'nama'		=> $a['NAMA'],
				'alamat'	=> $a['ALAMAT'],
				'jns'		=> $a['JNS'],
				'no_hp'		=> $a['NO_HP'],
				'email'		=> $a['EMAIL']
				);
		}
		echo json_encode($data);
	}

	else if($crud == 'insert'){
		$nm = $_POST['nm'];
		$al = $_POST['al'];
		$jns = $_POST['jns'];
		$hp = $_POST['hp'];
		$em = $_POST['em'];
		$query = mysqli_query($koneksi, "INSERT into $table set
			NAMA	= '$nm',
			ALAMAT  = '$al',
			EMAIL	= '$em',
			JNS		= '$jns',
			NO_HP	= '$hp'")
			or die(mysqli_error($koneksi));
	}

	else if($crud == 'tampil_edit'){
		$query = mysqli_query($koneksi, "SELECT * from $table where ID = '$_POST[id]'") or die(mysqli_error($koneksi));
		$data = array();
		while($a = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$data[count($data)] = array(
				'id'		=> $a['ID'],
				'nama'		=> $a['NAMA'],
				'alamat'	=> $a['ALAMAT'],
				'jns'		=> $a['JNS'],
				'no_hp'		=> $a['NO_HP'],
				'email'		=> $a['EMAIL']
				);
		}
		echo json_encode($data);
	}

	else if($crud == 'update'){
		$id = $_POST['id'];
		$nm = $_POST['nm'];
		$al = $_POST['al'];
		$jns = $_POST['jns'];
		$hp = $_POST['hp'];
		$em = $_POST['em'];
		$query = mysqli_query($koneksi, "UPDATE $table set
			NAMA		= '$nm',
			ALAMAT  	= '$al',
			EMAIL		= '$em',
			JNS			= '$jns',
			NO_HP		= '$hp'
			where ID 	= $id")
			or die(mysqli_error($koneksi));
	}

	else if($crud == 'delete'){
		$id = $_POST['id'];
		mysqli_query($koneksi, "DELETE from $table where ID = '$id'") or die(mysqli_error($koneksi));
	}
?>
<?php 
	include '../database/koneksi.php';

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
		$ft = $_FILES['ft']['name'];
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
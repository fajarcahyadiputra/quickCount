<?php 
include '../functions/db.php';

if(isset($_GET['get'])){
	$get  = $_GET['get'];

	if($get == 'dataUser'){
		$id  = $_POST['id'];
		
		$get = mysqli_query($link, "SELECT * FROM admin WHERE id=$id");
		$data = mysqli_fetch_array($get);

		echo json_encode($data);
	}elseif($get == 'dataKecamatan'){
		$id  = $_POST['id'];
		
		$get = mysqli_query($link, "SELECT * FROM kecamatan WHERE id=$id");
		$data = mysqli_fetch_array($get);

		echo json_encode($data);
	}elseif ($get == 'dataDesa') {
		$id  = $_POST['id'];
		
		$get = mysqli_query($link, "SELECT * FROM desa WHERE id=$id");
		$data = mysqli_fetch_array($get);

		echo json_encode($data);
	}elseif($get == 'data_admin'){
		$id  = $_POST['id'];
		
		$get = mysqli_query($link, "SELECT * FROM tb_user WHERE id=$id");
		$data = mysqli_fetch_array($get);

		echo json_encode($data);
	}elseif($get == 'getDesaWhereKecamatan'){
		$nama  = $_POST['nama'];
		
		$get = mysqli_query($link, "SELECT * FROM kecamatan WHERE nama='$nama'");
		$data = mysqli_fetch_array($get);

		$desa = mysqli_query($link, "SELECT * FROM desa WHERE id_kecamatan = ".$data['id']."");
		$data_desa = mysqli_fetch_all($desa);


		echo json_encode($data_desa);
	}
}


?>
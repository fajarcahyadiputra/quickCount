<?php 
session_start();
include '../functions/db.php';

if(isset($_GET['hapus'])){
	$get  = $_GET['hapus'];

	if($get == 'dataUser'){
		$id  = $_GET['id'];
		$query = mysqli_query($link, "DELETE from admin WHERE id=$id");
		if($query){
            $_SESSION['pesan'] = 'Data Berhasil Terhapus';
            $_SESSION['warna'] = 'success';
            header('location: dataUser.php');
		}else{
            $_SESSION['pesan'] = 'Data Berhasil Terhapus';
            $_SESSION['warna'] = 'danger';
            header('location: dataUser.php');
		}
	}elseif($get === 'dataKecamatan'){
        $id  = $_GET['id'];
		$query = mysqli_query($link, "DELETE from kecamatan WHERE id=$id");
		if($query){
            $_SESSION['pesan'] = 'Data Berhasil Terhapus';
            $_SESSION['warna'] = 'success';
            header('location: kecamatan.php');
		}else{
            $_SESSION['pesan'] = 'Data Berhasil Terhapus';
            $_SESSION['warna'] = 'danger';
            header('location: kecamatan.php');
		}
	}elseif($get == 'dataDesa'){
		$id = $_GET['id'];
		$delete = mysqli_query($link, "DELETE FROM desa WHERE id=$id");
        if($delete){
            $_SESSION['pesan'] = 'Data Berhasil Terhapus';
            $_SESSION['warna'] = 'success';
            header('location: kecamatan.php');
		}else{
            $_SESSION['pesan'] = 'Data Berhasil Terhapus';
            $_SESSION['warna'] = 'danger';
            header('location: kecamatan.php');
		}
	}elseif($get == 'dataKordes'){
		$id = $_GET['id'];
		$delete = mysqli_query($link, "DELETE FROM team_kordes WHERE id=$id");
        if($delete){
            $_SESSION['pesan'] = 'Data Berhasil Terhapus';
            $_SESSION['warna'] = 'success';
            header('location: teamKordes.php');
		}else{
            $_SESSION['pesan'] = 'Data Berhasil Terhapus';
            $_SESSION['warna'] = 'danger';
            header('location: teamKordes.php');
		}
	}else if($get === 'dataTps'){
		$id = $_GET['id'];
		$delete = mysqli_query($link, "DELETE FROM tps WHERE id=$id");
        if($delete){
			$_SESSION['pesan'] = 'Data Berhasil Terhapus';
			$_SESSION['warna'] = 'success';
			unlink('assets/tps/'.$_GET['foto']);
            header('location: tps.php');
		}else{
            $_SESSION['pesan'] = 'Data Berhasil Terhapus';
            $_SESSION['warna'] = 'danger';
            header('location: tps.php');
		}
	}
}
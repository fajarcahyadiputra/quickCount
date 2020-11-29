<?php 
session_start();
include '../functions/db.php';
if(isset($_GET['tambah'])){
	$get = $_GET['tambah'];

	if($get == 'data_user'){
		
		if(isset($_POST['tambahUser'])){

			$username = $_POST['username'];
			$password = sha1($_POST['password']);
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$level = $_POST['level'];
			$status_aktif = 'y';


			$insert = mysqli_query($link,"INSERT INTO admin VALUES('','$jenis_kelamin','$username','$password','$status_aktif','$level')");
			if($insert){
                $_SESSION['pesan'] = 'Data Berhasil DI Tambah';
                $_SESSION['warna'] = 'success';
                 header('location: dataUser.php');
			}else{
                $_SESSION['pesan'] = 'Data Gagal DI Tambah';
                $_SESSION['danger'] = 'success';
                header('location: dataUser.php');
			}
		}else{
			$_SESSION['pesan'] = 'Data Gagal DI Tambah';
            header('location: dataUser.php');
		}

	}elseif($get == 'data_kecamatan'){

        if(isset($_POST['tambahKecamatan'])){

			$nama = $_POST['nama'];

			$insert = mysqli_query($link,"INSERT INTO kecamatan VALUES('','$nama')");
			if($insert){
                $_SESSION['pesan'] = 'Data Berhasil DI Tambah';
                $_SESSION['warna'] = 'success';
                 header('location: kecamatan.php');
			}else{
                $_SESSION['pesan'] = 'Data Gagal DI Tambah';
                $_SESSION['danger'] = 'success';
                header('location: kecamatan.php');
			}
		}else{
			$_SESSION['pesan'] = 'Data Gagal DI Tambah';
            header('location: kecamatan.php');
		}
		
	}elseif($get == 'data_desa'){

        if(isset($_POST['tambahDesa'])){

			$id_kecamatan = $_POST['id_kecamatan'];
			$nama        = $_POST['nama'];

			$insert = mysqli_query($link,"INSERT INTO desa VALUES('','$id_kecamatan','$nama')");
			if($insert){
                $_SESSION['pesan'] = 'Data Berhasil DI Tambah';
                $_SESSION['warna'] = 'success';
                 header('location: desa.php');
			}else{
                $_SESSION['pesan'] = 'Data Gagal DI Tambah';
                $_SESSION['danger'] = 'success';
                header('location: desa.php');
			}
		}else{
			$_SESSION['pesan'] = 'Data Gagal DI Tambah';
            header('location: desa.php');
		}
		
	}elseif($get == 'data_kordes'){
		if(isset($_POST['tambahKordes'])){

			$nama 		   = $_POST['nama'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$no_hp 		   = $_POST['no_hp'];
			$alamat 	   = $_POST['alamat'];

			$insert = mysqli_query($link,"INSERT INTO team_kordes VALUES('','$nama','$jenis_kelamin','$no_hp','$alamat')");
			if($insert){
                $_SESSION['pesan'] = 'Data Berhasil DI Tambah';
                $_SESSION['warna'] = 'success';
                 header('location: teamKordes.php');
			}else{
                $_SESSION['pesan'] = 'Data Gagal DI Tambah';
                $_SESSION['danger'] = 'success';
                header('location: teamKordes.php');
			}
		}else{
			$_SESSION['pesan'] = 'Data Gagal DI Tambah';
                $_SESSION['danger'] = 'success';
                header('location: teamKordes.php');
		}
	}else if($get === 'data_tps'){
		if(isset($_POST['tambahTps'])){

			$nama 		   = $_POST['nama'];
			$jumblah_suara = $_POST['jumblah_suara'];
			
			$foto = upload();

			if(!$foto){
				return false;
			}

			$insert = mysqli_query($link,"INSERT INTO tps VALUES('','$nama','$jumblah_suara','$foto')");
			if($insert){
                $_SESSION['pesan'] = 'Data Berhasil DI Tambah';
                $_SESSION['warna'] = 'success';
                 header('location: tps.php');
			}else{
                $_SESSION['pesan'] = 'Data Gagal DI Tambah';
                $_SESSION['danger'] = 'success';
                header('location: tps.php');
			}
		}else{
			$_SESSION['pesan'] = 'Data Gagal DI Tambah';
                $_SESSION['danger'] = 'success';
                header('location: tps.php');
		}
	}
}


function upload(){
	$nama_file    = $_FILES['foto']['name'];
	$tempat 	  = $_FILES['foto']['tmp_name'];
	$error 		  = $_FILES['foto']['error'];

	if($error === 4){
		echo "<script>

		alert('silakan pilih gambar terlebih dahulu');

		</script>";
		return false;
	}

	$ektensigambarvalid  = ['jpg','png','gift','jpeg'];
	$ektensigambar       = explode('.', $nama_file);
	$ektensigambar       = strtolower(end($ektensigambar));

	if(!in_array($ektensigambar, $ektensigambarvalid)){
		echo "<script>

		alert('ektensi gambar anda salah');

		</script>";
		return false;
	}

	$ektensifilebaru  =  uniqid();
	$ektensifilebaru .=  '.';
	$ektensifilebaru .=  $ektensigambar;



	move_uploaded_file($tempat, 'assets/tps/' . $ektensifilebaru);

	return $ektensifilebaru;
}
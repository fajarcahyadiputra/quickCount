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
		
	}elseif($get == 'data_admin'){
		if(isset($_POST['tambah_admin'])){
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$username = $_POST['username'];
			$password = sha1($_POST['password']);
			$email = $_POST['email'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$status_aktif = 'aktif';
			$tanggal_buat = date('Y-m-d');
			$role = 'admin';

			$insert = mysqli_query($koneksi,"INSERT INTO tb_user VALUES('','$kode','$nama','$username','$password','$email','$status_aktif','$tanggal_buat','$role','$jenis_kelamin')");
			if($insert){
				echo "<script>alert('Data Berhasil di masukan..!'); document.location.href='data_admin.php'</script>";
			}else{
				echo "<script>alert('Data Gagal di masukan..!'); document.location.href='data_admin.php'</script>";
			}
		}else{
			echo "<script>alert('Data Gagal di masukan..!'); document.location.href='data_admin.php'</script>";
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



	move_uploaded_file($tempat, 'foto_kandidat/' . $ektensifilebaru);

	return $ektensifilebaru;
}
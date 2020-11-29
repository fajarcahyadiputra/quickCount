<?php 
session_start();
include '../functions/db.php';
if(isset($_GET['edit'])){
	$get = $_GET['edit'];

	if($get == 'dataUser'){
		
		if(isset($_POST['editUser'])){
			//edit data pemilih
			$username = $_POST['username'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$level = $_POST['level'];
            $status_aktif = $_POST['status_aktif'];
            $id   = $_POST['id'];

			$edit = mysqli_query($link, "UPDATE admin SET 
				username = '$username',
				status_aktif = '$status_aktif',
				jenis_kelamin = '$jenis_kelamin',
				level    = '$level'
				WHERE id=$id
				");
			if($edit){
				$_SESSION['pesan'] = 'Data Berhasil DI edit';
                $_SESSION['warna'] = 'success';
                header('location: dataUser.php');
                
			}else{
				$_SESSION['pesan'] = 'Data Gagal Di Edit';
                $_SESSION['warna'] = 'danger';
                header('location: dataUser.php');
			}

		}else{
			$_SESSION['pesan'] = 'Data Gagal Di Edit';
                $_SESSION['warna'] = 'danger';
                header('location: dataUser.php');

		}
	}elseif($get == 'editPassword'){
		//edit data kandidat
		if(isset($_POST['editPassword'])){

            $id         = $_POST['id'];
            $password   = $_POST['password'];

			$edit = mysqli_query($link, "UPDATE admin SET 
				password = '$password'
				WHERE id=$id
				");
			if($edit){
				$_SESSION['pesan'] = 'Data Berhasil DI edit';
                $_SESSION['warna'] = 'success';
                header('location: dataUser.php');
                
			}else{
				$_SESSION['pesan'] = 'Data Gagal Di Edit';
                $_SESSION['warna'] = 'danger';
                header('location: dataUser.php');
			}


		}else{
			$_SESSION['pesan'] = 'Data Gagal Di Edit';
                $_SESSION['warna'] = 'danger';
                header('location: dataUser.php');
		}
	}elseif($get == 'dataKecamatan'){
	//edit data kandidat
    if(isset($_POST['editKecamatan'])){

        $id         = $_POST['id'];
        $nama       = $_POST['nama'];

        $edit = mysqli_query($link, "UPDATE kecamatan SET 
            nama = '$nama'
            WHERE id=$id
            ");
        if($edit){
            $_SESSION['pesan'] = 'Data Berhasil DI edit';
            $_SESSION['warna'] = 'success';
            header('location: kecamatan.php');
            
        }else{
            $_SESSION['pesan'] = 'Data Gagal Di Edit';
            $_SESSION['warna'] = 'danger';
            header('location: kecamatan.php');
        }


    }else{
        $_SESSION['pesan'] = 'Data Gagal Di Edit';
            $_SESSION['warna'] = 'danger';
            header('location: kecamatan.php');
    }

	}elseif($get == 'dataDesa'){

        if(isset($_POST['editDesa'])){

            $id         = $_POST['id'];
            $nama       = $_POST['nama'];
            $id_kecamatan   = $_POST['id_kecamatan'];
    
            $edit = mysqli_query($link, "UPDATE desa SET 
                id_kecamatan = '$id_kecamatan',
                nama        = '$nama'
                WHERE id=$id
                ");
            if($edit){
                $_SESSION['pesan'] = 'Data Berhasil DI edit';
                $_SESSION['warna'] = 'success';
                header('location: desa.php');
                
            }else{
                $_SESSION['pesan'] = 'Data Gagal Di Edit';
                $_SESSION['warna'] = 'danger';
                header('location: desa.php');
                // echo mysqli_error($link);
            }
    
    
        }else{
            $_SESSION['pesan'] = 'Data Gagal Di Edit';
                $_SESSION['warna'] = 'danger';
                header('location: desa.php');
        }
	
	}else if($get === 'dataKordes'){

		if(isset($_POST['editKordes'])){
			$id         = $_POST['id'];
			$nama 		   = $_POST['nama'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$no_hp 		   = $_POST['no_hp'];
			$alamat 	   = $_POST['alamat'];

		$edit = mysqli_query($link, "UPDATE team_kordes SET 
			nama 				= '$nama',
			jenis_kelamin        = '$jenis_kelamin',
			no_hp        		= '$no_hp',
			alamat        		= '$alamat'
			WHERE id=$id
			");
		if($edit){
			$_SESSION['pesan'] = 'Data Berhasil DI edit';
			$_SESSION['warna'] = 'success';
			header('location: teamKordes.php');
			
		}else{
			$_SESSION['pesan'] = 'Data Gagal Di Edit';
			$_SESSION['warna'] = 'danger';
			header('location: teamKordes.php');
			// echo mysqli_error($link);
		}


	}else{
		$_SESSION['pesan'] = 'Data Gagal Di Edit';
			$_SESSION['warna'] = 'danger';
			header('location: teamKordes.php');
	}
	}else if($get === 'dataTps'){
		if(isset($_POST['editTps'])){

            $id         = $_POST['id'];
            $nama       = $_POST['nama'];
			$jumblah_suara   = $_POST['jumblah_suara'];
			$foto_lama = $_POST['foto_lama'];
			
			$foto  = $_FILES['foto_baru']['name'];
			if(!$foto){
				$foto = $foto_lama;
			}else{
				$foto  = upload();
				unlink('assets/tps/'. $foto_lama);
				if(!$foto){
					return error;
				}
			}
    
            $edit = mysqli_query($link, "UPDATE tps SET 
                nama 				= '$nama',
                jumblah_suara        = '$jumblah_suara',
                foto       			 = '$foto'
                WHERE id=$id
                ");
            if($edit){
                $_SESSION['pesan'] = 'Data Berhasil DI edit';
                $_SESSION['warna'] = 'success';
                header('location: tps.php');
                
            }else{
                $_SESSION['pesan'] = 'Data Gagal Di Edit';
                $_SESSION['warna'] = 'danger';
                header('location: tps.php');
                // echo mysqli_error($link);
            }
    
    
        }else{
            $_SESSION['pesan'] = 'Data Gagal Di Edit';
                $_SESSION['warna'] = 'danger';
                header('location: tps.php');
        }
	}
}



//function untuk edit foto
function upload(){
	$nama_file    = $_FILES['foto_baru']['name'];
	$tempat 	  = $_FILES['foto_baru']['tmp_name'];
	$error 		  = $_FILES['foto_baru']['error'];

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
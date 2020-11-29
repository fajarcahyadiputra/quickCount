<?php
$server = 'localhost';
$uname = 'root';
$pass = '';
$db = 'free_quickcount';
$link = mysqli_connect($server,$uname,$pass,$db);
if (!$link){
    die("Koneksi Gagal Boss !! ". mysqli_connect_error());
}
?>

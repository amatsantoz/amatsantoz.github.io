<?php
include 'koneksi.php';
$nopegawai = isset($_GET['nopegawai']) ? $_GET['nopegawai'] : '';
$sql = mysqli_query($koneksi, "select * from crew where id='$nopegawai'");
$crew = mysqli_fetch_array($sql);
$data = array(
     'nama'      =>  $crew['nama'],
     );
    echo json_encode($data);

?>
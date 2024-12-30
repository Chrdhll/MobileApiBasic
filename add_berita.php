<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: header");

include "koneksi.php";
include "response.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    date_default_timezone_set('Asia/Jakarta');
    
    $dir_upload = "images/";
    $nama_file = $_FILES['fileGambar']['name'];
    $judul = $_POST['judul'];
    $isi_berita = $_POST['isiBerita'];
    $tgl_berita = date("Y-m-d H:i:s");  

    if(is_uploaded_file($_FILES['fileGambar']['tmp_name'])) {
        $cek = move_uploaded_file(
            $_FILES['fileGambar']['tmp_name'],
            $dir_upload . $nama_file //images/gambar.jpg
        );

        $insert = "insert into berita VALUES (NULL,'$judul','$isi_berita','$nama_file','$tgl_berita',0)";
        IF (mysqli_query($koneksi, $insert)) {
            sendResponse(true, "Berhasil menambahkan data berita");
        } else {
            sendResponse(false, "Gagal menambahkan data berita");
        }
    }
}

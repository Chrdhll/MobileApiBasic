<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: header");

include "koneksi.php";
include "response.php";

function getCurrentUrl()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
       || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
       $host = $_SERVER['HTTP_HOST']; 
       $uri = $_SERVER['REQUEST_URI'];

       return $protocol.$host."/MobileApiBasic/images/";
}

$judul = isset($_GET["judul"]) ? $_GET["judul"] : "";

$sql = "SELECT *, DATE_FORMAT(tgl_berita, '%d-%m-%Y %H:%i:%s') AS tgl_indonesia_berita
        FROM berita WHERE judul LIKE '%$judul%' ORDER BY id DESC";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = [
            "id" => $row["id"],
            "judul" => $row["judul"],
            "isi" => $row["isi_berita"],
            "tgl_indonesia_berita" => $row["tgl_indonesia_berita"],
            "gambar" => getCurrentUrl() . $row['gambar_berita'],//http://localhost/API_BASIC/images/
            "rating" => floatval($row['rating'])//"4.5" : 4.5
        ];
    }
    sendResponse(true, "Berhasil menampilkan seluruh data berita", $data);
    } else {
        sendResponse(false, "Data berita tidak tersedia", []);
}
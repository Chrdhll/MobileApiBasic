<?php

use LDAP\Result;

header("Acces-Control-Allow-Origin: *");
header("Acces-Control-Allow-Header");

include 'koneksi.php';
include 'response.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_fetch_array(mysqli_query($koneksi, $cek));

    if (isset($result)) {
        $data = [
            'id' => $result['id'],
            'username' => $result['username'],
            'fullname' => $result['fullname'],
        ];
        sendResponse(true, "login berhasil", $data);
    } else {
        sendResponse(false, "login gagal");
    }
}

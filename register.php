<?php
header("Acces-Control-Allow-Origin: *");
header("Acces-Control-Allow-Header");

include 'koneksi.php';
include 'response.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $response = array();
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];

    $cek = "Select * from users where username = '$username' or email='$email'";
    $result = mysqli_fetch_array(mysqli_query($koneksi, $cek));

    if(isset($result)){
        // $response['value'] = 0;
        // $response['message'] = "Username atau email telah digunakan";
        // echo json_encode($response);
        sendResponse(false,"username atau password telah digunakan");
    }
    else{
        $insert = "insert into users(id,username,password,fullname,email,tgl_daftar) values (NULL,'$username','$password','$fullname','$email',NOW())";


        if(mysqli_query($koneksi, $insert)){
            // $response['value'] = 1;
            // $response['message'] = "Data berhasil didaftarkan";
            // echo json_encode($response);
            sendResponse(true,"Data berhasil didaftarkan");
        }else{
            // $response['value'] = 0;
            // $response['message'] = "Data gagal didaftarkan";
            // echo json_encode($response);
            sendResponse(false,"Data gagal ditambahka");
        }
    }

}

?>
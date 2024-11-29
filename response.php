<?php

function sendResponse($value,$message,$data = []){
    header("Content-Type: application/json");

    $response = [
        'succes' => $value,
        'message' => $message,
        'data' => $data
    ];

    echo json_encode($response);
    exit;
}
?>

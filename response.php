<?php

function sendResponse($value,$message,$data = []){
    header("Content-Type: application/json");

    $response = [
        'success' => $value,
        'message' => $message,
        'data' => $data
    ];

    echo json_encode($response);
    exit;
}
?>

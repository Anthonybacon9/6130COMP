<?php
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $message = $data['message'];
    $file = fopen("data.csv", "a");
    fputcsv($file, [$name, $email, $phone, $message]);
    fclose($file);
?>


<?php
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $data['name'];
    $email = $data['email'];
    $Address = $data['Address'];
    $player = $data['player'];
    $file = fopen("data.csv", "a");
    fputcsv($file, [$name, $email, $phone, $message]);
    fclose($file);
?>


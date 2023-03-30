<?php

require 'vendor/autoload.php';
try { 
    $client = new MongoDB\Client(
        'mongodb://data-mongo1:27017,data-mongo2:27017,data-mongo3:27017/admin?replicaSet=rs0'
    );
} catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
} catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
}

$collection = $client->RunnersDatabase->codes; 
$users = $client->RunnersDatabase->users;


$code = $_POST['code'];
$name = $_POST['name']; 
$email = $_POST['email']; 
$address = $_POST['address']; 
$bestplayer = $_POST['best_player']; 

$result = $collection->findOne(array('code' => $code));


if ($result != null && !$result['redeemed']) 
{
    $coupon = $result['coupon'];
    $collection->updateOne(array('code' => $code), array('$set' => array('redeemed' => true)));
    $insertUser = array(
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'best_player' => $bestplayer,
        'code' => $code
    );

    if ($users->countDocuments(['code' => $code]) > 0) {
        echo "Sorry, this code has already been used.";
        exit;
    }
    
    $users->insertOne($insertUser);

    echo ("Coupon: ". $coupon);
    if ($coupon == "FREEBALL")
    {
        echo "Congratulations! You are one of our lucky winners and have won a free ball"; 
    } 
    else 
    {
        echo "Congratulations! You have got 10%</p>";
    }
} else {
    echo "Sorry, this code has already been used.";
    exit;
}
?>
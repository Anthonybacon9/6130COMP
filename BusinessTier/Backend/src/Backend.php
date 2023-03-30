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

use RunnersDatabase;

$db->codes->drop();
$db->users->drop();

function generate10DigitHexCode() {
    $hexRef = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f'];
    $result = [];

    for ($n = 0; $n < 10; $n++) {
        $result[] = $hexRef[rand(0, 15)];
    }
    return implode('', $result);
}

$codes = [];
$ensureRandomCodes = new \stdClass();
$footballs = 10;

while (count($codes) < 100) {
    $code = generate10DigitHexCode();
    if (!property_exists($ensureRandomCodes, $code)) {
        $ensureRandomCodes->$code = true;
        $coupon = "10OFF";
        if ($footballs > 0 && rand(0, 99) == 0) {
            $coupon = "FREEBALL";
            $footballs--;
        }
        array_push($codes, ['code' => $code, 'coupon' => $coupon, 'redeemed' => false]);
    }
}

$db->codes->insertMany($codes);

$db->codes->findOne(['code' => '1234567890']);

array_push($codes, ['_id' => 90, 'code' => '1234567890', 'coupon' => 'FREEBALL', 'redeemed' => false]);
array_push($codes, ['_id' => 89, 'code' => '1234567889', 'coupon' => '10OFF', 'redeemed' => false]);
array_push($codes, ['_id' => 88, 'code' => '1234567898', 'coupon' => '10OFF', 'redeemed' => true]);

$db->users->insertOne([]); 

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
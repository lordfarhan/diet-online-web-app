<?php
use PHPUnit\Runner\Exception;

define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
if(isset($_FILES['diagnose'])){
    $uploadPath = root."/diet-online-apps-web/api/img/diagnose/";
    $uploadUrl = "https://dion.co.id/api/img/diagnose/";
    
    $diagnose = $_FILES['diagnose']['name'];
    $fileInfo = pathinfo($_FILES['diagnose']['name']);
    $extension = $fileInfo['extension'];
    
    $file_url = $uploadUrl . $user_id . '.' . $extension;
    $file_path = $uploadPath . $user_id . '.' . $extension;
    $checkFile = true;
} else {
    $checkFile = false;
    $diagnose = "-";
}


$user_id = $_REQUEST['user_id'];
$product_id = $_REQUEST['product_id'];
$times = $_REQUEST['times'];
$days = $_REQUEST['days'];
$notes = $_REQUEST['notes'];
$activity = $_REQUEST['activity'];
$sickness = $_REQUEST['sickness'];
$foodType = $_REQUEST['foodType'];

try {
    if($checkFile){
        move_uploaded_file($_FILES['diagnose']['tmp_name'], $file_path);
        $transactions = $db->DietKhusus($user_id, $product_id, $days, $times, $notes, $activity, $sickness, $foodType, $file_url);
    } else {
        $transactions = $db->DietKhusus($user_id, $product_id, $days, $times, $notes, $activity, $sickness, $foodType, $diagnose);
    }
    if ($transactions != false || $transactions != NULL) {
        $user = $db->GetUser($transactions[0]['user_id']);
        $package = $db->GetProduct($transactions[0]['product_id']);
        $response['message'] = "Success Ordering";
        $response['transactions'] = $transactions;
        $response['user'] = $user;
        $response['product'] = $package;
        echo json_encode($response);
    } else {
        $response['error'] = true;
        $response['message'] = "Gagal Insert Data";
        echo json_encode($response);
    }
} catch (Exception $e) {
    $response['error'] = true;
    $response['message'] = "Gagal Insert Gambar". $e->getMessage();
    echo json_encode($response);
}


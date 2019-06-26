<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/diet-online-apps-web/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$user_id = $_REQUEST['user_id'];
$product_id = $_REQUEST['product_id'];
$times = $_REQUEST['times'];
$days = $_REQUEST['days'];
$address = $_REQUEST['address'];
$amount = $_REQUEST['amount'];
$notes = $_REQUEST['notes'];
if ($amount < 5) {
    $response['error'] = true;
    $response['message'] = "Jumlah harus lebih dari 5";
    echo json_encode($response);
} else if ($notes == "") {
    $notes = "-";
    $result = $db->InsertTransaction($user_id, $product_id, $address, $days, $times, $amount, $notes);
    $user = $db->GetUser($result[0]['user_id']);
    $package = $db->GetProduct($result[0]['product_id']);
    $response['message'] = "Success Ordering";
    $response['transactions'] = $result;
    $response['user'] = $user;
    $response['product'] = $package;
    echo json_encode($response);
} else if ($notes != "") {
    $result = $db->InsertTransaction($user_id, $product_id, $days, $address, $times, $amount, $notes);
    $user = $db->GetUser($result[0]['user_id']);
    $package = $db->GetProduct($result[0]['product_id']);
    $response['message'] = "Success Ordering";
    $response['transactions'] = $result;
    $response['user'] = $user;
    $response['product'] = $package;
    echo json_encode($response);
} else {
    $result = $db->InsertTransaction($user_id, $product_id, $address, $days, $times, $amount, $notes);
    if ($result) {
        $user = $db->GetUser($result[0]['user_id']);
        $package = $db->GetProduct($result[0]['product_id']);
        $response['message'] = "Success Ordering";
        $response['transactions'] = $result;
        $response['amount'] = $amount;
        $response['user'] = $user;
        $response['product'] = $package;
        echo json_encode($response);
    }
}

<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$user_id = $_REQUEST['user_id'];
$product_id = $_REQUEST['product_id'];
$times = $_REQUEST['times'];
$days = $_REQUEST['days'];
$amount = $_REQUEST['amount'];
$notes = $_REQUEST['notes'];
if ($amount < 5) {
    $response['error'] = true;
    $response['message'] = "Jumlah harus lebih dari 5";
    echo json_encode($response);
} else if ($notes == "") {
    $notes = "-";
    $result = $db->InsertTransaction($user_id, $product_id, $days, $times, $amount, $notes);
    $user = $db->GetUser($result['user_id']);
    $package = $db->GetProduct($result['product_id']);
    $response['message'] = "Success Ordering";
    $response['transactions'] = $result;
    $response['user'] = $user;
    $response['product'] = $package;
    echo json_encode($response);
} else {
    $result = $db->InsertTransaction($user_id, $product_id, $days, $times, $amount, $notes);
    $user = $db->GetUser($result['user_id']);
    $package = $db->GetProduct($result['product_id']);
    $response['message'] = "Success Ordering";
    $response['transactions'] = $result;
    $response['user'] = $user;
    $response['product'] = $package;
    echo json_encode($response);
}

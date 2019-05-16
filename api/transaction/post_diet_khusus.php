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
$activity = $_REQUEST['activity'];

$transactions = $db->DietKhusus($user_id, $product_id, $days, $times, $amount, $notes, $activity);
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
    $response['message'] = "Terjadi kesalahan dalam input database";
    echo json_encode($response);
}

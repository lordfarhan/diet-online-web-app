<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$user_id = $_REQUEST['user_id'];
$notes = $_REQUEST['notes'];
$transactions = $db->DietMayo($user_id, $notes);
if ($transactions) {
    $user = $db->GetUser($transactions[0]['user_id']);
    $package = $db->GetProduct($transactions[0]['product_id']);
    $response['message'] = "Success Ordering";
    $response['transactions'] = $transactions;
    $response['user'] = $user;
    $response['product'] = $package;
    echo json_encode($response);
}

<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$uid = $_REQUEST['uid'];
$result = $db->UpdateToDone($uid);
if ($result != FALSE) {
    $user = $db->GetUser($result['user_id']);
    $package = $db->GetProduct($result['product_id']);
    $response['message'] = "Success Updating";
    $response['transactions'] = $result;
    $response['user'] = $user;
    $response['product'] = $package;
    echo json_encode($response);
} else {
    $response['error'] = TRUE;
    $response['message'] = "Update Error";
    echo json_encode($response);
}

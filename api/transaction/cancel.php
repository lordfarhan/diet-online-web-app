<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$invoice = $_REQUEST['invoice'];
$result = $db->CancelUnpaidTransaction($invoice);
if($result){
    $response['message']= "Canceling Success";
    echo json_encode($response);
} else {
    $response['error']= true;
    $response['message']="Failed at Deleting Transactions";
    echo json_encode($response);
}

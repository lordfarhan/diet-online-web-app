<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$invoice = $_REQUEST['invoice'];
$result = $db->getByInvoice($invoice);
$price = $db->getPackagePrice($invoice);
if($result){
    $response['message']= "Fetch Success";
    $response['product_id'] = $result[0]['product_id'];
    $response['amount'] = count($result);
    $response['price'] = $price['price'];
    echo json_encode($response);
}else if($result==NULL){
    $response['message']= "There is no data";
    $response['amount'] = 0;
    echo json_encode($response);
} else {
    $response['error']= true;
    $response['message']="Fetching data Failed";
    echo json_encode($response);
}

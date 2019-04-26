<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$user_id = $_REQUEST['user_id'];
$status = $_REQUEST['status'];
$result = $db->FetchData($user_id,$status);
if($result!=FALSE){
    $response['message']= "Fetch Success";
    $response['amount'] = count($result);
    $response['transaction']=$result;
    echo json_encode($response);
}else if($result==NULL){
    $response['message']= "There is no data";
    $response['amount']=0;
    echo json_encode($response);
} else {
    $response['error']= true;
    $response['message']="Fetching data Failed";
    echo json_encode($response);
}
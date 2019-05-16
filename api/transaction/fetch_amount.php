<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$user_id = $_REQUEST['user_id'];
$result = $db->FetchAmount($user_id);
if($result!=FALSE){
    $response['message']= "Fetch Success";
    $response['amount'] = $result[3];
    $response['unpaid'] = $result[0];
    $response['paid'] = $result[1];
    $response['done'] = $result[2];
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
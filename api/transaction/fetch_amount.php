<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$user_id = $_REQUEST['user_id'];
$result = $db->FetchAmount($user_id);
if($result){
    $response['message']= "Fetch Success";
    $response['amount'] = $result[4];
    $response['unpaid'] = $result[0];
    $response['pending'] = $result[1];
    $response['paid'] = $result[2];
    $response['done'] = $result[3];
    echo json_encode($response);
} else if ($result==NULL){
    $response['message']= "Fetch Success";
    $response['amount'] = 0;
    $response['unpaid'] = 0;
    $response['pending'] = 0;
    $response['paid'] = 0;
    $response['done'] = 0;
    echo json_encode($response);
} else {
    $response['error']= true;
    $response['message']="Fetching data Failed";
    echo json_encode($response);
}

<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$height = $_REQUEST['height'];
$weight = $_REQUEST['weight'];
$activity = $_REQUEST['activity'];
$user_id = $_REQUEST['user_id'];

$result = $db->HitungKalori($height, $weight, $activity, $user_id);
$response['calorie'] = $result;
echo json_encode($response);
?>
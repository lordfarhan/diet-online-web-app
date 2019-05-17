<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$uid = $_REQUEST['uid'];
$note = $_REQUEST['notes'];
$result = $db->UpdateNotes($uid, $note);
if ($result != FALSE) {
    $response['message'] = "Successfully updated";
    echo json_encode($response);
} else {
    $response['error'] = TRUE;
    $response['message'] = "Update Error";
    echo json_encode($response);
}

<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

$db = new TransactionFunction();
$response['error'] = false;
$uploadPath = root."/api/img/proof/";
$uploadUrl = "https://dion.co.id/api/img/proof/";

$invoice = $_REQUEST['invoice'];

$proof = $_FILES['proof']['name'];
$fileInfo = pathinfo($_FILES['proof']['name']);
$extension = $fileInfo['extension'];

$file_url = $uploadUrl . $invoice . '.' . $extension;
$file_path = $uploadPath . $invoice . '.' . $extension;

try {
    move_uploaded_file($_FILES['proof']['tmp_name'], $file_path);
    $result = $db->UpdateToPaid($invoice, $file_url);
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
} catch (Exception $e) {
    $response['error'] = true;
    $response['message'] = "Update failed" . $e->getMessage();
}

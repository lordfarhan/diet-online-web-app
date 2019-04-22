<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/transaction/TransactionFunction.php');
$data = json_decode(file_get_contents("php://input"));

if (isset($data->tag) && $data->tag != '') {
    $tag = $data->tag;
    $db = new TransactionFunction();
    $response['error'] = false;
    if ($tag == "post") {
        $user_id = $data->user_id;
        $product_id = $data->product_id;
        $times = $data->times;
        $days = $data->days;
        $amount = $data->amount;
        $notes = $data->notes;
        if ($amount < 0) {
            $response['error'] = true;
            $response['message'] = "Jumlah harus lebih dari 1";
        } else if ($notes == "") {
            $notes = "-";
            $result = $db->InsertTransaction($user_id, $product_id, $days, $times, $amount, $notes);
            $user = $db->GetUser($result['user_id']);
            $package = $db->GetProduct($result['product_id']);
            $response['message'] = "Success Ordering";
            $response['transactions'] = $result;
            $response['user'] = $user;
            $response['product'] = $package;
            echo json_encode($response);
        } else {
            $result = $db->InsertTransaction($user_id, $product_id, $days, $times, $amount, $notes);
            $user = $db->GetUser($result['user_id']);
            $package = $db->GetProduct($result['product_id']);
            $response['message'] = "Success Ordering";
            $response['transactions'] = $result;
            $response['user'] = $user;
            $response['product'] = $package;
            echo json_encode($response);
        }
    } else if ($tag == "update-to-paid") {
        $invoice = $data->invoice;
        $proof = $data->proof;
        $result = $db->UpdateToPaid($invoice, $proof);
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
        }
    } else if ($tag == "update-to-done") {
        $uid = $data->uid;
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
        }
    }
}
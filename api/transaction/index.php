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
            $response['message'] = "Success Ordering";
            $response['invoice'] = $result;
            echo json_encode($response);
        } else {
            $result = $db->InsertTransaction($user_id, $product_id, $days, $times, $amount, $notes);
            $response['message'] = "Success Ordering";
            $response['invoice'] = $result;
            echo json_encode($response);
        }
    } else if ($tag == "update") {
        $invoice = $data->invoice;
        $proof = $data->proof;
        $transaction = $db->Update($invoice, $proof);
        if ($transaction != FALSE) {
            $response['message'] = "Success Updating";
            echo json_encode($response);
        } else {
            $response['error'] = TRUE;
            $response['message'] = "Update Error";
        }
    }
}

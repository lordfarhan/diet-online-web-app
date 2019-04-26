<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/TransactionFunction.php');

if (isset($_REQUEST['tag']) && $_REQUEST['tag'] != '') {
    $tag = $_REQUEST['tag'];
    $db = new TransactionFunction();
    $response['error'] = false;
    if ($tag=="post") {
        $user_id = $_REQUEST['user_id'];
        $product_id = $_REQUEST['product_id'];
        $times = $_REQUEST['times'];
        $days = $_REQUEST['days'];
        $amount = $_REQUEST['amount'];
        $notes = $_REQUEST['notes'];
        if ($amount <= 5) {
            $response['error'] = true;
            $response['message'] = "Jumlah harus lebih dari 1"; 
            echo json_encode($response);
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
        $invoice = $_REQUEST['invoice'];
        $proof = $_REQUEST['proof'];
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
            echo json_encode($response);
        }
    } else if ($tag == "update-to-done") {
        $uid = $_REQUEST['uid'];
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
            echo json_encode($response);
        }
    }
}
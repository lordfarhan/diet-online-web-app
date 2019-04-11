<?php 
if(isset($_POST['tag']) && $_POST['tag'] != '') {
    $tag = $_POST['tag'];
    define('root', $_SERVER['DOCUMENT_ROOT']); 
    require_once(root.'\dion\api\function\TransactionFunctions.php'); 
    $db = new TransactionFunctions();
    // response Array
    $response = array("tag" => $tag, "error" => FALSE);
    if($tag == 'create') {
        $response = array("error" => FALSE);
        if(isset($_POST['product_id']) && isset($_POST['user_id'])) {
            $product_id = $_POST['product_id'];
            $user_id = $_POST['user_id'];
            $notes = $_POST['notes'];
            $times = $_POST['times'];
            $status = $_POST['status'];

            $transaction = $db->createTransaction($product_id, $user_id, $notes, $times, $status);
            if($transaction) {
                $response["error"] = FALSE;
                $response['invoice'] = $transaction['invoice'];
                $response['transaction']['product_id'] = $transaction['product_id'];
                $response['transaction']['user_id'] = $transaction['user_id'];
                $response['transaction']['notes'] = $transaction['notes'];
                $response['transaction']['times'] = $transaction['times'];
                $response['transaction']['status'] = $transaction['status'];
                $response['transaction']['created_at'] = $transaction['created_at'];
                echo json_encode($response);
            } else {
                // user failed to store
                // jika gagal didaftarkan
                $response["error"] = TRUE;
                $response["error_msg"] = "Error in creating transaction!";
                echo json_encode($response);
            }
        } else {
            // jika ada kesalan dalam pendaftaran
            $response["error"] = TRUE;
            $response["error_msg"] = "Parameters is missing!";
            echo json_encode($response);
        }
    } else {
        // user failed to store
        $response["error"] = TRUE;
        $response["error_msg"] = "Unknow 'tag' value. It should be either 'login' or 'register'";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>
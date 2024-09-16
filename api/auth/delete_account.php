<?php
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root . '/api/function/AuthFunctions.php');

$db = new AuthFunctions();
$response['error'] = false;
$user_id = $_REQUEST['user_id'];

$result = $db->DeleteAccount($user_id);
if($result){
    $response['message'] = "Akun berhasil dihapus";
    echo json_encode($response);
} else {
    $response['error'] = true;
    $response['message'] = "Akun gagal dihapus";
    echo json_encode($response);
}
?>
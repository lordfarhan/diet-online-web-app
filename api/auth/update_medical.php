<?php
// Request type is check Login
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root.'/api/function/AuthFunctions.php');
$db = new AuthFunctions();
// response Array
$response = array("error" => FALSE);
if (isset($_POST['username']) && isset($_POST['password'])) {
    // receiving the post params
    // menangkap data yang dikirimkan sebelumnya -> POST
    $username = $_POST['username'];
    $password = $_POST['password'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $prohibition = $_POST['prohibition'];

    if($db->getUserByUsernameAndPassword($username, $password)) {
        $user = $db->updateMedicalInfo($username, $weight, $height, $prohibition);
        if ($user != false) {
            // user stored successfully
            // jika sukses, maka akan ditampilkan hasil pendaftaran
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["username"] = $user["username"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["city"] = $user["city"];
            $response["user"]["subdistrict"] = $user["subdistrict"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["nickname"] = $user["nickname"];
            $response["user"]["address"] = $user["address"];
            $response["user"]["phone"] = $user["phone"];
            $response["user"]["birth_date"] = $user["birth_date"];
            $response["user"]["gender"] = $user["gender"];
            $response["user"]["weight"] = $user["weight"];
            $response["user"]["height"] = $user["height"];
            $response['user']['prohibition'] = $user['prohibition'];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            //ditampilkan dalam bentuk json
            echo json_encode($response);
        } else {
            // user failed to store
            // jika gagal didaftarkan
            $response["error"] = TRUE;
            $response["error_msg"] = "Error in registration!";
            echo json_encode($response);
        }
    } else {
        $response['error'] = TRUE;
        $response['error_msg'] = "Your password is wrong";
        echo json_encode($response);
    }

} else {
    // jika ada kesalan dalam pendaftaran
    $response["error"] = TRUE;
    $response["error_msg"] = "Parameters is missing!";
    echo json_encode($response);
}

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
    $city = $_POST['city'];
    $subdistrict = $_POST['subdistrict'];
    $name = $_POST['name'];
    $nickname = $_POST['nickname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birth_date'];
    $gender = $_POST['gender'];

    if($db->getUserByUsernameAndPassword($username, $password)) {
        $user = $db->updatePersonalInfo($username, $city, $subdistrict, $name, $nickname, $address, $phone, $birthdate, $gender);
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

<?php
// Request type is check Login
define('root', $_SERVER['DOCUMENT_ROOT']);
require_once(root.'/api/function/AuthFunctions.php');
$db = new AuthFunctions();
// response Array
$response = array("error" => FALSE);
// receiving the post params
if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
    // menangkap data yang dikirimkan sebelumnya -> POST
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    // get the user by email and password
    // menangkap data yang dikirimkan sebelumnya -> POST
    $user = $db->getUserByUsernameAndPassword($username, $password);
    if ($user != false) {
        // use is found
        // jika user telah ditemukan dan cocok pada database, maka akan dimunculkan data user
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
        // ditampilkan dalam bentuk json
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        // jika user tidak ditemukan maka akan muncul pesan
        $response["error"] = TRUE;
        $response["error_msg"] = "Login not matched. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    // jika tidak ada inputan untuk login
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
?>

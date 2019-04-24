<?php
/**
 * File to handle all API requests
 * Accepts GET and POST
 * 
 * Each request will be identified by TAG
 * Response will be JSON data
 * check for POST request 
 */
if (isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];
    // include db handler
    define('root', $_SERVER['DOCUMENT_ROOT']); 
    require_once(root.'/api/function/AuthFunctions.php'); 
    $db = new AuthFunctions();
    // response Array
    $response = array("tag" => $tag, "error" => FALSE);
    // check for tag type
    if ($tag == 'login') {
        // Request type is check Login
        if (isset($_POST['username']) && isset($_POST['password'])) {
            // receiving the post params
            // menangkap data yang dikirimkan sebelumnya -> POST
            $username = $_POST['username'];
            $password = $_POST['password'];
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
    } else if ($tag == 'register') {
        // Request type is Register new user
        // json response array
        // memeriksa respon json
        $response = array("error" => FALSE);
        if (isset($_POST['email']) && isset($_POST['password'])) {
            // receiving the post params
            // menangkap data yang dikirimkan sebelumnya -> POST
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $city = $_POST['city'];
            $subdistrict = $_POST['subdistrict'];
            $name = $_POST['name'];
            $nickname = $_POST['nickname'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $birthdate = $_POST['birth_date'];
            $gender = $_POST['gender'];
            // check if user is already existed with the same email
            // memeriksa apakah user telah terdaftar sebelumnya
            if ($db->isEmailExisted($email)) {
                // user already existed
                // jika user telah terdaftar
                $response["error"] = TRUE;
                $response["error_msg"] = "Already registered with " . $email;
                echo json_encode($response);
            } else if ($db->isUsernameExisted($username)){
                // user already existed
                // jika user telah terdaftar
                $response["error"] = TRUE;
                $response["error_msg"] = "Already registered with " . $username;
                echo json_encode($response);
            } else {
                // create a new user
                // jika user belum terdaftar maka membuat user baru
                $user = $db->storeUser($username, $email, $password, $city, $subdistrict, $name, $nickname, $address, $phone, $birthdate, $gender);
                if ($user) {
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
            }
        } else {
            // jika ada kesalan dalam pendaftaran
            $response["error"] = TRUE;
            $response["error_msg"] = "Parameters is missing!";
            echo json_encode($response);
        }
    } else if ($tag == 'update_personal_info') {
        // Request type is Update user data
        // json response array
        // memeriksa respon json
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
                $user = $db->updatePersonalInfo($city, $subdistrict, $name, $nickname, $address, $phone, $birthdate, $gender);
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
    } else if ($tag == 'update_account_info') {
        // Request type is Update user data
        // json response array
        // memeriksa respon json
        $response = array("error" => FALSE);
        if (isset($_POST['old_username']) && isset($_POST['password'])) {
            // receiving the post params
            // menangkap data yang dikirimkan sebelumnya -> POST
            $old_username = $_POST['old_username'];
            $old_email = $_POST['old_email'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if($db->getUserByUsernameAndPassword($old_username, $password)) {
                if ($db->isUsernameExisted($username) == FALSE || $old_username == $username) {
                    if ($db->isEmailExisted($email) == FALSE || $old_email == $email) {
                        $user = $db->updateAccountInfo($old_username, $username, $email, $password);
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
                        $response["error"] = TRUE;
                        $response["error_msg"] = "Your new email has been used";
                        echo json_encode($response);
                    }
                } else {
                    $response["error"] = TRUE;
                    $response["error_msg"] = "Your new username has been used";
                    echo json_encode($response);
                }
            } else {
                $response["error"] = TRUE;
                    $response["error_msg"] = "Your password is wrong";
                    echo json_encode($response);
            }
            
        } else {
            // jika ada kesalan dalam pendaftaran
            $response["error"] = TRUE;
            $response["error_msg"] = "Parameters is missing!";
            echo json_encode($response);
        }
    } else if ($tag == 'update_medical_info') {
        // Request type is Update user data
        // json response array
        // memeriksa respon json
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
    } else {
        // user failed to store
        $response["error"] = TRUE;
        $response["error_msg"] = "Unknow 'tag' value. It should be either 'login' or 'register or secified update'";
        echo json_encode($response);
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>
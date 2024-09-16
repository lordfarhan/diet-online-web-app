<?php
class AuthFunctions
{
    private $db;
    private $conn;
    //put your code here
    // constructor
    function __construct()
    {

        require_once(root . '/api/config/DB_Connect.php');
        // connecting to database
        // mengkoneksikan ke
        $this->db = new DB_Connect();
        $this->conn = $this->db->connect();
    }
    // destructor
    function __destruct()
    { }
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($username, $email, $password, $city, $subdistrict, $name, $nickname, $address, $phone, $birthdate, $gender)
    {
        $uuid = uniqid();
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt untuk menggadakan keamanan

        $date = date("Y-m-d H:i:s");
        $weight = 0;
        $height = 0;
        $prohibition = "-";
        $updated_at = $date;

        $convert_birth_date = strtotime($birthdate);
        $birth_date = date('Y-m-d', $convert_birth_date);
        //perintah memsaukkan ke table users dan row
        $stmt = $this->conn->prepare("INSERT INTO users(unique_id, username, email, encrypted_password, salt, city, subdistrict, name, nickname, address, phone, birth_date, gender, weight, height, prohibition, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        //isi data dari variabel yang akan dimasukkan ke database
        // varibel -> ke symbol 's' -> ke symbol '?' (banyak symbol 's' sesuai dengan banyak variabel dan symbol '?')
        $stmt->bind_param("ssssssssssssssssss", $uuid, $username, $email, $encrypted_password, $salt, $city, $subdistrict, $name, $nickname, $address, $phone, $birth_date, $gender, $weight, $height, $prohibition, $date, $updated_at);
        $result = $stmt->execute();
        $stmt->close();
        // check for successful store
        // memriksa apakah berhasil didaftarkan
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return false;
        }
    }

    /**
     * Update user personal info
     */
    public function updatePersonalInfo($username, $city, $subdistrict, $name, $nickname, $address, $phone, $birthdate, $gender)
    {

        $date = date("Y-m-d H:i:s");

        $convert_birth_date = strtotime($birthdate);
        $birth_date = date('Y-m-d', $convert_birth_date);
        //perintah memsaukkan ke table users dan row
        $stmt = $this->conn->prepare("UPDATE users SET city = ?, subdistrict = ?, name = ?, nickname = ?, address = ?, phone = ?, birth_date = ?, gender = ?, updated_at = ? WHERE username = ?");
        //isi data dari variabel yang akan dimasukkan ke database
        // varibel -> ke symbol 's' -> ke symbol '?' (banyak symbol 's' sesuai dengan banyak variabel dan symbol '?')
        $stmt->bind_param("ssssssssss", $city, $subdistrict, $name, $nickname, $address, $phone, $birth_date, $gender, $date, $username);
        $result = $stmt->execute();
        // if (false === ($stmt = $this->conn->prepare("UPDATE users SET city = ?, subdistrict = ?, name = ?, nickname = ?, address = ?, phone = ?, birth_date = ?, gender = ?, updated_at = ? WHERE username = ?"))) {
        //     echo 'error preparing statement: ' . $this->conn->error;
        // } elseif (!$stmt->bind_param("ssssssssss", $city, $subdistrict, $name, $nickname, $address, $phone, $birth_date, $gender, $date, $username)) {
        //     echo 'error binding params: ' . $stmt->error;
        // } elseif (!$stmt->execute()) {
        //     echo 'error executing statement: ' . $stmt->error;
        // }
        $stmt->close();
        // check for successful store
        // memriksa apakah berhasil didaftarkan
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return false;
        }
    }

    /**
     * Update account info
     */

    public function updateAccountInfo($old_username, $username, $email, $password)
    {
        $date = date("Y-m-d H:i:s");

        $stmt = $this->conn->prepare("UPDATE users SET username = ?, email = ?, updated_at = ? WHERE username = ?");
        $stmt->bind_param("ssss", $username, $email, $date, $old_username);

        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return false;
        }
    }

    /**
     * Update account info
     */

    public function updateMedicalInfo($username, $weight, $height, $prohibition)
    {
        $date = date("Y-m-d H:i:s");

        $stmt = $this->conn->prepare("UPDATE users SET weight = ?, height = ?, prohibition = ?, updated_at = ? WHERE username = ?");
        $stmt->bind_param("sssss", $weight, $height, $prohibition, $date, $username);

        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return false;
        }
    }

    /**
     * Get user by username and password
     */
    public function getUserByUsernameAndPassword($username, $password)
    {
        // memanggil data yang sesuai dengan username
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        if ($stmt->execute()) {
            //menyiapkan data yg diambil, fetch data
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            // ferifikasi kecocokan password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);

            // check for password equality
            // jika password sesuai dengan database
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                // maka dapat diambil dari database
                return $user;
            }
        } else {
            return NULL;
        }
    }
    /**
     * Check user is existed or not (email)
     */
    public function isEmailExisted($email)
    {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            // user existed
            // jika user sudah terdaftar maka data yg dikembalikan true
            $stmt->close();
            return true;
        } else {
            // user not existed
            // jika user belum terdaftar maka data yg dikembalikan false
            $stmt->close();
            return false;
        }
    }
    /**
     * Check user is existed or not (username)
     */
    public function isUsernameExisted($username)
    {
        $stmt = $this->conn->prepare("SELECT username from users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            // user existed
            // jika user sudah terdaftar maka data yg dikembalikan true
            $stmt->close();
            return true;
        } else {
            // user not existed
            // jika user belum terdaftar maka data yg dikembalikan false
            $stmt->close();
            return false;
        }
    }
    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     * tambahan keamanan enkripsi password
     */
    public function hashSSHA($password)
    {
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     * fungsi untuk memeriksa enkripsi pada saat login
     */
    public function checkhashSSHA($salt, $password)
    {
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
        return $hash;
    }

    public function DeleteAccount($user_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM `users` WHERE `unique_id`=?");
        $stmt->bind_param("s", $user_id);
        if ($stmt != FALSE) {
            if ($stmt->execute()) {
                $stmt->close();
                $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `unique_id` = ?");
                $stmt->bind_param("s", $user_id);
                if ($stmt != false) {
                    if ($stmt->execute()) {
                        $result = $stmt->get_result()->fetch_assoc();
                        $stmt->close();
                        if ($result == NULL) {
                            return true;
                        } else {
                            $response['error'] = true;
                            $response['message'] = "Terjadi kesalahan dalam menghapus akun";
                            echo json_encode($response);
                        }
                    }
                } else {
                    $response['error'] = true;
                    $response['message'] = "Terjadi kesalahan dalam menghapus akun";
                    echo json_encode($response);
                }
            } else {
                $response['error'] = true;
                $response['message'] = "Terjadi kesalahan dalam menghapus akun";
                echo json_encode($response);
            }
        } else {
            $response['error'] = true;
            $response['message'] = "Terjadi kesalahan dalam menghapus akun";
            echo json_encode($response);
        }
    }
}

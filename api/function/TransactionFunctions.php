<?php 
class TransactionFunctions {
    private $db;
    private $conn;
    //put your code here
    // constructor
    function __construct() {
        
        require_once(root.'\dion\api\config\DB_Connect.php'); 
        // connecting to database
        // mengkoneksikan ke
        $this->db = new DB_Connect();
        $this->conn = $this->db->connect();
    }

    function __destruct() {

    }

    public function createTransaction($product_id, $user_id, $notes, $times, $status) {
        $uid = uniqid('INV-');
        $date = date("Y-m-d H:i:s");
        $stmt = $this->conn->prepare("INSERT INTO transactions(invoice, product_id, user_id, notes, times, status, created_at) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $uid, $product_id, $user_id, $notes, $times, $status, $date);
        $result = $stmt->execute();
        $stmt->close();
        // check for successful store
        // memriksa apakah berhasil didaftarkan
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * from transactions where invoice = '$uid'");
            $stmt->execute();
            $transaction = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $transaction; 
        } else {
            return false;
        }
    }
}

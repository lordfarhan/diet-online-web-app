<?php
    class connection{

        public function connect(){
            require_once "DB.php";
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(mysql_error());
            return $conn;
        }

        public function close(){
            mysql_close();
        }
    }
?>
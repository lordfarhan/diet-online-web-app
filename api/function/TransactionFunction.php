<?php
class TransactionFunction
{
    private $db;
    private $conn;

    function __construct()
    {
        require_once(root . '/api/config/DB_Connect.php');
        $this->db = new DB_Connect;
        $this->conn = $this->db->connect();
    }

    public function InsertTransaction($user_id, $product_id, $days, $times, $amount, $notes)
    {
        $invoice = uniqid("INV", false);
        $date = date('d');
        $hari = date('N') - 1;
        $bulan = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $bulanSekarang = date('n');

        $pecahanwaktu = [0, 0, 0];
        $booleanwaktu = [0, 0, 0];
        for ($i = 0; $i < 3; $i++) {
            if (is_array($pecahanwaktu)) {
                $pecahanwaktu[$i] = \substr($times, $i, 1);
                if ($pecahanwaktu[$i] == 1) {
                    $booleanwaktu[0] = 1;
                } else if ($pecahanwaktu[$i] == 2) {
                    $booleanwaktu[1] = 1;
                } else if ($pecahanwaktu[$i] == 3) {
                    $booleanwaktu[2] = 1;
                }
            } else {
                $booleanwaktu[$times - 1] = 1;
            }
        }

        $pecahanhari = [0, 0, 0, 0, 0, 0, 0];
        $booleanhari = [0, 0, 0, 0, 0, 0, 0];

        for ($i = 0; $i < 7; $i++) {
            if (is_array($pecahanhari)) {
                $pecahanhari[$i] = \substr($days, $i, 1);
                if ($pecahanhari[$i] == 1) {
                    $booleanhari[0] = 1;
                } else if ($pecahanhari[$i] == 2) {
                    $booleanhari[1] = 1;
                } else if ($pecahanhari[$i] == 3) {
                    $booleanhari[2] = 1;
                } else if ($pecahanhari[$i] == 4) {
                    $booleanhari[3] = 1;
                } else if ($pecahanhari[$i] == 5) {
                    $booleanhari[4] = 1;
                } else if ($pecahanhari[$i] == 6) {
                    $booleanhari[5] = 1;
                } else if ($pecahanhari[$i] == 7) {
                    $booleanhari[6] = 1;
                }
            } else {
                $booleanhari[$days - 1] = 1;
            }
        }

        $startHari = 0;
        if($startHari+1>=7){
            $startHari=($hari + 1) == 7 ? 6 : ($hari + 1) % 6;
            $pengali=1;
        } else {
            $startHari = ($hari + 1) == 7 ? 6 : ($hari + 1) % 6;
        }
        $kontrolsekali = true;
        $pengali = 0;
        $bulanPesanan = date('n');
        $tahunPesanan = date("Y");
        $date = $date - $hari;
        $temp = $amount;
        $check = false;
        for ($banyak = 0; $banyak < $temp;) {
            if ($temp != $amount) {
                $banyak++;
            }
            for ($i = $kontrolsekali ? $startHari : 0; $i < 7; $i++) {
                if ($booleanhari[$i] == 1) {
                    $tanggalPesanan = $date + $i + ($pengali * 7);
                    if ($tanggalPesanan > (365 - date('z'))) {
                        $tahunPesanan += 1;
                        $bulanPesanan = 1;
                        $tanggalPesanan -= 365 - date('z');
                        if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1] + $bulan[$bulanSekarang + 2]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1] + $bulan[$bulanSekarang + 2]);
                            $bulanPesanan = $bulanSekarang + 4;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1]);
                            $bulanPesanan = $bulanSekarang + 3;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1]);
                            $bulanPesanan = $bulanSekarang + 2;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang - 1]);
                            $bulanPesanan = $bulanSekarang + 1;
                        } else {
                            $bulanPesanan = $bulanSekarang;
                        }
                    } else {
                        if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1] + $bulan[$bulanSekarang + 2]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1] + $bulan[$bulanSekarang + 2]);
                            $bulanPesanan = $bulanSekarang + 4;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1] + $bulan[$bulanSekarang + 1]);
                            $bulanPesanan = $bulanSekarang + 3;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang] + $bulan[$bulanSekarang - 1]);
                            $bulanPesanan = $bulanSekarang + 2;
                        } else if ($tanggalPesanan > $bulan[$bulanSekarang - 1]) {
                            $tanggalPesanan = $date + $i + ($pengali * 7) - ($bulan[$bulanSekarang - 1]);
                            $bulanPesanan = $bulanSekarang + 1;
                        } else {
                            $bulanPesanan = $bulanSekarang;
                        }
                    }
                }
                if ($i == 6) {
                    $kontrolsekali = false;
                    $pengali++;
                }
                for ($j = 1; $j <= 3; $j++) {
                    if ($amount == 0) {
                        break;
                    }
                    if ($booleanhari[$i] == 1 && $booleanwaktu[$j - 1] == 1) {
                        if ($amount != 0) {
                            $dateInput = $tanggalPesanan . "-" . $bulanPesanan . "-" . $tahunPesanan;
                            $datePesanan = DateTime::createFromFormat('d-m-Y', $dateInput)->format('Y-m-d');
                            $datenow = date("Y-m-d H:i:s");
                            $stmt = $this->conn->prepare("INSERT INTO `transactions`(`invoice`, `product_id`, `user_id`, `date`, `notes`, `times`, `proof_of_payment`, `status`, `created_at`, `updated_at`) VALUES(?,?,?,?,?,?,?,?,?,?)");
                            $status = 1;
                            $proof = " ";
                            if ($stmt != FALSE) {
                                $stmt->bind_param("ssssssssss", $invoice, $product_id, $user_id, $datePesanan, $notes, $j, $proof, $status, $datenow, $datenow);
                                $amount--;
                                if ($stmt->execute()) {
                                    $stmt->close();
                                    $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE invoice =? LIMIT 1");
                                    $stmt->bind_param("s", $invoice);
                                    $stmt->execute();
                                    $transactions = $stmt->get_result()->fetch_assoc();
                                    $stmt->close();
                                    $check = true;
                                } else {
                                    $response['error'] = true;
                                    $response['message'] = "Data not inserted";
                                    echo json_encode($response);
                                }
                            } else {
                                $response['error'] = true;
                                $response['message'] = "Post Error";
                                echo json_encode($response);
                            }
                        }
                    }
                }
            }
        }
        if ($check) {
            return $transactions;
        } else {
            return false;
        }
    }

    public function UpdateToPaid($invoice, $proof)
    {
        $hours = (date('H') + 7) % 24;
        $hours = 2;
        if ($hours > 17) {
            $this->Delete($invoice);
            return false;
        } else {
            $stmt = $this->conn->prepare("UPDATE `transactions` SET `status`=? , `proof_of_payment`=? WHERE `invoice`=? ");
            $status = 2;
            if ($stmt != FALSE) {
                $stmt->bind_param("sss", $status, $proof, $invoice);
                if ($stmt->execute()) {
                    $stmt->close();
                    $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE invoice=?");
                    $stmt->bind_param("s", $invoice);
                    $stmt->execute();
                    $transactions = $stmt->get_result()->fetch_assoc();
                    $stmt->close();
                    return $transactions;
                } else {
                    $response['error'] = true;
                    $response['message'] = "Database not Updated";
                    echo json_encode($response);
                    return false;
                }
            } else {
                $response['error'] = true;
                $response['message'] = "Update Error";
                echo json_encode($response);
                return false;
            }
        }
    }


    public function UpdateToDone($uid)
    {
        $stmt = $this->conn->prepare("UPDATE transactions SET status=? WHERE id=? ");
        $status = 3;
        if ($stmt != false) {
            $stmt->bind_param("ii", $status, $uid);
            if ($stmt->execute()) {
                $stmt->close();
                $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE id=?");
                $stmt->bind_param("s", $uid);
                $stmt->execute();
                $transactions = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $transactions;
            } else {
                $response['error'] = true;
                $response['message'] = "Database not Updated";
                echo json_encode($response);
                return false;
            }
        } else {
            $response['error'] = true;
            $response['message'] = "Update Query Error";
            echo json_encode($response);
            return false;
        }
    }

    public function Delete($invoice)
    {
        $stmt = $this->conn->prepare("DELETE FROM `transactions` WHERE `invoice`=?");
        if ($stmt != false) {
            $stmt->bind_param("s", $invoice);
            $stmt->execute();
            $stmt->close();
        } else {
            $response['error'] = true;
            $response['message'] = "Delete Error";
            echo json_encode($response);
            return false;
        }
    }

    public function GetUser($unique_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE unique_id = ?");
        $stmt->bind_param("s", $unique_id);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        } else {
            return NULL;
        }
    }

    public function GetProduct($unique_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM packages WHERE unique_id = ?");
        $stmt->bind_param("s", $unique_id);
        if ($stmt->execute()) {
            $package = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $package;
        } else {
            return NULL;
        }
    }

    public function FetchData($user_id, $status)
    {
        $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE user_id=? AND status=?");
        if ($stmt != FALSE) {
            $stmt->bind_param("si", $user_id, $status);
            if ($stmt->execute()) {
                $transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                if (!$transactions) {
                    return NULL;
                } else {
                    return $transactions;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function FetchAmount($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE user_id = ?");
        $amount = [0, 0, 0, 0];
        if ($stmt != FALSE) {
            $stmt->bind_param("s", $user_id);
            if ($stmt->execute()) {
                $transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $amount[3] = count($transactions);
                $stmt->close();
                if (!$transactions) {
                    return NULL;
                } else {
                    for ($i = 0; $i < $amount[3]; $i++) {
                        if ($transactions[$i]['status'] == 1) {
                            $amount[0]++;
                        } else if ($transactions[$i]['status']==2) {
                            $amount[1]++;
                        } else {
                            $amount[2]++;
                        }
                    }
                    return $amount;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

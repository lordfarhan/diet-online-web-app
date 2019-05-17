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
        if ($this->CheckUserUnpaid($user_id)) {
            $response['error'] = true;
            $response['message'] = "Please finish your previous transaction";
            echo json_encode($response);
        } else {
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
            $jam = date('H') + 7 % 24;
            $pengali = 0;
            if ($jam > 17) {
                if ($startHari + 1 > 7) {
                    $startHari = 0;
                    $pengali = 1;
                }
            }
            if ($startHari + 1 >= 7) {
                $startHari = ($hari + 1) == 7 ? 6 : ($hari + 1) % 6;
                $pengali = 1;
            } else {
                $startHari = ($hari + 1) == 7 ? 6 : ($hari + 1) % 6;
            }
            $kontrolsekali = true;
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
                        } else if ($transactions[$i]['status'] == 2) {
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

    public function DietMayo($user_id, $notes)
    {
        if ($this->CheckUserUnpaid($user_id)) {
            $response['error'] = true;
            $response['message'] = "Please finish your previous transaction";
            echo json_encode($response);
        } else {
            $invoice = uniqid("INV", false);
            $hariSekarang = date('N') - 1; //0 untuk senin 6 untuk minggu
            $jamSekarang = date('H') + 7 % 24;
            $date = date('d');
            $bulan = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
            $bulanSekarang = date('n');
            $tahunSekarang = date('Y');
            $check = false;

            if ($hariSekarang == 6 || $hariSekarang == 5 && $jamSekarang > 17) {
                $startTanggal = $date - $hariSekarang + 14;
            } else {
                $startTanggal = $date - $hariSekarang + 7;
            }

            $tanggalPesanan = $startTanggal;
            $bulanPesanan = $bulanSekarang;
            $tahunPesanan = $tahunSekarang;
            for ($i = 0; $i < 13; $i++) {
                $check = false;
                if ($bulanSekarang == 11 && $tanggalPesanan + 1 > $bulan[$bulanPesanan - 1]) {
                    $tahunPesanan++;
                    $bulanPesanan = 0;
                } else if ($tanggalPesanan + 1 > $bulan[$bulanPesanan - 1]) {
                    $bulanPesanan++;
                    $tanggalPesanan =1;
                }
                $dateInput = $tanggalPesanan . "-" . $bulanPesanan . "-" . $tahunPesanan;
                $datePesanan = DateTime::createFromFormat('d-m-Y', $dateInput)->format('Y-m-d');
                $datenow = date("Y-m-d H:i:s");
                for ($j = 2; $j < 4; $j++) {
                    $stmt = $this->conn->prepare("INSERT INTO `transactions`(`invoice`, `product_id`, `user_id`, `date`, `notes`, `times`, `proof_of_payment`, `status`, `created_at`, `updated_at`) VALUES(?,?,?,?,?,?,?,?,?,?)");
                    $status = 1;
                    $proof = " ";
                    $product_id = "WL001";
                    if ($notes == "") {
                        $notes = "-";
                    }
                    if ($stmt != false) {
                        $stmt->bind_param("ssssssssss", $invoice, $product_id, $user_id, $datePesanan, $notes, $j, $proof, $status, $datenow, $datenow);
                        $stmt->execute();
                        $stmt->close();
                        $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE invoice=? AND date=?");
                        if ($stmt != false) {
                            $stmt->bind_param("ss", $invoice, $datePesanan);
                            $stmt->execute();
                            $transaction = $stmt->get_result()->fetch_assoc();
                            if ($transaction != NULL) {
                                $check = true;
                            }
                        }
                    } else {
                        $response['error'] = true;
                        $response['message'] = "Terjadi kesalahan dalam input database";
                        echo json_encode($response);
                    }
                }
                $tanggalPesanan++;
            }

            $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE invoice=?");
            if ($stmt != false) {
                $stmt->bind_param("s", $invoice);
                if ($stmt->execute()) {
                    $transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    $stmt->close();
                    if ($transactions != NULL) {
                        $check = true;
                    } else {
                        $check = false;
                    }
                }
            }
            if ($check) {
                return $transactions;
            } else {
                $response['error'] = true;
                $response['message'] = "Terjadi kesalahan dalam input database";
                echo json_encode($response);
            }
        }
    }

    public function DietKhusus($user_id, $product_id, $days, $times, $amount, $notes, $activity)
    {
        if ($this->CheckUserUnpaid($user_id)) {
            $response['error'] = true;
            $response['message'] = "Please finish your previous transaction";
            echo json_encode($response);
        } else {
            //Activity
            //0= No exercise, 1=Light, 2=Moderate, 3= Heavy, 4=Very Heavy
            $invoice = uniqid("INV", false);
            $date = date('d');
            $hari = date('N') - 1;
            $bulan = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
            $bulanSekarang = date('n');
            $tahunSekarang = date('Y');
            $user = $this->GetUser($user_id);
            $weight = $user['weight'];
            $height = $user['height'];
            $gender = $user['gender']; //0 = Laki Laki, 1 = Perempuan
            $birth_date = $user['birth_date'];
            $splitBirthDate = explode('-', $birth_date);
            $age = $tahunSekarang - $splitBirthDate[0];
            $statusGizi = 0; //1=Kurus, 2=Normal, 3=Overweight, 4=Obesitas
            $bmi = $weight / (($height / 100.0) * ($height / 100.0));
            $adjustedWeight = 0;
            $bmr = 0;
            $dailyCalories = 0;
            if ($bmi < 18.5) {
                $statusGizi = 1;
            } else if ($bmi < 25.1) {
                $statusGizi = 2;
            } else if ($bmi < 27.1) {
                $statusGizi = 3;
            } else {
                $statusGizi = 4;
            }
            switch ($statusGizi) {
                case 1:
                    $adjustedWeight = $weight;
                    break;
                case 2:
                    $adjustedWeight = $weight;
                case 3:
                    $adjustedWeight = ($height - 100) - (0.1 * ($height - 100));
                    break;
                case 4:
                    $adjustedWeight = ($weight - (($height - 100) - (0.1 * ($height - 100)))) * 0.25 + ($height - 100) - (0.1 * ($height - 100));
                    break;
            }
            //BMR
            switch ($gender) {
                case 0:
                    $bmr = 66 + (13.7 * $adjustedWeight) + (5 * $height) - (6.76 * $age);
                    break;
                case 1:
                    $bmr = 655 + (9.6 * $adjustedWeight) + (1.8 * $height) - (4.7 * $age);
                    break;
            }

            switch ($activity) {
                case 0:
                    $dailyCalories = $bmr * 1.2;
                    break;
                case 1:
                    $dailyCalories = $bmr * 1.375;
                    break;
                case 2:
                    $dailyCalories = $bmr * 1.55;
                    break;
                case 3:
                    $dailyCalories = $bmr * 1.725;
                    break;
                case 4:
                    $dailyCalories = $bmr * 1.9;
                    break;
            }

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
            $jam = date('H') + 7 % 24;
            $pengali = 0;
            if ($jam > 17) {
                if ($startHari + 1 > 7) {
                    $startHari = 0;
                    $pengali = 1;
                }
            }
            if ($startHari + 1 >= 7) {
                $startHari = ($hari + 1) == 7 ? 6 : ($hari + 1) % 6;
                $pengali = 1;
            } else {
                $startHari = ($hari + 1) == 7 ? 6 : ($hari + 1) % 6;
            }
            $kontrolsekali = true;
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
                                $tempNotes = $notes;
                                $notes = "Daily Calorie : " . $dailyCalories . " calorie \r\n";
                                $notes .= $tempNotes;
                                if ($stmt != FALSE) {
                                    $stmt->bind_param("ssssssssss", $invoice, $product_id, $user_id, $datePesanan, $notes, $j, $proof, $status, $datenow, $datenow);
                                    $amount--;
                                    if ($stmt->execute()) {
                                        $stmt->close();
                                        $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE invoice =? LIMIT 1");
                                        $stmt->bind_param("s", $invoice);
                                        $stmt->execute();
                                        $stmt->close();
                                        $notes = $tempNotes;
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

            $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE invoice=?");
            if ($stmt != false) {
                $stmt->bind_param("s", $invoice);
                if ($stmt->execute()) {
                    $transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    $stmt->close();
                    if ($transactions != NULL) {
                        $check = true;
                    } else {
                        $check = false;
                    }
                }
            }

            if ($check) {
                return $transactions;
            } else {
                return false;
            }
        }
    }

    public function CheckUserUnpaid($user_id) {
        $check = true;
        $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE user_id=? && status=?");
        if ($stmt != false) {
            $status = 1;
            $stmt->bind_param("si", $user_id, $status);
            if ($stmt->execute()) {
                $transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                if ($transactions != NULL) {
                    return $check;
                } else {
                    return $check = false;
                }
            } else {
                $response['error'] = true;
                $response['message'] = "Error in executing";
                echo json_encode($response);
            }
        } else {
            $response['error'] = true;
            $response['message'] = "SQL Statement Error";
            echo json_encode($response);
        }
        return $check;
    }

    public function UpdateNotes($id, $note)
    {
        $stmt = $this->conn->prepare("UPDATE transactions SET notes=? WHERE id=?");
        if ($stmt != false) {
            $stmt->bind_param("si", $note, $id);
            if ($stmt->execute()) {
                $stmt->close();
                $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE id=?");
                $stmt->bind_param("s", $id);
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

    public function getByInvoice($invoice) {
        $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE invoice = ?");
        if ($stmt) {
            $stmt->bind_param("s", $invoice);
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

    public function getPackagePrice($invoice) {
        $transactions = $this->getByInvoice($invoice);
        $product_id = $transactions[0]['product_id'];
        $stmt = $this->conn->prepare("SELECT * FROM packages WHERE unique_id = ?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $package = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $package;
    }

    //Transaksi ada batas jam 5
    //Realtime jam 5 dihapus semua yang unpaid
    //Mail(Menyusul)
}

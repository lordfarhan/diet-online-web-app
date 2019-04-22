<?php
class TransactionFunction
{
    private $db;
    private $conn;

    function __construct()
    {
        require_once(root . '/api/config/connection.php');
        $this->db = new connection;
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
        $startHari = ($hari + 1) == 7 ? 6 : ($hari + 1) % 6;
        $kontrolsekali = true;
        $pengali = 0;
        $bulanPesanan = date('n');
        $tahunPesanan = date("Y");
        $date = $date - $hari;
        while ($amount > 0) {
            for ($i = $kontrolsekali ? $startHari : 0; $i < 7; $i++) {
                if ($booleanhari[$i] == 1) {
                    $tanggalPesanan = $date + $i + ($pengali * 7);
                    if ($tanggalPesanan > (365 - date('z'))) {
                        echo "masuk";
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
                    if ($booleanhari[$i] == 1 && $booleanwaktu[$j - 1] == 1 && $amount != 0) {
                        $dateInput = $tanggalPesanan . "-" . $bulanPesanan . "-" . $tahunPesanan;
                        $datePesanan = DateTime::createFromFormat('d-m-Y', $dateInput)->format('Y-m-d');
                        $datenow = date("Y-m-d H:i:s");
                        $stmt = $this->conn->prepare("INSERT INTO `transactions`(`invoice`, `product_id`, `user_id`, `date`, `notes`, `times`, `proof_of_payment`, `status`, `created_at`, `updated_at`) VALUES(?,?,?,?,?,?,?,?,?,?)");

                        $status = 1;
                        $proof = " ";
                        $stmt->bind_param("ssssssssss", $invoice, $product_id, $user_id, $datePesanan, $notes, $j, $proof, $status, $datenow, $datenow);
                        $result = $stmt->execute();
                        $amount--;
                        $stmt->close();
                        if ($result) {
                            $stmt = $this->conn->prepare("SELECT * FROM `transactions` WHERE 'invoice' =? AND 'date'=? AND 'times'=?");
                            $stmt->bind_param("sss", $invoice, $dateInput, $j);
                            $result = $stmt->execute();
                            $transactions = $stmt->get_result()->fetch_assoc();
                            $stmt->close();
                            return $transactions;
                        } else {
                            return false;
                        }
                    }
                }
            }
        }
    }

    public function Update($invoice, $proof)
    {
        $stmt = $this->conn->prepare("SELECT * FROM `transactions` WHERE `invoice`=?");
        $stmt->bind_param("s", $invoice);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            $hours = (date('H') + 7) % 24;
            if ($hours > 17) {
                $this->Delete($invoice);
            } else {
                $stmt = $this->conn->prepare("UPDATE `transactions` SET `status`=? , `proof_of_payment`=? WHERE `invoice`=? ");
                $status = 2;
                $stmt->bind_param("sss", $status, $proof, $invoice);
                $result = $stmt->execute();
                $stmt->close();
                if ($result) {
                    $stmt = $this->conn->prepare("SELECT * FROM `transactions` WHERE `invoice`=?");
                    $stmt->bind_param("s", $invoice);
                    $result = $stmt->execute();
                    $transactions = $stmt->get_result()->fetch_assoc();
                    $stmt->close();
                    return $transactions;
                } else {
                    $response['error'] = true;
                    $response['message'] = "Cant make Transaction";
                    echo json_encode($response);
                }
                // $sql = "UPDATE `transactions` SET `status`=2,`proof_of_payment`=".$proof." WHERE `invoice`=".$invoice;

                // if($this->conn->query($sql)){
                //     echo "Done";
                // } else {
                //     echo "gagal";
                // }
            }
        } else {
            return false;
        }
    }

    public function Delete($invoice)
    {
        $stmt = $this->conn->prepare("DELETE FROM `transactions` WHERE `invoice`=?");
        $stmt->bind_param("s", $invoice);
        $stmt->execute();
        $stmt->close();
    }
}

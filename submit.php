<?php

    class Database {
        private $host = "localhost";
        private $db_name = "onlineform";
        private $username = "root";
        private $password = "";

        public function connect() {
            $this->conn = null;
            try{
                $this->conn = new PDO(
                    "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                    $this->username,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );               
            } catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $db = (new Database())->connect();

        $first_name   = trim($_POST['fname'] ?? '');
        $middle_name  = trim($_POST['mname'] ?? '');
        $last_name    = trim($_POST['lname'] ?? '');
        $date_of_birth= trim($_POST['dob'] ?? null); // YYYY-MM-DD
        $sex          = trim($_POST['sex'] ?? '');
        $civil_status = trim($_POST['civilStatus'] ?? '');
        $nationality  = trim($_POST['nationality'] ?? '');
        $place_of_birth = trim($_POST['pofbirth'] ?? '');
        $home_address = trim($_POST['homeAdd'] ?? '');
        $phone_number = trim($_POST['pNum'] ?? '');
        $email_address= trim($_POST['emailAdd'] ?? '');


    $sql = "INSERT INTO user(first_name, middle_name, last_name, date_of_birth, sex, civil_status, nationality, place_of_birth, home_address, phone_number, email_address) 
            VALUES(:first_name, :middle_name, :last_name, :date_of_birth, :sex, :civil_status, :nationality, :place_of_birth, :home_address, :phone_number, :email_address)";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':first_name' => $first_name,
        ':middle_name'=> $middle_name,
        ':last_name'  => $last_name,
        ':date_of_birth' => $date_of_birth ?: null,
        ':sex'        => $sex,
        ':civil_status'=> $civil_status,
        ':nationality'=> $nationality,
        ':place_of_birth'=> $place_of_birth,
        ':home_address'=> $home_address,
        ':phone_number'=> $phone_number,
        ':email_address'=> $email_address
    ]);

    if ($stmt->rowCount()) {
        echo "Record saved successfully.";
    } else {
        echo "Insert failed.";
    }
}

    ?>
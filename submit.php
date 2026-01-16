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
        $suffix       = trim($_POST['suffix'] ?? '');
        $date_of_birth= trim($_POST['dob'] ?? null); // YYYY-MM-DD
        $sex          = trim($_POST['sex'] ?? '');
        $civil_status = trim($_POST['civilStatus'] ?? '');
        $nationality  = trim($_POST['nationality'] ?? '');
        $place_of_birth = trim($_POST['pofbirth'] ?? '');
        $home_address = trim($_POST['homeAdd'] ?? '');
        $phone_number = trim($_POST['pNum'] ?? '');
        $email_address= trim($_POST['emailAdd'] ?? '');
        $father_name  = trim($_POST['fatherName'] ?? '');
        $mother_name  = trim($_POST['motherName'] ?? '');
        $fdob         = trim($_POST['fdob'] ?? null); // YYYY-MM-DD
        $mdob         = trim($_POST['mdob'] ?? null); // YYYY-MM-DD


    $sql = "INSERT INTO user(first_name, middle_name, last_name, suffix, date_of_birth, sex, civil_status, nationality, place_of_birth, home_address, phone_number, email_address, father_name, mother_name, fdob, mdob) 
            VALUES(:first_name, :middle_name, :last_name, :suffix, :date_of_birth, :sex, :civil_status, :nationality, :place_of_birth, :home_address, :phone_number, :email_address, :father_name, :mother_name, :fdob, :mdob)";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':first_name' => $first_name,
        ':middle_name'=> $middle_name,
        ':last_name'  => $last_name,
        ':suffix'     => $suffix,
        ':date_of_birth' => $date_of_birth ?: null,
        ':sex'        => $sex,
        ':civil_status'=> $civil_status,
        ':nationality'=> $nationality,
        ':place_of_birth'=> $place_of_birth,
        ':home_address'=> $home_address,
        ':phone_number'=> $phone_number,
        ':email_address'=> $email_address
        ':father_name'=> $father_name,
        ':mother_name'=> $mother_name,
        ':fdob'       => $fdob ?: null,
        ':mdob'       => $mdob ?: null,
    ]);

    if ($stmt->rowCount()) {
        echo "Record saved successfully.";
    } else {
        echo "Insert failed.";
    }
}

    ?>
<?php

class Database {
    private $host = "localhost";
    private $db_name = "onlineform";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM user ORDER BY user_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserBeneficiaries($user_id) {
        $sql = "SELECT * FROM beneficiary WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserParents($user_id) {
        $sql = "SELECT * FROM parents WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserEmployment($user_id) {
        // Check OFW first
        $sql = "SELECT 'OFW' as type, foreign_address, monthly_earnings FROM ofw WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $ofw = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($ofw) return $ofw;

        // Check Self-employed
        $sql = "SELECT 'Self-employed' as type, prof_business, year_started, monthly_earnings FROM self_employed WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $se = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($se) return $se;

        // Check NWS
        $sql = "SELECT 'NWS' as type, common_ref, monthly_earnings FROM nws WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $nws = $stmt->fetch(PDO::FETCH_ASSOC);

        return $nws ?: null;
    }
}

// Initialize database and fetch users
$db_instance = new Database();
$db = $db_instance->connect();
$users = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $users = $db_instance->getAllUsers();
}

?>

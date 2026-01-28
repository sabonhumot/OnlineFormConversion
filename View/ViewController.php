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

    public function getUserById($user_id) {
        $sql = "SELECT * FROM user WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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


        public function getUsersPaginated($limit, $offset) {
        $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalUsers() {
        $sql = "SELECT COUNT(*) as total FROM user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function updateUser($user_id, $data) {
        $sql = "UPDATE user SET
                first_name = :first_name,
                middle_name = :middle_name,
                last_name = :last_name,
                suffix = :suffix,
                date_of_birth = :date_of_birth,
                sex = :sex,
                civil_status = :civil_status,
                nationality = :nationality,
                place_of_birth = :place_of_birth,
                home_address = :home_address,
                phone_number = :phone_number,
                email_address = :email_address
                WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':middle_name', $data['middle_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':suffix', $data['suffix']);
        $stmt->bindParam(':date_of_birth', $data['date_of_birth']);
        $stmt->bindParam(':sex', $data['sex']);
        $stmt->bindParam(':civil_status', $data['civil_status']);
        $stmt->bindParam(':nationality', $data['nationality']);
        $stmt->bindParam(':place_of_birth', $data['place_of_birth']);
        $stmt->bindParam(':home_address', $data['home_address']);
        $stmt->bindParam(':phone_number', $data['phone_number']);
        $stmt->bindParam(':email_address', $data['email_address']);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function updateParents($user_id, $data) {
        $sql = "UPDATE parents SET
                father_fname = :father_fname,
                father_lname = :father_lname,
                father_mname = :father_mname,
                fsuffix = :fsuffix,
                fdob = :fdob,
                mother_fname = :mother_fname,
                mother_lname = :mother_lname,
                mother_mname = :mother_mname,
                msuffix = :msuffix,
                mdob = :mdob
                WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':father_fname', $data['father_fname']);
        $stmt->bindParam(':father_lname', $data['father_lname']);
        $stmt->bindParam(':father_mname', $data['father_mname']);
        $stmt->bindParam(':fsuffix', $data['fsuffix']);
        $stmt->bindParam(':fdob', $data['fdob']);
        $stmt->bindParam(':mother_fname', $data['mother_fname']);
        $stmt->bindParam(':mother_lname', $data['mother_lname']);
        $stmt->bindParam(':mother_mname', $data['mother_mname']);
        $stmt->bindParam(':msuffix', $data['msuffix']);
        $stmt->bindParam(':mdob', $data['mdob']);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function updateBeneficiaries($user_id, $beneficiaries) {
        // First, delete existing beneficiaries
        $sql = "DELETE FROM beneficiary WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Insert new beneficiaries
        $sql = "INSERT INTO beneficiary (user_id, bene_fname, bene_mname, bene_lname, bene_suffix, bene_dob, bene_relationship)
                VALUES (:user_id, :bene_fname, :bene_mname, :bene_lname, :bene_suffix, :bene_dob, :bene_relationship)";
        $stmt = $this->conn->prepare($sql);

        foreach ($beneficiaries as $bene) {
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':bene_fname', $bene['bene_fname']);
            $stmt->bindParam(':bene_mname', $bene['bene_mname']);
            $stmt->bindParam(':bene_lname', $bene['bene_lname']);
            $stmt->bindParam(':bene_suffix', $bene['bene_suffix']);
            $stmt->bindParam(':bene_dob', $bene['bene_dob']);
            $stmt->bindParam(':bene_relationship', $bene['bene_relationship']);
            $stmt->execute();
        }
        return true;
    }

    public function updateEmployment($user_id, $data) {
        // Delete existing employment records
        $this->conn->prepare("DELETE FROM self_employed WHERE user_id = :user_id")->execute([':user_id' => $user_id]);
        $this->conn->prepare("DELETE FROM ofw WHERE user_id = :user_id")->execute([':user_id' => $user_id]);
        $this->conn->prepare("DELETE FROM nws WHERE user_id = :user_id")->execute([':user_id' => $user_id]);

        // Insert based on type
        if ($data['occupationType'] == 'se') {
            $sql = "INSERT INTO self_employed (user_id, prof_business, year_started, monthly_earnings)
                    VALUES (:user_id, :prof_business, :year_started, :monthly_earnings)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':prof_business', $data['profbusi']);
            $stmt->bindParam(':year_started', $data['yearstarted']);
            $stmt->bindParam(':monthly_earnings', $data['monthlyearnings']);
            $stmt->execute();
        } elseif ($data['occupationType'] == 'ofw') {
            $sql = "INSERT INTO ofw (user_id, foreign_address, monthly_earnings)
                    VALUES (:user_id, :foreign_address, :monthly_earnings)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':foreign_address', $data['foreignAdd']);
            $stmt->bindParam(':monthly_earnings', $data['monthlyearnings']);
            $stmt->execute();
        } elseif ($data['occupationType'] == 'nws') {
            $sql = "INSERT INTO nws (user_id, common_ref, monthly_earnings)
                    VALUES (:user_id, :common_ref, :monthly_earnings)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':common_ref', $data['commonRef']);
            $stmt->bindParam(':monthly_earnings', $data['monthlyearnings']);
            $stmt->execute();
        }
        return true;
    }

    public function deleteUser($user_id) {
        // Delete related records first
        $this->conn->prepare("DELETE FROM beneficiary WHERE user_id = :user_id")->execute([':user_id' => $user_id]);
        $this->conn->prepare("DELETE FROM parents WHERE user_id = :user_id")->execute([':user_id' => $user_id]);
        $this->conn->prepare("DELETE FROM self_employed WHERE user_id = :user_id")->execute([':user_id' => $user_id]);
        $this->conn->prepare("DELETE FROM ofw WHERE user_id = :user_id")->execute([':user_id' => $user_id]);
        $this->conn->prepare("DELETE FROM nws WHERE user_id = :user_id")->execute([':user_id' => $user_id]);

        // Delete user
        $sql = "DELETE FROM user WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
}

    



// Initialize database and fetch users
$db_instance = new Database();
$db = $db_instance->connect();
$users = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $users = $db_instance->getAllUsers();
}

$limit = 5; // Users per page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $users = $db_instance->getUsersPaginated($limit, $offset);
    $totalUsers = $db_instance->getTotalUsers();
    $totalPages = ceil($totalUsers / $limit);

?>

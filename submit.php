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

        try {
            $db->beginTransaction();

            $occupationType = trim($_POST['occupationType'] ?? '');
               
        // Insert into users table
        $sql_user = "INSERT INTO user(first_name, middle_name, last_name, suffix, date_of_birth, sex, civil_status, nationality, place_of_birth, home_address, phone_number, email_address, occupation) 
                     VALUES(:first_name, :middle_name, :last_name, :suffix, :date_of_birth, :sex, :civil_status, :nationality, :place_of_birth, :home_address, :phone_number, :email_address, :occupation)";

        $stmt_user = $db->prepare($sql_user);
        $stmt_user->execute([
            ':first_name' => trim($_POST['fname'] ?? ''),
            ':middle_name' => trim($_POST['mname'] ?? ''),
            ':last_name' => trim($_POST['lname'] ?? ''),
            ':suffix' => trim($_POST['suffix'] ?? ''),
            ':date_of_birth' => trim($_POST['dob'] ?? null),
            ':sex' => trim($_POST['sex'] ?? ''),
            ':civil_status' => trim($_POST['civilStatus'] ?? ''),
            ':nationality' => trim($_POST['nationality'] ?? ''),
            ':place_of_birth' => trim($_POST['pofbirth'] ?? ''),
            ':home_address' => trim($_POST['homeAddressHidden'] ?? ''),
            ':phone_number' => trim($_POST['pNum'] ?? ''),
            ':email_address' => trim($_POST['emailAdd'] ?? ''),
            ':occupation' => $occupationType
        ]);

        $user_id = $db->lastInsertId();

        // Insert into parents table
        $sql_parents = "INSERT INTO parents(user_id, father_fname, father_lname, father_mname, fsuffix, fdob, mother_fname, mother_lname, mother_mname, msuffix, mdob) 
                       VALUES(:user_id, :father_fname, :father_lname, :father_mname, :fsuffix, :fdob, :mother_fname, :mother_lname, :mother_mname, :msuffix, :mdob)";

        $stmt_parents = $db->prepare($sql_parents);
        $stmt_parents->execute([
            ':user_id' => $user_id,
            ':father_fname' => trim($_POST['fatherFname'] ?? ''),
            ':father_lname' => trim($_POST['fatherLname'] ?? ''),
            ':father_mname' => trim($_POST['fatherMname'] ?? ''),
            ':fsuffix' => trim($_POST['fsuffix'] ?? ''),
            ':fdob' => trim($_POST['fdob'] ?? null),
            ':mother_fname' => trim($_POST['motherFname'] ?? ''),
            ':mother_lname' => trim($_POST['motherLname'] ?? ''),
            ':mother_mname' => trim($_POST['motherMname'] ?? ''),
            ':msuffix' => trim($_POST['msuffix'] ?? ''),
            ':mdob' => trim($_POST['mdob'] ?? null)
        ]);

        if (!empty($_POST['beneficiary']) && is_array($_POST['beneficiary'])) {
            $sql_beneficiary = "INSERT INTO beneficiary(user_id, bene_fname, bene_lname, bene_mname, bene_suffix, bene_dob, bene_relationship) 
                                VALUES(:user_id, :bene_fname, :bene_lname, :bene_mname, :bene_suffix, :bene_dob, :bene_relationship)";

            $stmt_beneficiary = $db->prepare($sql_beneficiary);

            foreach ($_POST['beneficiary'] as $beneficiary) {
                $stmt_beneficiary->execute([
                    ':user_id' => $user_id,
                    ':bene_fname' => trim($beneficiary['fname'] ?? ''),
                    ':bene_lname' => trim($beneficiary['lname'] ?? ''),
                    ':bene_mname' => trim($beneficiary['mname'] ?? ''),
                    ':bene_suffix' => trim($beneficiary['suffix'] ?? ''),
                    ':bene_dob' => !empty($beneficiary['dob']) ? $beneficiary['dob'] : null,
                    ':bene_relationship' => trim($beneficiary['relation'] ?? '')
                ]);
            }
        }

        
        
        if ($occupationType === 'se') {
            $sql_se = "INSERT INTO self_employed(user_id, prof_business, year_started, monthly_earnings) 
                       VALUES(:user_id, :prof_business, :year_started, :monthly_earnings)"; 
            
                       
            $stmt_se = $db->prepare($sql_se);
            $stmt_se->execute([
                ':user_id' => $user_id,
                ':prof_business' => trim($_POST['profbusi'] ?? ''),
                ':year_started' => trim($_POST['yearstarted'] ?? null),
                ':monthly_earnings' => trim($_POST['monthlyearnings'] ?? null)
            ]);
        } else if ($occupationType === 'ofw') {
            $sql_ofw = "INSERT INTO ofw(user_id, foreign_address, monthly_earnings) 
                        VALUES(:user_id, :foreign_address, :monthly_earnings)"; 
                        
            $stmt_ofw = $db->prepare($sql_ofw);
            $stmt_ofw->execute([
                ':user_id' => $user_id,
                ':foreign_address' => trim($_POST['foreignAdd'] ?? ''),
                ':monthly_earnings' => trim($_POST['monthlyearnings'] ?? null),
            ]); 
        } else if ($occupationType === 'nws') {
            $sql_nws = "INSERT INTO nws(user_id, common_ref, monthly_earnings) 
                        VALUES(:user_id, :common_ref, :monthly_earnings)";
            $stmt_nws = $db->prepare($sql_nws);
            $stmt_nws->execute([
                ':user_id' => $user_id,
                ':common_ref' => trim($_POST['commonRef'] ?? ''),
                ':monthly_earnings' => trim($_POST['monthlyearnings'] ?? null),
            ]);
        }

        $db->commit();
        header("Location: index.php?success=1");
        exit();
        } catch (Exception $e) {
            $db->rollBack();
            echo "Failed to submit data: " . $e->getMessage();
        }
    }

    ?>
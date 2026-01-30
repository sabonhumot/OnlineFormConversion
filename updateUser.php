<?php
require_once 'View/ViewController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: View/view.php?error=invalid_method');
    exit;
}

if (!isset($_POST['user_id'])) {
    header('Location: View/view.php?error=no_user_id');
    exit;
}

$user_id = $_POST['user_id'];

$db = new Database();
$db->connect();

try {
    // Update user data
    $userData = [
        'first_name' => $_POST['fname'] ?? '',
        'middle_name' => $_POST['mname'] ?? '',
        'last_name' => $_POST['lname'] ?? '',
        'suffix' => $_POST['suffix'] ?? '',
        'date_of_birth' => $_POST['dob'] ?? '',
        'sex' => $_POST['sex'] ?? '',
        'civil_status' => $_POST['civilStatus'] ?? '',
        'nationality' => $_POST['nationality'] ?? '',
        'place_of_birth' => $_POST['pofbirth'] ?? '',
        'home_address' => $_POST['homeAdd'] ?? '',
        'phone_number' => $_POST['pNum'] ?? '',
        'email_address' => $_POST['emailAdd'] ?? ''
    ];

    $db->updateUser($user_id, $userData);

    // Update parents data
    $parentsData = [
        'father_fname' => $_POST['fatherFname'] ?? '',
        'father_lname' => $_POST['fatherLname'] ?? '',
        'father_mname' => $_POST['fatherMname'] ?? '',
        'fsuffix' => $_POST['fsuffix'] ?? '',
        'fdob' => $_POST['fdob'] ?? '',
        'mother_fname' => $_POST['motherFname'] ?? '',
        'mother_lname' => $_POST['motherLname'] ?? '',
        'mother_mname' => $_POST['motherMname'] ?? '',
        'msuffix' => $_POST['msuffix'] ?? '',
        'mdob' => $_POST['mdob'] ?? ''
    ];

    $db->updateParents($user_id, $parentsData);

    // Update beneficiaries
    if (isset($_POST['beneficiary'])) {
        $db->updateBeneficiaries($user_id, $_POST['beneficiary']);
    }

    // Update employment
    $employmentData = [
        'type' => $_POST['occupationType'] ?? '',
        'prof_business' => $_POST['profbusi'] ?? '',
        'year_started' => $_POST['yearstarted'] ?? '',
        'monthly_earnings' => $_POST['monthlyearnings'] ?? '',
        'foreign_address' => $_POST['foreignAdd'] ?? '',
        'common_ref' => $_POST['commonRef'] ?? ''
    ];

    $db->updateEmployment($user_id, $employmentData);

    header('Location: View/view.php?success=updated');
} catch (Exception $e) {
    header('Location: View/view.php?error=' . urlencode($e->getMessage()));
}
?>

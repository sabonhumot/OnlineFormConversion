<?php
require_once 'View/ViewController.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    exit;
}

$user_id = $input['user_id'];

$db = new Database();
$db->connect();

try {
    // Update user data
    $userData = [
        'first_name' => $input['fname'] ?? '',
        'middle_name' => $input['mname'] ?? '',
        'last_name' => $input['lname'] ?? '',
        'suffix' => $input['suffix'] ?? '',
        'date_of_birth' => $input['dob'] ?? '',
        'sex' => $input['sex'] ?? '',
        'civil_status' => $input['civilStatus'] ?? '',
        'nationality' => $input['nationality'] ?? '',
        'place_of_birth' => $input['pofbirth'] ?? '',
        'home_address' => $input['homeAdd'] ?? '',
        'phone_number' => $input['pNum'] ?? '',
        'email_address' => $input['emailAdd'] ?? ''
    ];

    $db->updateUser($user_id, $userData);

    // Update parents data
    $parentsData = [
        'father_fname' => $input['fatherFname'] ?? '',
        'father_lname' => $input['fatherLname'] ?? '',
        'father_mname' => $input['fatherMname'] ?? '',
        'fsuffix' => $input['fsuffix'] ?? '',
        'fdob' => $input['fdob'] ?? '',
        'mother_fname' => $input['motherFname'] ?? '',
        'mother_lname' => $input['motherLname'] ?? '',
        'mother_mname' => $input['motherMname'] ?? '',
        'msuffix' => $input['msuffix'] ?? '',
        'mdob' => $input['mdob'] ?? ''
    ];

    $db->updateParents($user_id, $parentsData);

    // Update beneficiaries
    if (isset($input['beneficiaries'])) {
        $db->updateBeneficiaries($user_id, $input['beneficiaries']);
    }

    // Update employment
    $employmentData = [
        'occupationType' => $input['occupationType'] ?? '',
        'profbusi' => $input['profbusi'] ?? '',
        'yearstarted' => $input['yearstarted'] ?? '',
        'monthlyearnings' => $input['monthlyearnings'] ?? '',
        'foreignAdd' => $input['foreignAdd'] ?? '',
        'commonRef' => $input['commonRef'] ?? ''
    ];

    $db->updateEmployment($user_id, $employmentData);

    echo json_encode(['success' => true, 'message' => 'User updated successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error updating user: ' . $e->getMessage()]);
}
?>

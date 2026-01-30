<?php
require_once 'View/ViewController.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

// Debug logging
error_log("Delete request received. Input: " . print_r($input, true));

if (!$input || !isset($input['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    exit;
}

$user_id = $input['user_id'];
error_log("Attempting to delete user ID: " . $user_id);

$db = new Database();
$db->connect();

try {
    $result = $db->deleteUser($user_id);
    error_log("Delete result: " . ($result ? 'success' : 'failed'));
    echo json_encode(['success' => true, 'message' => 'User deleted successfully']);
} catch (Exception $e) {
    error_log("Delete error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error deleting user: ' . $e->getMessage()]);
}
?>

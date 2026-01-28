<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view.module.css">
    <title>View Responses</title>
</head>
<body>

    <?php
    require_once '../Navbar/navbar.html';
    require_once 'ViewController.php';
    ?>

    <div class="container">
    <h1>View Responses</h1>
    
    <?php if (!empty($users)): ?>
        <div class="users-grid">
            <?php foreach ($users as $user): ?>
                <div class="user-card">
                    <h3><?php echo htmlspecialchars($user['user_id']. '.' . ' ' . $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'] . ($user['suffix'] ? ' ' . $user['suffix'] : '')); ?></h3>
                    
                    <div class="card-section">
                        <h4>Personal Information</h4>
                        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['date_of_birth']); ?></p>
                        <p><strong>Sex:</strong> <?php echo htmlspecialchars($user['sex']); ?></p>
                        <p><strong>Civil Status:</strong> <?php echo htmlspecialchars($user['civil_status']); ?></p>
                        <p><strong>Nationality:</strong> <?php echo htmlspecialchars($user['nationality']); ?></p>
                        <p><strong>Place of Birth:</strong> <?php echo htmlspecialchars($user['place_of_birth']); ?></p>
                        <p><strong>Home Address:</strong> <?php echo htmlspecialchars($user['home_address']); ?></p>
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email_address']); ?></p>
                    </div>
                    <button class="view-details" data-id="<?php echo $user['user_id']; ?>">View Details</button>
                </div>
            <?php endforeach; ?>
        </div>
        
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
    <div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>">Previous</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
    <?php endfor; ?>
    <?php if ($page < $totalPages): ?>
        <a href="?page=<?php echo $page + 1; ?>">Next</a>
    <?php endif; ?>
</div>
</div>

<!-- User Details Modal -->
<div id="userModal" class="modal hidden">
    <div class="modal-content">
        <span class="close-btn">&times;</span>

        <div id="modalBody">

        </div>
    </div>
</div>

<script src="../script.js"></script>

</body>
</html>
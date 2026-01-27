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
                    
                    <?php
                    $beneficiaries = $db_instance->getUserBeneficiaries($user['user_id']);
                    if (!empty($beneficiaries)):
                    ?>
                    <div class="card-section">
                        <h4>Beneficiaries</h4>
                        <?php foreach ($beneficiaries as $bene): ?>
                            <p><?php echo htmlspecialchars($bene['bene_fname'] . ' ' . $bene['bene_mname'] . ' ' . $bene['bene_lname'] . ($bene['bene_suffix'] ? ' ' . $bene['bene_suffix'] : '')); ?> (<?php echo htmlspecialchars($bene['bene_relationship']); ?>)</p>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php
                    $parents = $db_instance->getUserParents($user['user_id']);
                    if ($parents):
                    ?>
                    <div class="card-section">
                        <h4>Parents</h4>
                        <p><strong>Father:</strong> <?php echo htmlspecialchars($parents['father_fname'] . ' ' . $parents['father_mname'] . ' ' . $parents['father_lname'] . ($parents['fsuffix'] ? ' ' . $parents['fsuffix'] : '')); ?></p>
                        <p><strong>Mother:</strong> <?php echo htmlspecialchars($parents['mother_fname'] . ' ' . $parents['mother_mname'] . ' ' . $parents['mother_lname'] . ($parents['msuffix'] ? ' ' . $parents['msuffix'] : '')); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php
                    $employment = $db_instance->getUserEmployment($user['user_id']);
                    if ($employment):
                    ?>
                    <div class="card-section">
                        <h4>Employment</h4>
                        <p><strong>Type:</strong> <?php echo htmlspecialchars($employment['type']); ?></p>
                        <?php if ($employment['type'] == 'OFW'): ?>
                            <p><strong>Foreign Address:</strong> <?php echo htmlspecialchars($employment['foreign_address'] ?? ''); ?></p>
                        <?php elseif ($employment['type'] == 'Self-employed'): ?>
                            <p><strong>Profession/Business:</strong> <?php echo htmlspecialchars($employment['prof_business'] ?? ''); ?></p>
                            <p><strong>Year Started:</strong> <?php echo htmlspecialchars($employment['year_started'] ?? ''); ?></p>
                        <?php elseif ($employment['type'] == 'NWS'): ?>
                            <p><strong>Common Reference:</strong> <?php echo htmlspecialchars($employment['common_ref'] ?? ''); ?></p>
                        <?php endif; ?>
                        <p><strong>Monthly Earnings:</strong> <?php echo htmlspecialchars($employment['monthly_earnings'] ?? ''); ?></p>

                        <button class="view-button">View Details</button>


                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>
    
</body>
</html>
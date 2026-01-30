<?php
require_once 'Navbar/navbar.html';

// Handle edit functionality
$editUser = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    require_once 'View/ViewController.php';
    $db_instance = new Database();
    $db = $db_instance->connect();
    $userId = (int)$_GET['edit'];
    
    // Get user data
    $editUser = $db_instance->getUserById($userId);
    $parents = $db_instance->getUserParents($userId);
    $beneficiaries = $db_instance->getUserBeneficiaries($userId);
    $employment = $db_instance->getUserEmployment($userId);
    
    // Debug: Check what data we're getting
    error_log("User ID: " . $userId);
    error_log("Beneficiaries data: " . print_r($beneficiaries, true));
}

// If no user data, redirect back to view page
if (!$editUser) {
    header('Location: View/view.php?error=user_not_found');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Online Form Conversion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php
    require_once 'Navbar/navbar.html';
    ?>

    <div class="container">
    <h1>Edit User</h1>
    <form id="onlineForm" onsubmit="return validateForm()" method="post" action="updateUser.php">
        <input type="hidden" name="user_id" value="<?php echo $editUser['user_id']; ?>">
        <h2>Personal Data</h2>
        <div class="gen-info">
            <div class="name-row">
                <div class="input-field">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lname" value="<?php echo htmlspecialchars($editUser['last_name']); ?>">
                    <span id="lnameError" class="error"></span>
                </div>
                <div class="input-field">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="fname" value="<?php echo htmlspecialchars($editUser['first_name']); ?>">
                    <span id="fnameError" class="error"></span>
                </div>
                <div class="input-field">
                    <label for="middleName">Middle Name</label>
                    <input type="text" id="middleName" name="mname" value="<?php echo htmlspecialchars($editUser['middle_name']); ?>">
                    <span id="mnameError" class="error"></span>
                </div>
                <div class="input-field">
                    <label for="suffix">Suffix</label>
                    <input type="text" id="suffix" name="suffix" value="<?php echo htmlspecialchars($editUser['suffix']); ?>">
                    <span id="suffixError" class="error"></span>
                </div>
            </div>

            <div class="other-info">
                <div class="input-field">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($editUser['date_of_birth']); ?>"><br>
                    <span id="dobError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="sex">Sex</label>
                    <select id="sex" name="sex">
                    <option value="">--Select--</option>
                    <option value="male" <?php echo ($editUser['sex'] === 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo ($editUser['sex'] === 'female') ? 'selected' : ''; ?>>Female</option>
                    </select><br>
                    <span id="sexError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="civilStatus">Civil Status</label>
                    <select id="civilStatus" name="civilStatus">
                    <option value="">--Select--</option>
                    <option value="single" <?php echo ($editUser['civil_status'] === 'single') ? 'selected' : ''; ?>>Single</option>
                    <option value="married" <?php echo ($editUser['civil_status'] === 'married') ? 'selected' : ''; ?>>Married</option>
                    <option value="widowed" <?php echo ($editUser['civil_status'] === 'widowed') ? 'selected' : ''; ?>>Widowed</option>
                    <option value="separated" <?php echo ($editUser['civil_status'] === 'separated') ? 'selected' : ''; ?>>Separated</option>
                    <option value="divorced" <?php echo ($editUser['civil_status'] === 'divorced') ? 'selected' : ''; ?>>Divorced</option>
                    </select><br>
                    <span id="civilStatusError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="nationality">Nationality</label>
                    <input type="text" id="nationality" name="nationality" value="<?php echo htmlspecialchars($editUser['nationality']); ?>"><br>
                    <span id="nationalityError" class="error"></span><br>
                </div>
            </div>
        </div>

        <div class="address-info">
            <div class="input-field">
                <label for="pofbirth">Place of Birth</label>
                <input type="text" id="pofbirth" name="pofbirth" value="<?php echo htmlspecialchars($editUser['place_of_birth']); ?>"><br>
                <span id="pofbirthError" class="error"></span><br>
            </div>
            <div class="input-field">
                <label for="homeAdd">Home Address</label>
                <input type="text" id="homeAdd" name="homeAdd" value="<?php echo htmlspecialchars($editUser['home_address']); ?>"><br>
                <span id="homeAddError" class="error"></span><br>
            </div>
        </div>
        <div class="checkbox-container">
                <input type="checkbox" id="sameAdd" name="sameAdd">Same as Home Address
            </div>

        <div class="contact-info">
            <h2>Contact Information</h2>
            <div class="input-field">
                <label for="emailAdd">Email Address</label>
                <input type="email" id="emailAdd" name="emailAdd" value="<?php echo htmlspecialchars($editUser['email_address']); ?>"><br>
                <span id="emailAddError" class="error"></span><br>
            </div>
            <div class="input-field">
                <label for="pNum">Phone Number</label>
                <input type="tel" id="pNum" name="pNum" value="<?php echo htmlspecialchars($editUser['phone_number']); ?>"><br>
                <span id="pNumError" class="error"></span><br>
            </div>
        </div>

        <div class="parents-info">
            <h2>Parents' Information</h2>
            <div class="name-row">
                <div class="input-field">
                    <label for="fatherLname">Father's Last Name</label>
                    <input type="text" id="fatherLname" name="fatherLname" value="<?php echo htmlspecialchars($parents['father_lname'] ?? ''); ?>"><br>
                    <span id="fatherLnameError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="fatherFname">Father's First Name</label>
                    <input type="text" id="fatherFname" name="fatherFname" value="<?php echo htmlspecialchars($parents['father_fname'] ?? ''); ?>"><br>
                    <span id="fatherFnameError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="fatherMname">Father's Middle Name</label>
                    <input type="text" id="fatherMname" name="fatherMname" value="<?php echo htmlspecialchars($parents['father_mname'] ?? ''); ?>"><br>
                    <span id="fatherMnameError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="fsuffix">Father's Suffix</label>
                    <input type="text" id="fsuffix" name="fsuffix" value="<?php echo htmlspecialchars($parents['fsuffix'] ?? ''); ?>"><br>
                    <span id="fsuffixError" class="error"></span><br>
                </div>
            </div>
            <div class="other-info">
                <div class="input-field">
                    <label for="fdob">Father's Date of Birth</label>
                    <input type="date" id="fdob" name="fdob" value="<?php echo htmlspecialchars($parents['fdob'] ?? ''); ?>"><br>
                    <span id="fdobError" class="error"></span><br>
                </div>
            </div>

            <div class="name-row">
                <div class="input-field">
                    <label for="motherLname">Mother's Last Name</label>
                    <input type="text" id="motherLname" name="motherLname" value="<?php echo htmlspecialchars($parents['mother_lname'] ?? ''); ?>"><br>
                    <span id="motherLnameError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="motherFname">Mother's First Name</label>
                    <input type="text" id="motherFname" name="motherFname" value="<?php echo htmlspecialchars($parents['mother_fname'] ?? ''); ?>"><br>
                    <span id="motherFnameError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="motherMname">Mother's Middle Name</label>
                    <input type="text" id="motherMname" name="motherMname" value="<?php echo htmlspecialchars($parents['mother_mname'] ?? ''); ?>"><br>
                    <span id="motherMnameError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="msuffix">Mother's Suffix</label>
                    <input type="text" id="msuffix" name="msuffix" value="<?php echo htmlspecialchars($parents['msuffix'] ?? ''); ?>"><br>
                    <span id="msuffixError" class="error"></span><br>
                </div>
            </div>
            <div class="other-info">
                <div class="input-field">
                    <label for="mdob">Mother's Date of Birth</label>
                    <input type="date" id="mdob" name="mdob" value="<?php echo htmlspecialchars($parents['mdob'] ?? ''); ?>"><br>
                    <span id="mdobError" class="error"></span><br>
                </div>
            </div>
        </div>

        <div class="beneficiaries-info">
            <h2>Beneficiaries</h2>
            <!-- Debug: Show beneficiary count -->
            <p>Found <?php echo count($beneficiaries); ?> beneficiaries</p>
            <div id="beneficiariesContainer">
                <?php if ($beneficiaries && count($beneficiaries) > 0): ?>
                    <?php foreach ($beneficiaries as $index => $beneficiary): ?>
                        <div class="beneficiary-row">
                            <h5>Beneficiary <?php echo $index + 1; ?></h5>
                            <div class="name-row">
                                <div class="input-field">
                                    <label for="beneficiaryLname<?php echo $index; ?>">Last Name</label>
                                    <input type="text" id="beneficiaryLname<?php echo $index; ?>" name="beneficiary[<?php echo $index; ?>][bene_lname]" value="<?php echo htmlspecialchars($beneficiary['bene_lname'] ?? ''); ?>">
                                    <span id="beneficiaryLnameError<?php echo $index; ?>" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label for="beneficiaryFname<?php echo $index; ?>">First Name</label>
                                    <input type="text" id="beneficiaryFname<?php echo $index; ?>" name="beneficiary[<?php echo $index; ?>][bene_fname]" value="<?php echo htmlspecialchars($beneficiary['bene_fname'] ?? ''); ?>">
                                    <span id="beneficiaryFnameError<?php echo $index; ?>" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label for="beneficiaryMname<?php echo $index; ?>">Middle Name</label>
                                    <input type="text" id="beneficiaryMname<?php echo $index; ?>" name="beneficiary[<?php echo $index; ?>][bene_mname]" value="<?php echo htmlspecialchars($beneficiary['bene_mname'] ?? ''); ?>">
                                    <span id="beneficiaryMnameError<?php echo $index; ?>" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label for="suffix<?php echo $index; ?>">Suffix</label>
                                    <input type="text" id="suffix<?php echo $index; ?>" name="beneficiary[<?php echo $index; ?>][bene_suffix]" value="<?php echo htmlspecialchars($beneficiary['bene_suffix'] ?? ''); ?>">
                                </div>
                            </div>
                            <div class="other-info">
                                <div class="input-field">
                                    <label for="beneficiaryDob<?php echo $index; ?>">Date of Birth</label>
                                    <input type="date" id="beneficiaryDob<?php echo $index; ?>" name="beneficiary[<?php echo $index; ?>][bene_dob]" value="<?php echo htmlspecialchars($beneficiary['bene_dob'] ?? ''); ?>">
                                    <span id="beneficiaryDobError<?php echo $index; ?>" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <label for="beneficiaryRelation<?php echo $index; ?>">Relationship</label>
                                    <input type="text" id="beneficiaryRelation<?php echo $index; ?>" name="beneficiary[<?php echo $index; ?>][bene_relationship]" value="<?php echo htmlspecialchars($beneficiary['bene_relationship'] ?? ''); ?>">
                                    <span id="beneficiaryRelationError<?php echo $index; ?>" class="error"></span>
                                </div>
                                <div class="input-field">
                                    <button type="button" class="removeBeneficiary">Remove</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <button type="button" id="addBeneficiaryButton">Add Beneficiary</button>
        </div>

        <div class="employment-info">
            <h2>Employment Information</h2>
            <div class="input-field">
                <input type="radio" id="selfEmployed" name="occupationType" value="se" <?php echo ($employment && $employment['type'] === 'Self-employed') ? 'checked' : ''; ?>>
                <label for="selfEmployed">Self-employed</label>
                <input type="radio" id="ofw" name="occupationType" value="ofw" <?php echo ($employment && $employment['type'] === 'OFW') ? 'checked' : ''; ?>>
                <label for="ofw">Overseas Filipino Worker</label>
                <input type="radio" id="nonWorkingSpouse" name="occupationType" value="nws" <?php echo ($employment && $employment['type'] === 'NWS') ? 'checked' : ''; ?>>
                <label for="nonWorkingSpouse">Non-working Spouse</label>
            </div>

            <h4 id="seTitle" class="<?php echo (!$employment || $employment['type'] !== 'Self-employed') ? 'hidden' : ''; ?>">Self-employed (SE)</h4>
            <section id="seSection" class="<?php echo (!$employment || $employment['type'] !== 'Self-employed') ? 'hidden' : ''; ?>">               
                <div class="input-field">
                    <label for="profbusi">Profession/Business</label>
                    <input type="text" id="profbusi" name="profbusi" value="<?php echo htmlspecialchars($employment['prof_business'] ?? ''); ?>" <?php echo (!$employment || $employment['type'] !== 'Self-employed') ? 'disabled' : ''; ?>><br>
                </div>
                <div class="input-field">
                    <label for="yearstarted">Year Profession/Business Started</label>  
                    <input type="number" id="yearstarted" name="yearstarted" min="1900" max="2099" step="1" value="<?php echo htmlspecialchars($employment['year_started'] ?? ''); ?>" <?php echo (!$employment || $employment['type'] !== 'Self-employed') ? 'disabled' : ''; ?>>
                </div>
                <div class="input-field">
                    <label for="monthlyearnings">Monthly Earnings (Pesos)</label>
                    <input type="number" id="monthlyearnings" name="monthlyearnings" step="0.01" value="<?php echo htmlspecialchars($employment['monthly_earnings'] ?? ''); ?>" <?php echo (!$employment || $employment['type'] !== 'Self-employed') ? 'disabled' : ''; ?>><br>
                </div>
            </section>

            <h4 id="ofwTitle" class="<?php echo (!$employment || $employment['type'] !== 'OFW') ? 'hidden' : ''; ?>">Overseas Filipino Worker (OFW)</h4>
            <section id="ofwSection" class="<?php echo (!$employment || $employment['type'] !== 'OFW') ? 'hidden' : ''; ?>">               
                <div class="input-field">
                    <label for="foreignAdd">Foreign Address</label>
                    <input type="text" id="foreignAdd" name="foreignAdd" value="<?php echo htmlspecialchars($employment['foreign_address'] ?? ''); ?>" <?php echo (!$employment || $employment['type'] !== 'OFW') ? 'disabled' : ''; ?>><br>
                </div>
                <div class="input-field">
                    <label for="monthlyearnings">Monthly Earnings (Pesos)</label>
                    <input type="number" id="monthlyearnings" name="monthlyearnings" step="0.01" value="<?php echo htmlspecialchars($employment['monthly_earnings'] ?? ''); ?>" <?php echo (!$employment || $employment['type'] !== 'OFW') ? 'disabled' : ''; ?>><br>
                </div>
            </section>

            <h4 id="nwsTitle" class="<?php echo (!$employment || $employment['type'] !== 'NWS') ? 'hidden' : ''; ?>">Non-working Spouse (NWS)</h4>
            <section id="nwsSection" class="<?php echo (!$employment || $employment['type'] !== 'NWS') ? 'hidden' : ''; ?>">               
                <div class="input-field">
                    <label for="commonRef">SS No./Common Reference No. of Working Spouse</label>
                    <input type="text" id="commonRef" name="commonRef" value="<?php echo htmlspecialchars($employment['common_ref'] ?? ''); ?>" <?php echo (!$employment || $employment['type'] !== 'NWS') ? 'disabled' : ''; ?>><br>
                </div>
                <div class="input-field">
                    <label for="monthlyearnings">Monthly Earnings (Pesos)</label>
                    <input type="number" id="monthlyearnings" name="monthlyearnings" step="0.01" value="<?php echo htmlspecialchars($employment['monthly_earnings'] ?? ''); ?>" <?php echo (!$employment || $employment['type'] !== 'NWS') ? 'disabled' : ''; ?>><br>
                </div>
            </section>
        </div>
 
        <input type="submit" id="submitButton" value="Update User">
    </form>
</div>

<script src="script.js"></script>
</body>
</html>

<link rel="stylesheet" href="../styles.css">
<link rel="stylesheet" href="../modal-styles.css">
<?php
require_once 'ViewController.php';

$user_id = $_GET['user_id'] ?? null;

$db = new Database();
$db->connect();

$user = $db->getUserById($user_id);
$beneficiaries = $db->getUserBeneficiaries($user_id);
$parents = $db->getUserParents($user_id);
$employment = $db->getUserEmployment($user_id);
?>

<div class="modal-content">
    <div class="modal-header">
        <div class="modal-title">
            <h2><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']); ?></h2>
        </div>
        <div class="modal-actions">
            <button id="editBtn" class="btn btn-primary">
                <i class="icon-edit"></i> Edit
            </button>
            <button id="saveBtn" class="btn btn-success" style="display: none;">
                <i class="icon-save"></i> Save
            </button>
            <button id="deleteBtn" class="btn btn-danger">
                <i class="icon-delete"></i> Delete
            </button>
        </div>
    </div>

    <div class="modal-body">
        <form id="editForm" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            <!-- Personal Data Section -->
            <div class="form-section">
                <div class="section-header">
                    <h3>Personal Information</h3>
                </div>
                
                <div class="form-grid">
                    <div class="form-row name-row">
                        <div class="input-group">
                            <label for="lastName">Last Name *</label>
                            <input type="text" id="lastName" name="lname" value="<?php echo htmlspecialchars($user['last_name']); ?>" disabled>
                            <span id="lnameError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="firstName">First Name *</label>
                            <input type="text" id="firstName" name="fname" value="<?php echo htmlspecialchars($user['first_name']); ?>" disabled>
                            <span id="fnameError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="middleName">Middle Name</label>
                            <input type="text" id="middleName" name="mname" value="<?php echo htmlspecialchars($user['middle_name']); ?>" disabled>
                            <span id="mnameError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="suffix">Suffix</label>
                            <input type="text" id="suffix" name="suffix" value="<?php echo htmlspecialchars($user['suffix']); ?>" disabled>
                            <span id="suffixError" class="error-message"></span>
                        </div>
                    </div>

                    <div class="form-row personal-details">
                        <div class="input-group">
                            <label for="dob">Date of Birth *</label>
                            <input type="date" id="dob" name="dob" value="<?php echo $user['date_of_birth']; ?>" disabled>
                            <span id="dobError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="sex">Sex *</label>
                            <select id="sex" name="sex" disabled>
                                <option value="">--Select--</option>
                                <option value="male" <?php echo $user['sex'] == 'male' ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?php echo $user['sex'] == 'female' ? 'selected' : ''; ?>>Female</option>
                            </select>
                            <span id="sexError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="civilStatus">Civil Status *</label>
                            <select id="civilStatus" name="civilStatus" disabled>
                                <option value="">--Select--</option>
                                <option value="single" <?php echo $user['civil_status'] == 'single' ? 'selected' : ''; ?>>Single</option>
                                <option value="married" <?php echo $user['civil_status'] == 'married' ? 'selected' : ''; ?>>Married</option>
                                <option value="widowed" <?php echo $user['civil_status'] == 'widowed' ? 'selected' : ''; ?>>Widowed</option>
                                <option value="separated" <?php echo $user['civil_status'] == 'separated' ? 'selected' : ''; ?>>Separated</option>
                                <option value="divorced" <?php echo $user['civil_status'] == 'divorced' ? 'selected' : ''; ?>>Divorced</option>
                            </select>
                            <span id="civilStatusError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="nationality">Nationality *</label>
                            <input type="text" id="nationality" name="nationality" value="<?php echo htmlspecialchars($user['nationality']); ?>" disabled>
                            <span id="nationalityError" class="error-message"></span>
                        </div>
                    </div>

                    <div class="form-row address-row">
                        <div class="input-group">
                            <label for="pofbirth">Place of Birth *</label>
                            <input type="text" id="pofbirth" name="pofbirth" value="<?php echo htmlspecialchars($user['place_of_birth']); ?>" disabled>
                            <span id="pofbirthError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="homeAdd">Home Address *</label>
                            <input type="text" id="homeAdd" name="homeAdd" value="<?php echo htmlspecialchars($user['home_address']); ?>" disabled>
                            <span id="homeAddError" class="error-message"></span>
                        </div>
                    </div>

                    <div class="form-row contact-row">
                        <div class="input-group">
                            <label for="pNum">Phone Number *</label>
                            <input type="text" id="pNum" name="pNum" value="<?php echo htmlspecialchars($user['phone_number']); ?>" disabled>
                            <span id="pNumError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="emailAdd">Email Address *</label>
                            <input type="email" id="emailAdd" name="emailAdd" value="<?php echo htmlspecialchars($user['email_address']); ?>" disabled>
                            <span id="emailAddError" class="error-message"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parents Information Section -->
            <div class="form-section">
                <div class="section-header">
                    <h3>Parents Information</h3>
                </div>

                <div class="parent-subsection">
                    <h4>Father's Information</h4>
                    <div class="form-row name-row">
                        <div class="input-group">
                            <label for="fatherLname">Last Name</label>
                            <input type="text" id="fatherLname" name="fatherLname" value="<?php echo htmlspecialchars($parents['father_lname'] ?? ''); ?>" disabled>
                            <span id="fatherLnameError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="fatherFname">First Name</label>
                            <input type="text" id="fatherFname" name="fatherFname" value="<?php echo htmlspecialchars($parents['father_fname'] ?? ''); ?>" disabled>
                            <span id="fatherFnameError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="fatherMname">Middle Name</label>
                            <input type="text" id="fatherMname" name="fatherMname" value="<?php echo htmlspecialchars($parents['father_mname'] ?? ''); ?>" disabled>
                            <span id="fatherMnameError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="fatherSuffix">Suffix</label>
                            <input type="text" id="fatherSuffix" name="fsuffix" value="<?php echo htmlspecialchars($parents['fsuffix'] ?? ''); ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="fdob">Date of Birth</label>
                            <input type="date" id="fdob" name="fdob" value="<?php echo $parents['fdob'] ?? ''; ?>" disabled>
                            <span id="fdobError" class="error-message"></span>
                        </div>
                    </div>
                </div>

                <div class="parent-subsection">
                    <h4>Mother's Maiden Name</h4>
                    <div class="form-row name-row">
                        <div class="input-group">
                            <label for="motherLname">Last Name</label>
                            <input type="text" id="motherLname" name="motherLname" value="<?php echo htmlspecialchars($parents['mother_lname'] ?? ''); ?>" disabled>
                            <span id="motherLnameError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="motherFname">First Name</label>
                            <input type="text" id="motherFname" name="motherFname" value="<?php echo htmlspecialchars($parents['mother_fname'] ?? ''); ?>" disabled>
                            <span id="motherFnameError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="motherMname">Middle Name</label>
                            <input type="text" id="motherMname" name="motherMname" value="<?php echo htmlspecialchars($parents['mother_mname'] ?? ''); ?>" disabled>
                            <span id="motherMnameError" class="error-message"></span>
                        </div>
                        <div class="input-group">
                            <label for="motherSuffix">Suffix</label>
                            <input type="text" id="motherSuffix" name="msuffix" value="<?php echo htmlspecialchars($parents['msuffix'] ?? ''); ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="mdob">Date of Birth</label>
                            <input type="date" id="mdob" name="mdob" value="<?php echo $parents['mdob'] ?? ''; ?>" disabled>
                            <span id="mdobError" class="error-message"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beneficiaries Section -->
            <div class="form-section">
                <div class="section-header">
                    <h3>Beneficiaries</h3>
                </div>
                
                <div id="beneficiariesContainer" class="beneficiaries-container">
                    <?php foreach ($beneficiaries as $index => $bene): ?>
                        <div class="beneficiary-card">
                            <div class="beneficiary-header">
                                <h5>Beneficiary <?php echo $index + 1; ?></h5>
                            </div>
                            <div class="form-row beneficiary-row">
                                <div class="input-group">
                                    <label>Last Name</label>
                                    <input type="text" name="bene_lname[]" value="<?php echo htmlspecialchars($bene['bene_lname']); ?>" disabled>
                                </div>
                                <div class="input-group">
                                    <label>First Name</label>
                                    <input type="text" name="bene_fname[]" value="<?php echo htmlspecialchars($bene['bene_fname']); ?>" disabled>
                                </div>
                                <div class="input-group">
                                    <label>Middle Name</label>
                                    <input type="text" name="bene_mname[]" value="<?php echo htmlspecialchars($bene['bene_mname']); ?>" disabled>
                                </div>
                                <div class="input-group">
                                    <label>Suffix</label>
                                    <input type="text" name="bene_suffix[]" value="<?php echo htmlspecialchars($bene['bene_suffix']); ?>" disabled>
                                </div>
                                <div class="input-group">
                                    <label>Date of Birth</label>
                                    <input type="date" name="bene_dob[]" value="<?php echo $bene['bene_dob']; ?>" disabled>
                                </div>
                                <div class="input-group">
                                    <label>Relationship</label>
                                    <input type="text" name="bene_relationship[]" value="<?php echo htmlspecialchars($bene['bene_relationship']); ?>" disabled>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Employment Section -->
            <div class="form-section">
                <div class="section-header">
                    <h3>Employment Information</h3>
                    <p class="section-subtitle">For Self-Employed/Overseas Filipino Workers/Non-working Spouse</p>
                </div>

                <div class="employment-type-selection">
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="selfEmployed" name="occupationType" value="se" <?php echo ($employment && $employment['type'] == 'Self-employed') ? 'checked' : ''; ?> disabled>
                            <label for="selfEmployed">Self-Employed</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="ofw" name="occupationType" value="ofw" <?php echo ($employment && $employment['type'] == 'OFW') ? 'checked' : ''; ?> disabled>
                            <label for="ofw">Overseas Filipino Worker (OFW)</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="nonWorkingSpouse" name="occupationType" value="nws" <?php echo ($employment && $employment['type'] == 'NWS') ? 'checked' : ''; ?> disabled>
                            <label for="nonWorkingSpouse">Non-working Spouse</label>
                        </div>
                    </div>
                </div>

                <div id="seSection" class="employment-details <?php echo ($employment && $employment['type'] == 'Self-employed') ? '' : 'hidden'; ?>">
                    <h4>Self-Employed Details</h4>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="profbusi">Profession/Business</label>
                            <input type="text" id="profbusi" name="profbusi" value="<?php echo htmlspecialchars($employment['prof_business'] ?? ''); ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="yearstarted">Year Started</label>
                            <input type="number" id="yearstarted" name="yearstarted" value="<?php echo htmlspecialchars($employment['year_started'] ?? ''); ?>" min="1900" max="2099" step="1" disabled>
                        </div>
                        <div class="input-group">
                            <label for="monthlyearnings">Monthly Earnings (₱)</label>
                            <input type="number" id="monthlyearnings" name="monthlyearnings" value="<?php echo htmlspecialchars($employment['monthly_earnings'] ?? ''); ?>" step="0.01" disabled>
                        </div>
                    </div>
                </div>

                <div id="ofwSection" class="employment-details <?php echo ($employment && $employment['type'] == 'OFW') ? '' : 'hidden'; ?>">
                    <h4>OFW Details</h4>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="foreignAdd">Foreign Address</label>
                            <input type="text" id="foreignAdd" name="foreignAdd" value="<?php echo htmlspecialchars($employment['foreign_address'] ?? ''); ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="monthlyearnings">Monthly Earnings (₱)</label>
                            <input type="number" id="monthlyearnings" name="monthlyearnings" value="<?php echo htmlspecialchars($employment['monthly_earnings'] ?? ''); ?>" step="0.01" disabled>
                        </div>
                    </div>
                </div>

                <div id="nwsSection" class="employment-details <?php echo ($employment && $employment['type'] == 'NWS') ? '' : 'hidden'; ?>">
                    <h4>Non-working Spouse Details</h4>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="commonRef">SS No./Common Reference No. of Working Spouse</label>
                            <input type="text" id="commonRef" name="commonRef" value="<?php echo htmlspecialchars($employment['common_ref'] ?? ''); ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="monthlyearnings">Monthly Earnings (₱)</label>
                            <input type="number" id="monthlyearnings" name="monthlyearnings" value="<?php echo htmlspecialchars($employment['monthly_earnings'] ?? ''); ?>" step="0.01" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

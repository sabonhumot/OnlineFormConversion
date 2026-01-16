<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Form Conversion</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<body>
    

    <div class="container">
    <h1>Online Form</h1>
    <form id = "onlineForm" onsubmit="return validateForm()" method="post" action="submit.php">
        <h2>Personal Data</h2>
        <div class="gen-info">
            <div class="name-row">
                <div class="input-field">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="fname">
                    <span id="fnameError" class="error"></span>
                </div>
                <div class="input-field">
                    <label for="middleName">Middle Name</label>
                    <input type="text" id="middleName" name="mname">
                    <span id="mnameError" class="error"></span>
                </div>
                <div class="input-field">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lname">
                    <span id="lnameError" class="error"></span>
                </div>
                <div class="input-field">
                    <label for="suffix">Suffix</label>
                    <input type="text" id="suffix" name="suffix">
                    <span id="suffixError" class="error"></span>
                </div>
            </div>

            <div class="other-info">
                <div class="input-field">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob"><br>
                    <span id="dobError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="sex">Sex</label>
                    <select id="sex" name="sex">
                    <option value="">--Select--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    </select><br>
                    <span id="sexError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="civilStatus">Civil Status</label>
                    <select id="civilStatus" name="civilStatus">
                    <option value="">--Select--</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="widowed">Widowed</option>
                    <option value="separated">Separated</option>
                    <option value="divorced">Divorced</option>
                    </select><br>
                    <span id="civilStatusError" class="error"></span><br>
                </div>
                <div class="input-field">
                    <label for="nationality">Nationality</label>
                    <input type="text" id="nationality" name="nationality"><br>
                    <span id="nationalityError" class="error"></span><br>
                </div>
            </div>
        </div>  

        <div class="address-info">
            <div class="input-field">
                <label for="pofbirth">Place of Birth</label>
                <input type="text" id="pofbirth" name="pofbirth"><br>
                <span id="pofbirthError" class="error"></span><br>
            </div>
        
            <div class="input-field">
                <label for="homeAdd">Home Address</label>
                <input type="text" id="homeAdd" name="homeAdd"><br>
                <span id="homeAddError" class="error"></span><br>
            </div>
        </div>

        <div class="checkbox-container">
                <input type="checkbox" id="sameAdd" name="sameAdd">Same as Home Address
            </div>
  
    <div class="contacts-row">
        <div class="input-field">
            <label for="pNum">Phone Number</label>
            <input type="pNum" id="pNum" name="pNum"><br>
            <span id="pNumError" class="error"></span><br>
        </div>
        <div class="input-field">
            <label for="emailAdd">Email Address</label>
            <input type="email" id="emailAdd" name="emailAdd"><br>
            <span id="emailAddError" class="error"></span><br>
        </div>
    </div>
        
        <div class="name-row">
                <div class="input-field">
                    <label for="fatherName">Father's Name</label>
                    <input type="text" id="fatherName" name="fatherName">
                    <span id="fatherNameError" class="error"></span>
                </div>
                <div class="input-field">
                    <label for="fdob">Date of Birth</label>
                    <input type="date" id="fdob" name="fdob"><br>
                    <span id="fdobError" class="error"></span><br>
                </div>
        </div>
                
            <div class="name-row">
                <div class="input-field">
                    <label for="motherName">Mother's Maiden Name</label>
                    <input type="text" id="motherName" name="motherName">
                    <span id="motherNameError" class="error"></span>
                </div>
                <div class="input-field">
                    <label for="mdob">Date of Birth</label>
                    <input type="date" id="mdob" name="mdob"><br>
                    <span id="mdobError" class="error"></span><br>
                </div>
            </div>
            

        <input type="submit" id ="submitButton" value="Submit">

        
    </form>
    </div>

    



</body>
</html>
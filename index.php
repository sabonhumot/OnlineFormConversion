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
        <h2>General Information</h2>
        <div class="gen-info">
            <div class="name-field">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="fname">
                <span id="fnameError" class="error"></span>
            </div>
            <div class="name-field">
                <label for="middleName">Middle Name</label>
                <input type="text" id="middleName" name="mname">
                <span id="mnameError" class="error"></span>
            </div>
            <div class="name-field">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lname">
                <span id="lnameError" class="error"></span>
            </div>
            <div class="name-field">
                <label for="dob">Date of Birth</label><br>
                <input type="date" id="dob" name="dob"><br>
                <span id="dobError" class="error"></span><br>
            </div>
            <div class="name-field">
                <label for="sex">Sex</label><br>
                <select id="sex" name="sex">
                <option value="">--Select--</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                </select><br>
                <span id="sexError" class="error"></span><br>
            </div>
            <div class="name-field">
                <label for="civilStatus">Civil Status</label><br>
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
        </div>  

        <label for="nationality">Nationality</label><br>
        <input type="text" id="nationality" name="nationality"><br>
        <span id="nationalityError" class="error"></span><br>
        <label for="pofbirth">Place of Birth</label><br>
        <input type="text" id="pofbirth" name="pofbirth"><br>
        <span id="pofbirthError" class="error"></span><br>
        <label for="sameAdd">Same as Home Address</label>
        <input type="checkbox" id="sameAdd" name="sameAdd"><br>
        <label for="homeAdd">Home Address</label><br>
        <input type="text" id="homeAdd" name="homeAdd"><br>
        <span id="homeAddError" class="error"></span><br>

        <h2>Contact Information</h2>
        <label for="pNum">Phone Number</label><br>
        <input type="pNum" id="pNum" name="pNum"><br>
        <span id="pNumError" class="error"></span><br>
        <label for="emailAdd">Email Address</label><br>
        <input type="email" id="emailAdd" name="emailAdd"><br>
        <span id="emailAddError" class="error"></span><br>

        <input type="submit" id ="submitButton" value="Submit">
    </form>
    </div>



</body>
</html>
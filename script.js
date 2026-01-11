function validateForm() {
    
    document.querySelectorAll('.error').forEach(el => el.textContent = '');

    let isValid = true;

    let fname = document.forms["onlineForm"]["fname"].value;
    if (fname == "") {
        document.getElementById("fnameError").textContent = "First name must be filled out";
        document.getElementById("fnameError").style.color = "red";
        document.getElementById("firstName").style.borderColor = "red";
        isValid = false;
    }

    let mname = document.forms["onlineForm"]["mname"].value;
    if (mname == "") {
        document.getElementById("mnameError").textContent = "Middle name must be filled out";
        document.getElementById("mnameError").style.color = "red";
        document.getElementById("middleName").style.borderColor = "red";
        isValid = false;
    }

    let lname = document.forms["onlineForm"]["lname"].value;
    if (lname == "") {
        document.getElementById("lnameError").textContent = "Last name must be filled out";
        document.getElementById("lastName").style.borderColor = "red";
        document.getElementById("lnameError").style.color = "red";
        isValid = false;
    }

    let dob = document.forms["onlineForm"]["dob"].value;
    const today = new Date()
    if (dob == "") {
        document.getElementById("dobError").textContent = "Date of birth must be filled out";
        document.getElementById("dobError").style.color = "red";
        document.getElementById("dob").style.borderColor = "red";
        isValid = false;
    } else if(dob > today.toISOString().split('T')[0]) {
        document.getElementById("dobError").textContent = "Date of birth cannot be in the future";
        document.getElementById("dobError").style.color = "red";
        document.getElementById("dob").style.borderColor = "red";
        isValid = false;
    }

    let sexEl = document.forms["onlineForm"]["sex"];
    let sex = sexEl.value;
    if (sexEl.selectedIndex === 0 || sex === "") {
        document.getElementById("sexError").textContent = "Sex must be selected";
        document.getElementById("sexError").style.color = "red";
        sexEl.style.borderColor = "red";
        isValid = false;
    }

    let civilStatusEl = document.forms["onlineForm"]["civilStatus"];
    let civilStatus = civilStatusEl.value;
    if (civilStatus === 0 || civilStatus === "") {
        document.getElementById("civilStatusError").textContent = "Civil status must be selected";
        document.getElementById("civilStatusError").style.color = "red";
        civilStatusEl.style.borderColor = "red";
        isValid = false;
    }

    let nationality = document.forms["onlineForm"]["nationality"].value;
    if (nationality == "") {
        document.getElementById("nationalityError").textContent = "Nationality must be filled out";
        document.getElementById("nationalityError").style.color = "red";
        document.getElementById("nationality").style.borderColor = "red";
        isValid = false;
    }

    let pofbirth = document.forms["onlineForm"]["pofbirth"].value;
    if (pofbirth == "") {
        document.getElementById("pofbirthError").textContent = "Place of birth must be filled out";
        document.getElementById("pofbirthError").style.color = "red";
        document.getElementById("pofbirth").style.borderColor = "red";
        isValid = false;
    }

    let homeAdd = document.forms["onlineForm"]["homeAdd"].value;
    if (homeAdd == "") {
        document.getElementById("homeAddError").textContent = "Home address must be filled out";
        document.getElementById("homeAddError").style.color = "red";
        document.getElementById("homeAdd").style.borderColor = "red";
        isValid = false;
    }

    let email = document.forms["onlineForm"]["emailAdd"].value;
    if (email == "") {
        document.getElementById("emailAddError").textContent = "Email must be filled out";
        document.getElementById("emailAddError").style.color = "red";
        document.getElementById("emailAdd").style.borderColor = "red";
        isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById("emailAddError").textContent = "Please enter a valid email address";
        document.getElementById("emailAddError").style.color = "red";
        document.getElementById("emailAdd").style.borderColor = "red";
        isValid = false;
    }

    let phone = document.forms["onlineForm"]["pNum"].value;
    if (phone == "") {
        document.getElementById("pNumError").textContent = "Phone number must be filled out";
        document.getElementById("pNumError").style.color = "red";
        document.getElementById("pNum").style.borderColor = "red";
        isValid = false;
    } else if (!/^\d{10,15}$/.test(phone)) {
        document.getElementById("pNumError").textContent = "Phone number must be 10-15 digits";
        document.getElementById("pNumError").style.color = "red";
        document.getElementById("pNum").style.borderColor = "red";
        isValid = false;
    }

    return isValid;
}

function sameAddress() {
    const homeAddress = document.getElementById("homeAdd");
    const pofbirth = document.getElementById("pofbirth");
    const sameAdd = document.getElementById("sameAdd");

    sameAdd.addEventListener('change', function() {
    
    if (sameAdd.checked) {
        homeAddress.value = pofbirth.value;
        homeAddress.disabled = true;
    } else {
        homeAddress.disabled = false;
        homeAddress.value = '';
    }
    });

    pofbirth.addEventListener('input', () => {
        if (sameAdd.checked) homeAddress.value = pofbirth.value;
    });

    if (sameAdd.checked) {
    homeAdd.value = pofbirth.value;
    homeAdd.disabled = true;
  }
}

document.addEventListener('DOMContentLoaded', () => {
    sameAddress();
});
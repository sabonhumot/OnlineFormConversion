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

    let fatherLname = document.forms["onlineForm"]["fatherLname"].value;
    if (fatherLname == "") {
        document.getElementById("fatherLnameError").textContent = "Father's name must be filled out";
        document.getElementById("fatherLnameError").style.color = "red";
        document.getElementById("fatherLname").style.borderColor = "red";
        isValid = false;
    }

    let fatherFname = document.forms["onlineForm"]["fatherFname"].value;
    if (fatherFname == "") {
        document.getElementById("fatherFnameError").textContent = "Father's name must be filled out";
        document.getElementById("fatherFnameError").style.color = "red";
        document.getElementById("fatherFname").style.borderColor = "red";
        isValid = false;
    }

    let fatherMname = document.forms["onlineForm"]["fatherMname"].value;
    if (fatherMname == "") {
        document.getElementById("fatherMnameError").textContent = "Father's middle name must be filled out";
        document.getElementById("fatherMnameError").style.color = "red";
        document.getElementById("fatherMname").style.borderColor = "red";
        isValid = false;
    }

    let fdob = document.forms["onlineForm"]["fdob"].value;
    if (fdob == "") {
        document.getElementById("fdobError").textContent = "Father's date of birth must be filled out";
        document.getElementById("fdobError").style.color = "red";
        document.getElementById("fdob").style.borderColor = "red";
        isValid = false;
    } else if(fdob > today.toISOString().split('T')[0]) {
        document.getElementById("fdobError").textContent = "Father's date of birth cannot be in the future";
        document.getElementById("fdobError").style.color = "red";
        document.getElementById("fdob").style.borderColor = "red";
        isValid = false;
    }

    let motherLname = document.forms["onlineForm"]["motherLname"].value;
    if (motherLname == "") {
        document.getElementById("motherLnameError").textContent = "Mother's last name must be filled out";
        document.getElementById("motherLnameError").style.color = "red";
        document.getElementById("motherLname").style.borderColor = "red";
        isValid = false;
    }

    let motherFname = document.forms["onlineForm"]["motherFname"].value;
    if (motherFname == "") {
        document.getElementById("motherFnameError").textContent = "Mother's first name must be filled out";
        document.getElementById("motherFnameError").style.color = "red";
        document.getElementById("motherFname").style.borderColor = "red";
        isValid = false;
    } 
    
    let motherMname = document.forms["onlineForm"]["motherMname"].value;
    if (motherMname == "") {
        document.getElementById("motherMnameError").textContent = "Mother's middle name must be filled out";
        document.getElementById("motherMnameError").style.color = "red";
        document.getElementById("motherMname").style.borderColor = "red";
        isValid = false;
    }

    let mdob = document.forms["onlineForm"]["mdob"].value;
    if (mdob == "") {
        document.getElementById("mdobError").textContent = "Mother's date of birth must be filled out";
        document.getElementById("mdobError").style.color = "red";
        document.getElementById("mdob").style.borderColor = "red";
        isValid = false;
    } else if(mdob > today.toISOString().split('T')[0]) {
        document.getElementById("mdobError").textContent = "Mother's date of birth cannot be in the future";
        document.getElementById("mdobError").style.color = "red";
        document.getElementById("mdob").style.borderColor = "red";
        isValid = false;
    }

    const container = document.getElementById('beneficiariesContainer');

    for (let i = 0;  i < container.children.length; i++) {
        const beneficiary = container.children[i];

        const lname = beneficiary.querySelector(`[name="beneficiary[${i}][lname]"]`).value.trim();
        const fname = beneficiary.querySelector(`[name="beneficiary[${i}][fname]"]`).value.trim();
        const mname = beneficiary.querySelector(`[name="beneficiary[${i}][mname]"]`).value.trim();
        const relation = beneficiary.querySelector(`[name="beneficiary[${i}][relation]"]`).value.trim();
        const dob = beneficiary.querySelector(`[name="beneficiary[${i}][dob]"]`).value;

        if (lname == "") {
            beneficiary.querySelector(`#beneficiaryLnameError${i}`).textContent = "Last name must be filled out";
            beneficiary.querySelector(`#beneficiaryLnameError${i}`).style.color = "red";
            beneficiary.querySelector(`[name="beneficiary[${i}][lname]"]`).style.borderColor = "red";
            isValid = false;
        }

        if (fname == "") {
            beneficiary.querySelector(`#beneficiaryFnameError${i}`).textContent = "First name must be filled out";
            beneficiary.querySelector(`#beneficiaryFnameError${i}`).style.color = "red";
            beneficiary.querySelector(`[name="beneficiary[${i}][fname]"]`).style.borderColor = "red";
            isValid = false;
        }

        if (mname == "") {
            beneficiary.querySelector(`#beneficiaryMnameError${i}`).textContent = "Middle name must be filled out";
            beneficiary.querySelector(`#beneficiaryMnameError${i}`).style.color = "red";
            beneficiary.querySelector(`[name="beneficiary[${i}][mname]"]`).style.borderColor = "red";
            isValid = false;
        }

        if (relation == "") {
            beneficiary.querySelector(`#beneficiaryRelationError${i}`).textContent = "Relationship must be filled out";
            beneficiary.querySelector(`#beneficiaryRelationError${i}`).style.color = "red";
            beneficiary.querySelector(`[name="beneficiary[${i}][relation]"]`).style.borderColor = "red";
            isValid = false;
        }

        if (dob == "") {
            beneficiary.querySelector(`#beneficiaryDobError${i}`).textContent = "Date of birth must be filled out";
            beneficiary.querySelector(`#beneficiaryDobError${i}`).style.color = "red";
            beneficiary.querySelector(`[name="beneficiary[${i}][dob]"]`).style.borderColor = "red";
            isValid = false;
        } else if (dob > today.toISOString().split('T')[0]) {
            beneficiary.querySelector(`#beneficiaryDobError${i}`).textContent = "Date of birth cannot be in the future";
            beneficiary.querySelector(`#beneficiaryDobError${i}`).style.color = "red";
            beneficiary.querySelector(`[name="beneficiary[${i}][dob]"]`).style.borderColor = "red";
            isValid = false;
        }
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

    const addBeneficiaryButton = document.getElementById('addBeneficiaryButton');
    if (addBeneficiaryButton) {
        addBeneficiaryButton.addEventListener('click', addBeneficiary);
    } else {
        console.error('Add Beneficiary button not found!');
    }


});

let beneficiaryCount = 0;

function addBeneficiary() {
    
    const container = document.getElementById('beneficiariesContainer');
    const count = beneficiaryCount++;

    const beneficiaryDiv = document.createElement('div');
    beneficiaryDiv.className = 'beneficiary-row';
    beneficiaryDiv.innerHTML = `
    <h5>Beneficiary ${count + 1}</h5>
        <div class="name-row">
            <div class="input-field">
                <label for="beneficiaryLname${beneficiaryCount}">Last Name</label>
                <input type="text" id="beneficiaryLname${beneficiaryCount}" name="beneficiary[${beneficiaryCount}][lname]">
                <span id="beneficiaryLnameError${beneficiaryCount}" class="error"></span>
            </div>
            <div class="input-field">
                <label for="beneficiaryFname${beneficiaryCount}">First Name</label>
                <input type="text" id="beneficiaryFname${beneficiaryCount}" name="beneficiary[${beneficiaryCount}][fname]">
                <span id="beneficiaryFnameError${beneficiaryCount}" class="error"></span>
            </div>
            <div class="input-field">
                <label for="beneficiaryMname${beneficiaryCount}">Middle Name</label>
                <input type="text" id="beneficiaryMname${beneficiaryCount}" name="beneficiary[${beneficiaryCount}][mname]">
                <span id="beneficiaryMnameError${beneficiaryCount}" class="error"></span>
            </div>
            <div class="input-field">
                <label for="suffix${beneficiaryCount}">Suffix</label>
                <input type="text" id="suffix${beneficiaryCount}" name="beneficiary[${beneficiaryCount}][suffix]">
            </div>
        </div>
        <div class="other-info">
            <div class="input-field">
                <label for="beneficiaryDob${beneficiaryCount}">Date of Birth</label>
                <input type="date" id="beneficiaryDob${beneficiaryCount}" name="beneficiary[${beneficiaryCount}][dob]">
                <span id="beneficiaryDobError${beneficiaryCount}" class="error"></span>
            </div>
            <div class="input-field">
                <label for="beneficiaryRelation${beneficiaryCount}">Relationship</label>
                <input type="text" id="beneficiaryRelation${beneficiaryCount}" name="beneficiary[${beneficiaryCount}][relation]">
                <span id="beneficiaryRelationError${beneficiaryCount}" class="error"></span>
            </div>
            <div class="input-field">
            <button type="button" class="removeBeneficiary">Remove</button>
            </div>
        </div>
    
        
    `;
    container.appendChild(beneficiaryDiv);

    beneficiaryDiv.querySelector('.removeBeneficiary').addEventListener('click', () => {
        container.removeChild(beneficiaryDiv);
    });
}

document.addEventListener('DOMContentLoaded', () => {

  const formSections = {
    se: {
      title: document.getElementById('seTitle'),
      section: document.getElementById('seSection')
    },
    ofw: {
      title: document.getElementById('ofwTitle'),
      section: document.getElementById('ofwSection')
    },
    nws: {
      title: document.getElementById('nwsTitle'),
      section: document.getElementById('nwsSection')
    }
  };

  const radios = document.querySelectorAll('input[name="occupationType"]');

  function hideAllForms() {
    Object.values(formSections).forEach(item => {
      item.title.classList.add('hidden');   // ✅ updated
      item.section.classList.add('hidden'); // ✅ updated

      item.section.querySelectorAll('input, select, textarea').forEach(el => {
        el.disabled = true;
      });
    });
  }

  function enableSectionInputs(section) {
    section.querySelectorAll('input, select, textarea').forEach(el => {
      el.disabled = false;
    });
  }

  radios.forEach(radio => {
    radio.addEventListener('change', () => {
      showForm(radio.value);
    });
  });

  function showForm(section) {
    hideAllForms();

    switch(section) {
      case 'se':
        formSections.se.title.classList.remove('hidden');
        formSections.se.section.classList.remove('hidden');
        enableSectionInputs(formSections.se.section);
        break;

      case 'ofw':
        formSections.ofw.title.classList.remove('hidden');
        formSections.ofw.section.classList.remove('hidden');
        enableSectionInputs(formSections.ofw.section);
        break;

      case 'nws':
        formSections.nws.title.classList.remove('hidden');
        formSections.nws.section.classList.remove('hidden');
        enableSectionInputs(formSections.nws.section);
        break;
    }
  }

});
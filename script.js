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
    const homeAddressHidden = document.getElementById("homeAddressHidden");

    sameAdd.addEventListener('change', function() {

    if (sameAdd.checked) {
        homeAddress.value = pofbirth.value;
        homeAddress.disabled = true;
        homeAddressHidden.value = pofbirth.value;
    } else {
        homeAddress.disabled = false;
        homeAddress.value = '';
        homeAddressHidden.value = '';
    }
    });

    pofbirth.addEventListener('input', () => {
        if (sameAdd.checked) {
            homeAddress.value = pofbirth.value;
            homeAddressHidden.value = pofbirth.value;
        }
    });

    if (sameAdd.checked) {
    homeAddress.value = pofbirth.value;
    homeAddress.disabled = true;
    homeAddressHidden.value = pofbirth.value;
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

    // Initialize modal functionality
    initializeModal();

    if (new URLSearchParams(window.location.search).get('success') === '1') {   
        showSuccess('Data submitted successfully!');
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
      item.title.classList.add('hidden');   
      item.section.classList.add('hidden'); 

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

function showSuccess(message) {
  const toast = document.getElementById('toast');

  toast.textContent = message;
  toast.classList.remove('hidden');

  toast.offsetHeight;

  toast.classList.add('show');

  setTimeout(() => {
    toast.classList.remove('show');

    setTimeout(() => {
      toast.classList.add('hidden');
    }, 400);
  }, 3000);
}

function initializeModal() {
    // Check if modal elements exist before initializing
    const modal = document.getElementById('userModal');
    const modalBody = document.getElementById('modalBody');
    const closeBtn = document.querySelector('.close-btn');

    if (!modal || !modalBody || !closeBtn) {
        console.log('Modal elements not found on this page');
        return;
    }

    document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', () => {
            const userId = btn.dataset.id;

            fetch(`viewModal.php?user_id=${userId}`)
                .then(res => res.text())
                .then(html => {
                    modalBody.innerHTML = html;
                    modal.classList.remove('hidden');
                    initializeModalButtons();
                })
                .catch(error => {
                    console.error('Error fetching modal content:', error);
                });
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    window.addEventListener('click', e => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
}

function initializeModalButtons() {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const deleteBtn = document.getElementById('deleteBtn');
    const form = document.getElementById('editForm');

    if (editBtn) {
        editBtn.addEventListener('click', () => {
            // Enable all form fields
            form.querySelectorAll('input, select').forEach(el => {
                el.disabled = false;
            });
            editBtn.style.display = 'none';
            saveBtn.style.display = 'inline-block';
        });
    }

    if (saveBtn) {
        saveBtn.addEventListener('click', () => {
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            // Handle beneficiaries array
            const beneficiaries = [];
            const beneLnames = formData.getAll('bene_lname[]');
            const beneFnames = formData.getAll('bene_fname[]');
            const beneMnames = formData.getAll('bene_mname[]');
            const beneSuffixes = formData.getAll('bene_suffix[]');
            const beneDobs = formData.getAll('bene_dob[]');
            const beneRelationships = formData.getAll('bene_relationship[]');

            for (let i = 0; i < beneLnames.length; i++) {
                beneficiaries.push({
                    bene_lname: beneLnames[i],
                    bene_fname: beneFnames[i],
                    bene_mname: beneMnames[i],
                    bene_suffix: beneSuffixes[i],
                    bene_dob: beneDobs[i],
                    bene_relationship: beneRelationships[i]
                });
            }
            data.beneficiaries = beneficiaries;

            fetch('updateUser.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(result => {
                if (result.success) {
                    showSuccess('User updated successfully!');
                    // Reload the page or refresh the user list
                    location.reload();
                } else {
                    alert('Error updating user: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating user');
            });
        });
    }

    if (deleteBtn) {
        deleteBtn.addEventListener('click', () => {
            if (confirm('Are you sure you want to delete this user?')) {
                const userId = form.querySelector('input[name="user_id"]').value;

                fetch('deleteUser.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ user_id: userId })
                })
                .then(res => res.json())
                .then(result => {
                    if (result.success) {
                        showSuccess('User deleted successfully!');
                        location.reload();
                    } else {
                        alert('Error deleting user: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting user');
                });
            }
        });
    }
}

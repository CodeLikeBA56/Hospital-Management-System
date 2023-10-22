function fetchData(URL) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", URL, true);

    xhr.send();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                const responseData = JSON.parse(xhr.responseText);
                PatientData.push(...responseData); // Update the global array directly
            } else {
                console.log("Failed to fetch data");
            }
        }
    };
    
}
//ok
function fillBill(data) {
    const patient_id_input = document.getElementsByName('pat-no')[0];
    const patient_name = document.getElementsByName('pat-name')[0];
    const patient_age = document.getElementsByName('pat-age')[0];
    const patient_SSN = document.getElementsByName('SSN')[0];
    const patient_gender_male = document.getElementById('male');
    const patient_gender_female = document.getElementById('female');

    let matchedData = null;
    for (let i = 0; i < data.length; i++) {
        if (data[i].patient_id === patient_id_input.value) {
            matchedData = data[i];
            break; // Stop the loop once a match is found
        }
    }
    if (matchedData) {
        patient_name.value = matchedData.patient_name;
        patient_age.value = matchedData.patient_age;
        patient_SSN.value = matchedData.patient_SSN;
        
        if (matchedData.patient_gender === 'Male') {
            patient_gender_male.checked = true;
        } else if (matchedData.patient_gender === 'Female') {
            patient_gender_female.checked = true;
        } else {
            patient_gender_male.checked = false;
            patient_gender_female.checked = false;
        }
    } else { // Clear the fields if no match found
        patient_name.value = "";
        patient_age.value = "";
        patient_SSN.value = "";
        patient_gender_male.checked = false;
        patient_gender_female.checked = false;
    }
}

function fillDischargeSheet(data) {
    const patient_id_input = document.getElementsByName('pat-no')[0];
    const patient_name = document.getElementsByName('pat-name')[0];
    const patient_age = document.getElementsByName('pat-age')[0];
    const patient_SSN = document.getElementsByName('SSN')[0];
    const patient_medicines = document.getElementsByName('Med-to-Give')[0];
    const patient_gender_male = document.getElementById('male');
    const patient_gender_female = document.getElementById('female');

    let matchedData = null;
    for (let i = 0; i < data.length; i++) {
        if (data[i].patient_id === patient_id_input.value) {
            matchedData = data[i];
            break; // Stop the loop once a match is found
        }
    }
    if (matchedData) {
        patient_name.value = matchedData.patient_name;
        patient_age.value = matchedData.patient_age;
        patient_SSN.value = matchedData.patient_SSN;
        patient_medicines.value = matchedData.medicines_to_give;
        
        if (matchedData.patient_gender === 'Male') {
            patient_gender_male.checked = true;
        } else if (matchedData.patient_gender === 'Female') {
            patient_gender_female.checked = true;
        } else {
            patient_gender_male.checked = false;
            patient_gender_female.checked = false;
        }
    } else { // Clear the fields if no match found
        patient_name.value = "";
        patient_age.value = "";
        patient_SSN.value = "";
        patient_medicines.value = "";
        patient_gender_male.checked = false;
        patient_gender_female.checked = false;
    }
}

function fillDPatientReport(data) {
    const patient_name = document.getElementsByName('pat-name')[0];
    const patient_id = document.getElementsByName('pat-no')[0];
    const patient_age = document.getElementsByName('pat-age')[0];
    const patient_SSN = document.getElementsByName('SSN')[0];
    const patient_gender_male =document.getElementById('male');
    const patient_gender_female =document.getElementById('female');
    const patient_medical_condition_before = document.getElementsByName('Med-Cond-Before')[0];

    let matchedData = null;
    for (let i = 0; i < data.length; i++) {
        if (data[i].patient_id === patient_id.value) {
            matchedData = data[i];
            break; // Stop the loop once a match is found
        }
    }
    if (matchedData) {
        patient_name.value = matchedData.patient_name;
        patient_age.value = matchedData.patient_age;
        patient_SSN.value = matchedData.patient_SSN;
        patient_medical_condition_before.value = matchedData.medical_condition;
        
        if (matchedData.patient_gender === 'Male') {
            patient_gender_male.checked = true;
        } else if (matchedData.patient_gender === 'Female') {
            patient_gender_female.checked = true;
        } else {
            patient_gender_male.checked = false;
            patient_gender_female.checked = false;
        }
    } else { // Clear the fields if no match found
        patient_name.value = "";
        patient_age.value = "";
        patient_SSN.value = "";
        patient_medical_condition_before.value = "";
        patient_gender_male.checked = false;
        patient_gender_female.checked = false;
    }

}

function fillPatientDeleteForm(data){
    const patient_name = document.getElementsByName('pat-name')[0];
    const patient_id = document.getElementsByName('pat-no')[0];
    const patient_age = document.getElementsByName('pat-age')[0];
    const patient_SSN = document.getElementsByName('SSN')[0];

    let matchedData = null;
    for (let i = 0; i < data.length; i++) {
        if (data[i].patient_id === patient_id.value) {
            matchedData = data[i];
            break; // Stop the loop once a match is found
        }
    }
    if (matchedData) {
        patient_name.value = matchedData.patient_name;
        patient_age.value = matchedData.patient_age;
        patient_SSN.value = matchedData.patient_SSN;
        
    } else { // Clear the fields if no match found
        patient_name.value = "";
        patient_age.value = "";
        patient_SSN.value = "";
    }
}

function fillPatientReport(data) {
    const patient_name_input = document.getElementsByName('pat-name')[0];
    const patient_id = document.getElementsByName('pat-no')[0];
    const patient_age_input = document.getElementsByName('pat-age')[0];
    const patient_mobile_input = document.getElementsByName('mob-no')[0];
    const patient_gender_male =document.getElementById('male');
    const patient_gender_female =document.getElementById('female');
    const patient_status = document.getElementsByName('patient-status')[0];

    let matchedData = null;
    for (let i = 0; i < data.length; i++) {
        if (data[i].patient_id === patient_id.value) {
            matchedData = data[i];
            break; // Stop the loop once a match is found
        }
    }
    if (matchedData) {
        patient_name_input.value = matchedData.patient_name;
        patient_age_input.value = matchedData.patient_age;
        patient_mobile_input.value = matchedData.patient_mobile;

        // Check the appropriate gender radio button
        if (matchedData.patient_gender === 'Male') {
            patient_gender_male.checked = true;
            patient_gender_female.checked = false;
        } else if (matchedData.patient_gender === 'Female') {
            patient_gender_female.checked = true;
            patient_gender_male.checked = false;
        }

        patient_status.value = matchedData.patient_checked;
    } else {
        patient_name_input.value = "";
        patient_age_input.value = "";
        patient_mobile_input.value = "";
        patient_gender_male.checked = false;
        patient_gender_female.checked = false;
        patient_status.value = "Checked";
    }
}
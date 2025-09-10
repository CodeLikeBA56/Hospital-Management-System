
<?php
    include("../DatabaseConnection.php");
    $_PatientNumber = getLatestPatientID($conn);
    $_PatientID = $_PatientNumber + 1;

    function getLatestPatientID($conn){
        $sql = "SELECT Max(patient_id) AS 'max_id' FROM Patient;";
        $_result = $conn->query($sql);
        $_row = $_result->fetch_assoc();
        return $_row['max_id'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_PatientName = $_REQUEST['pat-name'];
        $_PatientAge = $_REQUEST['pat-age'];

        $_PatientSSN = $_REQUEST['SSN'];
        $_PatientMobileNumber = $_REQUEST['mob-no'];
        $_PatientGender = $_REQUEST['option'];

        $_MedicalCondition = $_REQUEST['Medical-Condition'];
        $_SeriousnessLevel = $_REQUEST['Seriousness-level'];
        $_Doctorid = $_REQUEST['Relevent-Doctor'];
        $_PatientCareNumber = $_REQUEST['patcare-no'];

        $sql = "SELECT patient_SSN from patient where patient_SSN = '$_PatientSSN'";
        $result = $conn->query($sql);

        $sql = "SELECT availability from doctor where doctor_id = '$_Doctorid'";
        $result1 = $conn->query($sql);
        $_row1 = $result1->fetch_assoc();

        $sql = "SELECT availability from patientcare where patient_care_id='$_PatientCareNumber'";
        $result2 = $conn->query($sql);
        $_row2 = $result2->fetch_assoc();
        
        if (($_row = $result->fetch_assoc()) > 0) {
            echo '<script>alert("Patient Record already exists.");</script>';
        }
        else if($_row1['availability'] == 'No'){
            echo '<script>alert("Doctor not Available / ID Not Correct.");</script>';
        }
        else if($_row2['availability'] == 'No'){
            echo '<script>alert("Patient Care not Available / ID Not Correct.");</script>';
        }
        else {
            $sql = "INSERT INTO Patient VALUES ('$_PatientName', '$_PatientID', '$_PatientMobileNumber', '$_PatientGender',
            '$_PatientSSN', '$_PatientAge','$_MedicalCondition', '$_SeriousnessLevel', '$_Doctorid', '$_PatientCareNumber', 211400068, 'Unchecked');";
            $conn->query($sql);
                       
            $sql = "INSERT INTO doctorassigned VALUES(211400068, '$_Doctorid' , '$_PatientID' , NOW());";
            $conn->query($sql);
            header("Location: Admin-Home.php");
            exit();
        }        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../Navigation-bar-Styling.css">
    <link rel="stylesheet" href="../FormStyle.css">
</head>
<body>
    <div class="navbar">
        <span class="web">Emergency</span>
        <div class="inner_navbar" style="margin-left: 47.5%;">
            <a class="list" href="Admin-Home.php">Home</a>
            <a class="list" href="">About Us</a>
            <a class="list" href="">Doctors</a>
            <a class="list" href="">Contacts</a>
        </div>   
    </div>
    <!-- Patient Registration Form -->
    <div class="container">
        <Header>PATIENT REGISTRATION FORM</Header>
        <form method="post">
            <div class="Grid-Container-1">
                <div class="Grid">
                    <label>Patient Name</label>
                    <input type="text" name="pat-name" placeholder="Enter Patient Name" required>
                </div>
                <div class="Grid">
                    <label>Patient Number</label>
                    <input type="number" name="pat-no" placeholder="Enter Patient Number" value="<?php echo("$_PatientID") ?>" disabled required>
                </div>
                <div class="Grid">
                    <label>Patient Age</label>
                    <input type="number" name="pat-age" placeholder="Patient Age" id="pat-age" required>
                </div>
                <div class="Grid">
                    <label>Social Security Number</label>
                    <input type="tel" name="SSN" placeholder="Social Security Number" autocomplete="off" required>
                </div>
                <div class="Grid">
                    <label>Patient Mobile Number</label>
                    <input id="mob-no" type="tel" name="mob-no" placeholder="Patient Mobile Number" required>
                </div>
                <div class="Grid">
                    <label>GENDER</label>
                    <div class="Gender-Option">
                        <input type="radio" name="option" value="Male" id="male">
                        <label class="Label-5" for="male">Male</label>
                        <input type="radio" name="option" value="Female" id="female">
                        <label class="Label-5" for="female" style="width:110px">Female</label>
                    </div>
                </div>
                <div class="Grid">
                    <label>Medical Condition</label>
                    <input type="text" name="Medical-Condition" placeholder="Patient Medical Condition">
                </div>
                <div class="Grid">
                    <label>Seriousness Level</label>
                    <select name="Seriousness-level" class="Seriousness-level">
                        <option selected value="Stable">Stable</option>
                        <option value="Critical">Critical</option>
                    </select>
                </div>
                <div class="Grid">
                    <label>Doctor Assigned</label>
                    <input type="number" name="Relevent-Doctor" id="doctors-assigned" placeholder="Enter Doctor ID Here">
                    <div id="suggestion-container"></div>
                </div>
                <div class="Grid">
                    <label>Patient Care ID</label>
                    <input type="number" name="patcare-no" placeholder="Enter Patient Care ID" required>
                </div>
            </div>
            <div class="Grid-Container-2">
                <input type="submit" name="submit" value="SUMBIT FORM" id="submit-button">
            </div>
        </form>
    </div>   
</body>
</html>
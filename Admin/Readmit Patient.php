<?php
    include("../DatabaseConnection.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_PatientSSN = $_REQUEST['SSN'];
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
        
        if (($_row = $result->fetch_assoc()) < 1) {
            echo '<script>alert("Patient Record already exists.");</script>';
        }else if($_row1['availability'] == 'No'){
            echo '<script>alert("Doctor not Available / ID Not Correct.");</script>';
        }else if($_row2['availability'] == 'No'){
            echo '<script>alert("Patient Care not Available / ID Not Correct.");</script>';
        }else {
            $sql = "SELECT patient_id FROM patient WHERE patient_SSN = '$_PatientSSN'";
            $result = $conn->query($sql);
            $_row = $result->fetch_assoc();
            $_PID = $_row['patient_id'];
            $sql = "UPDATE patient SET seriousness_level = '$_SeriousnessLevel', doctor_id = '$_Doctorid', patient_care_id = '$_PatientCareNumber', 
            patient_checked = 'Unchecked',medical_condition='$_MedicalCondition' WHERE patient_id = $_PID;";
            $conn->query($sql);
            $sql = "UPDATE doctorassigned SET doctor_id=$_Doctorid, time_stamp=NOW() WHERE patient_id=$_PID";
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
    <script src="../Patient Care/PCScript.js"></script>
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
    <div class="container">
        <Header>ADMIT PATIENT</Header>
        <form method="post">
            <div class="Grid-Container-1">
                <div class="Grid">
                    <label>Social Security Number</label>
                    <input type="tel" name="SSN" placeholder="Social Security Number" autocomplete="off" required>
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

    <script>
        const PatientData = [];
        window.addEventListener('load', function() {
            fetchData("FetchPatientData.php");
        });
    </script>
</body>
</html>
<?php
    include("../DatabaseConnection.php");
    session_start();
    $_ReportNumber = getLatestReportID($conn);
    $_ReportID = $_ReportNumber + 1;

    function getLatestReportID($conn){
        $sql = "SELECT Max(report_id) AS 'max_id' FROM report;";
        $_result = $conn->query($sql);
        $_row = $_result->fetch_assoc();
        return $_row['max_id'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_PatientNumber = $_REQUEST['pat-no'];

        $_LabTests = $_REQUEST['Lab-Tests'];
        $_MedicinesToGive = $_REQUEST['Med-to-Give'];
        $_TreatmentGiven = $_REQUEST['Treatment-Given'];
        $_PatientActiveStatus = $_REQUEST['Stayed-At'];
        $_MedicalConditionBefore = $_REQUEST['Med-Cond-Before'];
        $_MedicalConditionAfter = $_REQUEST['Med-Cond-After'];

        $sql = "INSERT INTO report VALUES ($_ReportID, '$_LabTests', '$_MedicinesToGive', '$_TreatmentGiven'
        , '$_PatientActiveStatus', '$_MedicalConditionBefore', '$_MedicalConditionAfter');";
        
        if($conn->query($sql)){
            $sql = "INSERT INTO filereport VALUES ($_SESSION[User], $_ReportID, $_PatientNumber);";
            $conn->query($sql);
            
            $sql = "UPDATE patient SET patient_checked = 'checked' WHERE patient_id = $_PatientNumber;";
            $conn->query($sql);
            
            header("Location: Doctor-Home.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FPR Form</title>
    <link rel="stylesheet" href="../Navigation-bar-Styling.css">
    <link rel="stylesheet" href="FPR-Style.css">
    <script src="../Patient Care/PCScript.js"></script>
</head>
<body>
    <div class="navbar">
        <span class="web">Emergency</span>
        <div class="inner_navbar" style="margin-left: 47.5%;">
            <a class="list" href="Doctor-Home.php">Home</a>
            <a class="list" href="">About Us</a>
            <a class="list" href="">Doctors</a>
            <a class="list" href="">Contacts</a>
        </div>
    </div>
    <!-- File PATIENT REPORT Form -->
    <div class="container">
        <Header>PATIENT REPORT</Header>
        <div class="Item">
            <form method="POST">
                <div class="personal-Information">
                    <label>Patient Name</label>
                    <label id="Label-1">Patient Number</label>
                    <label id="Label-2">Patient Age</label><br>
                    <input type="text" name="pat-name" placeholder="Enter Patient Name" disabled required>
                    <input type="number" name="pat-no" onkeyup = "fillDPatientReport(PatientData)" placeholder="Enter Patient Number" required>
                    <input type="number" name="pat-age" placeholder="Patient Age" id="pat-age" disabled required>
                </div>
                <div class="personal-Information">
                    <label>Social Security Number</label>
                    <label id="Label-3">Patient Gender</label>
                    <label>Report ID</label><br>
                    <input type="text" name="SSN" placeholder="Social Security Number" disabled required>
                    <input type="radio" name="Gender-option" value="Male" id="male" disabled required>
                    <label for="male" class="Label-5">Male</label>
                    <input type="radio" name="Gender-option" value="Female" id="female" disabled required>
                    <label for="female" class="Label-5" id="Female-Label">Female</label>
                    <input type="number" name="Report-id" value="<?php echo "$_ReportID" ?>" placeholder="Enter Report id" disabled required>
                </div>                    
                <div class="personal-Information">
                    <label>Medical Condition Before</label>
                    <label id="Label-4">Medical Condition After</label>
                    <label id="Label-7">Medicines to Give</label><br>
                    <textarea name="Med-Cond-Before" class="Med-Cond-Before" cols="25" rows="5" placeholder="Medical Condition Before" required></textarea>
                    <textarea name="Med-Cond-After" class="Med-Cond-After" cols="25" rows="5" placeholder="Medical Condition After" required></textarea>
                    <textarea name="Med-to-Give" class="Med-to-Give" cols="25" rows="5" placeholder="Medicines To Give" required></textarea>
                </div>
                <div class="personal-Information">
                    <label>Treatment Given</label>
                    <label id="Label-8">Lab Tests</label><br>
                    <textarea name="Treatment-Given" class="Treatment-Given" cols="25" rows="5" placeholder="Treatment Given Until Now" required></textarea>
                    <textarea name="Lab-Tests" class="Lab-Tests" cols="25" rows="5" placeholder="Lab Tests Required" required></textarea>
                </div>
                <div class="personal-Information">
                    <input type="radio" value="Go-Home" name="Stayed-At" id="Go-Home" required>
                    <label for="Go-Home" class="Label-5" id="Go-Home-Label">Go Home</label>
                    
                    <input type="radio" value="Transfer-to-ICU" name="Stayed-At" id="Transfer-To-ICU" required>
                    <label for="Transfer-To-ICU" class="Label-5" id="Transfer-To-ICU-Label">Transfer to ICU</label>

                    <input type="radio" value="Stay-in-Emergency" name="Stayed-At" id="Stay-in-Emergency" required>
                    <label for="Stay-in-Emergency" class="Label-5" id="Stay-in-Emergency-Label">Stay in Emergency</label>
                </div>      
                <div class="Submit-Form-Div">
                    <input type="submit" name="submit" value="SUMBIT FORM" id="submit-button">
                </div>
            </form>
        </div>
    </div>

    <script>
        const PatientData = [];
        window.addEventListener('load', function() {
            fetchData("../Doctor/FillPatientReport.php");
        });
    </script>
</body>
</html>

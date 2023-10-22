
<?php
    include("../DatabaseConnection.php");
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_PatientName = $_REQUEST['pat-name'];
        $_PatientID = $_REQUEST['pat-no'];
        $_PatientAge = $_REQUEST['pat-age'];

        $_PatientMobileNumber = $_REQUEST['mob-no'];
        $_PatientGender = $_REQUEST['option'];
        $_PatientStatus = $_REQUEST['patient-status'];

        $sql = "UPDATE patient SET patient_name = '$_PatientName', patient_mobile = '$_PatientMobileNumber', patient_gender = 
        '$_PatientGender', patient_age = '$_PatientAge', patient_checked = '$_PatientStatus' WHERE patient_id = $_PatientID;";
        $conn->query($sql);
        
        header("Location: Admin-Home.php");
        exit();
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
    <!-- Patient Registration Form -->
    <div class="container">
        <Header>UPDATE PATIENT RECORD</Header>
        <form method="post">
            <div class="Grid-Container-1">
                <div class="Grid">
                    <label>Patient Name</label>
                    <input type="text" name="pat-name" placeholder="Enter Patient Name" required>
                </div>
                <div class="Grid">
                    <label>Patient Number</label>
                    <input type="number" name="pat-no" onkeyup="fillPatientReport(PatientData)" placeholder="Enter Patient Number" required>
                </div>
                <div class="Grid">
                    <label>Patient Age</label>
                    <input type="number" name="pat-age" placeholder="Patient Age" id="pat-age" required>
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
                <label>Patient Status</label>
                    <select name="patient-status" class="Seriousness-level">
                        <option selected value="Checked">Checked</option>
                        <option value="Unchecked">Unchecked</option>
                    </select>
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
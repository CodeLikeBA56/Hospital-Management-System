<?php
    include('../DatabaseConnection.php');
    session_start();
    $_BillID = getMaxBillID($conn);
    $_BillID = $_BillID +1;
    function getMaxBillID($conn){
        $sql = "SELECT Max(bill_id) AS 'max_id' FROM Bill;";
        $_result = $conn->query($sql);
        $_row = $_result->fetch_assoc();
        return $_row['max_id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
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
    <!-- File PATIENT REPORT Form -->
    <div class="container">
        <Header>PATIENT BILL</Header>
        <label id="DS-Label">BILL-ID</label>
        <input type="number" name="DS-ID" value="<?php echo "$_BillID"; ?>" id="DS-ID" disabled>
        <form method="post" name="submit">
            <div class="Grid-Container-1" style="border-bottom: 5px solid #03e9f4; padding-bottom: 20px;">
                <div class="Grid">
                    <label>Patient Name</label>
                    <input type="text" name="pat-name" placeholder="Enter Patient Name" disabled required>
                </div>
                <div class="Grid">
                    <label>Patient Number</label>
                    <input type="number" name="pat-no" onkeyup="fillBill(PatientData)" placeholder="Enter Patient Number" required>
                </div>
                <div class="Grid">
                    <label>Patient Age</label>
                    <input type="number" name="pat-age" placeholder="Patient Age" id="pat-age" disabled required>
                </div>
                <div class="Grid">
                    <label>Social Security Number</label>
                    <input type="tel" name="SSN" placeholder="Social Security Number" disabled required>
                </div>
                <div class="Grid">
                    <label>GENDER</label>
                    <div class="Gender-Option">
                        <input type="radio" name="option" value="Male" id="male" disabled >
                        <label class="Label-5" for="male">Male</label>
                        <input type="radio" name="option" value="Female" id="female" disabled>
                        <label class="Label-5" for="female" style="width:110px">Female</label>
                    </div>
                </div>
                <div class="Grid">
                    <label>Number of Days Stayed</label>
                    <input type="number" name="No-of-days-stayed" placeholder="No. of Days Stayed" required>
                </div>
            </div>
            <div class="Grid-Container-1" style="padding: 20px 0 5px 0;">
                <div class="Grid">
                    <label>Doctor-Fee</label>
                    <input type="number" name="Doctor-Charges" placeholder="0" required>
                </div>
                <div class="Grid">
                    <label>Medicines Fee</label>
                    <input type="number" name="Medicines-Charges" placeholder="0" required>
                </div>
                <div class="Grid">
                    <label>Lab-Fee</label>
                    <input type="number" name="Lab-Charges" placeholder="0" required>
                </div>
                <div class="Grid">
                    <label>Room Charges</label>
                    <input type="number" name="Room-Charges" placeholder="0" required>
                </div>
                <div class="Grid">
                    <label>ICU-fee</label>
                    <input type="number" name="ICU-Charges" placeholder="0" required>
                </div>
                <div class="Grid">
                    <label>Surgeon-Fee</label>
                    <input type="number" name="Surgeon-Charges"placeholder="0" required>
                </div>
                <div class="Grid">
                    <label>Theatre Fee</label>
                    <input type="number" name="Theatre-Fee" placeholder="0" required>
                </div>
                <div class="Grid">
                    <label>Food Charges</label>
                    <input type="number" name="Food-Charges" placeholder="0" required>
                </div>
                <div class="Grid">
                    <label>Other Charges</label>
                    <input type="number" name="Other-Charges" placeholder="0" required>
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
            fetchData("../Admin/FetchDischargeSheet.php");
        });
    </script>

</body>
</html>

<?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_PatientNumber = $_REQUEST['pat-no'];
            $_NoOfDaysStayed = $_REQUEST['No-of-days-stayed'];

            $_DoctorCharges = $_REQUEST['Doctor-Charges'];
            $_MedicinesCharges = $_REQUEST['Medicines-Charges'];
            $_LabCharges = $_REQUEST['Lab-Charges'];

            $_RoomCharges = $_REQUEST['Room-Charges'];
            $_ICUCharges = $_REQUEST['ICU-Charges'];
            $_SurgeonCharges = $_REQUEST['Surgeon-Charges'];
            $_FoodCharges = $_REQUEST['Food-Charges'];
            $_TheatreFee = $_REQUEST['Theatre-Fee'];
            $_OtherCharges = $_REQUEST['Other-Charges'];

            $sql = "SELECT COUNT(bill_id) AS'NoOfBills' FROM generatebill WHERE patient_id = $_PatientNumber";
            $result = $conn->query($sql);
            $_row = $result->fetch_assoc();
            $_BillValidation = $_row['NoOfBills'];

            $sql = "SELECT COUNT(report_id) AS'NoOfReports' FROM filereport WHERE patient_id = $_PatientNumber";
            $result = $conn->query($sql);
            $_row = $result->fetch_assoc();
            $_ReportValidation = $_row['NoOfReports'];

            $sql = "SELECT patient_checked FROM patient WHERE patient_id = $_PatientNumber";
            $result = $conn->query($sql);
            $_row = $result->fetch_assoc();
            
            if($_row['patient_checked'] == 'Checked'){
                if($_BillValidation < $_ReportValidation){
                    $sql = "INSERT INTO bill VALUES ($_BillID, $_NoOfDaysStayed, $_FoodCharges, $_DoctorCharges, $_LabCharges,  $_MedicinesCharges, $_RoomCharges, $_ICUCharges, $_TheatreFee,  $_SurgeonCharges, $_OtherCharges);";
                    $conn->query($sql);

                    $sql = "INSERT INTO generateBill VALUES (211400068, $_PatientNumber, $_BillID);";
                    $conn->query($sql);

                    echo '<script>alert("Bill Generated.");</script>';
                }else{
                    echo '<script>alert("We cannot generate the bill because it has already been created.");</script>';
                }
            }else{
                echo '<script>alert("Bill Cannot be Generated Bacause Report is not Generated Yet.");</script>';
            }
        }

?>

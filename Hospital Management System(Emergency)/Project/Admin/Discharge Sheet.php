<?php
    include('../DatabaseConnection.php');
    $_DischargeSheetID = getMaxDischargeSheetID($conn);
    $_DischargeSheetID = $_DischargeSheetID +1;
    function getMaxDischargeSheetID($conn){
        $sql = "SELECT Max(discharge_sheet_id) AS 'max_id' FROM DischargeSheet;";
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
    <title>Discharge Sheet</title>
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
        <Header>DISCHARGE SHEET</Header>
        <label id="DS-Label">DS-ID</label>
        <input type="number" name="DS-ID" value="<?php echo "$_DischargeSheetID"; ?>" id="DS-ID" disabled>
        <form method="post">
            <div class="Grid-Container-1" style="border-bottom: 5px solid #03e9f4; padding-bottom: 20px;">
                <div class="Grid">
                    <label>Patient Name</label>
                    <input type="text" name="pat-name" placeholder="Enter Patient Name" required disabled>
                </div>
                <div class="Grid">
                    <label>Patient Number</label>
                    <input type="number" name="pat-no" onkeyup="fillDischargeSheet(PatientData)" placeholder="Enter Patient Number" required>
                </div>
                <div class="Grid">
                    <label>Patient Age</label>
                    <input type="number" name="pat-age" placeholder="Patient Age" id="pat-age" required disabled>
                </div>
                <div class="Grid">
                    <label>Social Security Number</label>
                    <input type="tel" name="SSN" placeholder="Social Security Number" autocomplete="off" required disabled>
                </div>
                <div class="Grid">
                    <label>GENDER</label>
                    <div class="Gender-Option">
                        <input type="radio" name="option" value="Male" id="male" required disabled>
                        <label class="Label-5" for="male">Male</label>
                        <input type="radio" name="option" value="Female" id="female" required disabled>
                        <label class="Label-5" for="female" style="width:110px">Female</label>
                    </div>
                </div>
                <div class="Grid">
                    <label>Re-visit Date</label>
                    <input type="date" name="Re-visit-date" required>
                </div>
            </div>
            <div class="Grid-Container-2">
                <div class="Grid">
                    <label>Medicine to give</label>
                    <textarea name="Med-to-Give" class="Med-to-Give" cols="25" rows="5" style="height: 126px;" placeholder="Medicines To Give" required disabled></textarea>
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

    <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_PatientNumber = $_REQUEST['pat-no'];
                $_RevisitDate = $_REQUEST['Re-visit-date'];

                $sql = "SELECT COUNT(bill_id) AS'NoOfBills' FROM generatebill WHERE patient_id = $_PatientNumber";
                $result = $conn->query($sql);
                $_row = $result->fetch_assoc();
                $_BillValidation = $_row['NoOfBills'];

                $sql = "SELECT COUNT(report_id) AS'NoOfReports' FROM filereport WHERE patient_id = $_PatientNumber";
                $result = $conn->query($sql);
                $_row = $result->fetch_assoc();
                $_ReportValidation = $_row['NoOfReports'];
                
                $sql = "SELECT COUNT(discharge_sheet_id) AS'NoOfDS' FROM generatedischargesheet WHERE patient_id = $_PatientNumber";
                $result = $conn->query($sql);
                $_row = $result->fetch_assoc();
                $_DSValidation = $_row['NoOfDS'];
                
                $sql = "SELECT patient_checked FROM patient WHERE patient_id = $_PatientNumber";
                $result = $conn->query($sql);
                $_row = $result->fetch_assoc();


                if($_BillValidation == $_ReportValidation && $_DSValidation < $_BillValidation && $_row['patient_checked'] == 'Checked'){
                    $sql = "INSERT INTO DischargeSheet VALUES ($_DischargeSheetID, '$_RevisitDate','');";
                    $conn->query($sql);
                    $sql = "INSERT INTO GenerateDischargeSheet VALUES (211400068, $_PatientNumber, $_DischargeSheetID);";                
                    $conn->query($sql);
                    header("Location: Admin-Home.php");
                    exit();
                }
                else{
                    echo '<script>alert("Discharge Sheet Cannot be Generated Bacause Bill is not Generated yet.");</script>';
                }
            }
    ?>
</body>
</html>
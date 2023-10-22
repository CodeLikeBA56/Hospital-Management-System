<?php
    include("../DatabaseConnection.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_patno = $_REQUEST['pat-no']; 
        $_remark = $_REQUEST['remark'];
    
        $sql = "UPDATE dischargesheet SET patient_care_remarks = '$_remark' where discharge_sheet_id = 
        (SELECT discharge_sheet_id FROM generatedischargesheet WHERE patient_id = $_patno AND discharge_sheet_id = 
        (SELECT Max(discharge_sheet_id) FROM generatedischargesheet WHERE patient_id = $_patno))";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            header("Location: Patient Discharge Sheet.php");
            exit();
        }
    }
?>
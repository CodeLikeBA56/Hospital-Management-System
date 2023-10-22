<?php
include '../DatabaseConnection.php';
    $id  = $_REQUEST['pat-no'];
    if($id!=NULL){
        $sql = "SELECT bill_id FROM generatebill WHERE patient_id = $id";
        $result = $conn->query($sql);
        if ($result) {
            while($_row = $result->fetch_assoc()){
                $i=$_row['bill_id'];
                $sql = "DELETE FROM generatebill WHERE bill_id = $i;";
                $conn->query($sql);
                echo"$i";
                $sql = "DELETE FROM bill where bill_id=$i";
                $conn->query($sql);
            }
        }    
        $sql = "SELECT discharge_sheet_id FROM generatedischargesheet WHERE patient_id = $id";
        $result = $conn->query($sql);
        if ($result) {
            while($_row = $result->fetch_assoc()){
                $_DSID = $_row['discharge_sheet_id'];
                $sql = "DELETE FROM generatedischargesheet WHERE discharge_sheet_id = $_DSID;";
                $conn->query($sql);
                $sql = "DELETE FROM dischargesheet WHERE discharge_sheet_id = $_DSID;";
                $conn->query($sql);
            }
        }
        $sql = "SELECT report_id FROM filereport WHERE patient_id = $id";
        $result = $conn->query($sql);

        if ($result) {
            while($_row = $result->fetch_assoc()){
                $_RID = $_row['report_id'];
                $sql = "DELETE FROM filereport WHERE report_id = $_RID;";
                $conn->query($sql);
                $sql = "DELETE FROM report WHERE report_id = $_RID;";
                $conn->query($sql);
            }
        } 
        $sql = "SELECT doctor_id FROM patient WHERE patient_id = $id";
        $result = $conn->query($sql);
        $_row = $result->fetch_assoc();
        $_DID = $_row['doctor_id'];
        $sql = "DELETE FROM doctorassigned WHERE patient_id = $id;";
        $conn->query($sql);
        $sql = "DELETE FROM patient WHERE patient_id = $id;";
        $result = mysqli_query($conn, $sql);
    }
    header("Location: Admin-Home.php");
    exit();
?>

<?php
    include("../DatabaseConnection.php");
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_availability = $_REQUEST['option'];
    
        $sql = "Update patientcare SET availability='$_availability' where patient_care_id= $_SESSION[User]";
        $conn->query($sql);
        header("Location: Patient-Home.php");
        exit();
       
    }

?>
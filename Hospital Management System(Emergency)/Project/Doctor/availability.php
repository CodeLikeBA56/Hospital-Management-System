
<?php
    include("../DatabaseConnection.php");
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_availability = $_REQUEST['option'];
    
        $sql = "UPDATE doctor SET availability = '$_availability' WHERE doctor_id = $_SESSION[User]";
        $conn->query($sql);

        header("Location: Doctor-Home.php");
        exit();
    }

?>
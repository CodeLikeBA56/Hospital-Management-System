<?php
    include('../DatabaseConnection.php');
    session_start();
    
    $sql = "SELECT p.patient_name, p.patient_id, p.patient_SSN, p.patient_age, p.patient_gender, p.medical_condition,
    p.seriousness_level, ds.time_stamp FROM patient p JOIN doctorassigned ds ON(p.patient_id = ds.patient_id AND p.doctor_id = ds.doctor_id) 
    WHERE p.doctor_id = $_SESSION[User] AND p.patient_checked='unchecked'";
    $result = $conn->query($sql);
    $data_array = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data_array[] = $row;
        }
    } else {
        $data_array[] = array('patient_name' => null, 'patient_id' => null, 'patient_age' => null, 'patient_SSN' => null, 'patient_gender' => null, 'medical_condition' => null);
    }

    echo json_encode($data_array);
?>

<?php
    include('../DatabaseConnection.php');
    
    $sql = "SELECT * FROM Patient";
    $result = $conn->query($sql);
    $data_array = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data_array[] = $row;
        }
    } else {
        $data_array[] = array('patient_name' => null, 'patient_id' => null, 'patient_mobile' => null, 'patient_gender' => null, 
        'patient_SSN' => null, 'patient_age' => null, 'medical_condition' => null, 'seriousness_level' => null, 'doctor_id' => null, 
        'patient_care_id' => null, 'admin_id' => null, 'patient_checked' => null);
    }

    echo json_encode($data_array);
?>

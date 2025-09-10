<?php
    include('../DatabaseConnection.php');
    session_start();
    
    $sql = "SELECT p.patient_name, p.patient_id, p.patient_age, p.patient_SSN, p.patient_gender, r.medicines_to_give 
    FROM Patient p JOIN filereport fr ON (p.patient_id = fr.patient_id) JOIN report r ON(r.report_id = fr.report_id);";
    $result = $conn->query($sql);
    $data_array = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data_array[] = $row;
        }
    } else {
        $data_array[] = array('patient_name' => null, 'patient_id' => null, 'patient_age' => null, 'patient_SSN' => null
        , 'patient_gender' => null, 'medicines_to_give' => null);
    }

    echo json_encode($data_array);
?>

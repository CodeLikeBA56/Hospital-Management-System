<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Reports Record</title>
    <link rel="stylesheet" href="../Navigation-bar-Styling.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header{
            font-size: xx-large;
            text-align: center;
            padding: 20px 0;
            margin-top: 10px;
            color: white;
            background-color: #4D79FF;
            letter-spacing: 1px;
        }
        table{
            width: 100%;
            height: auto;
            font-size: large;
            font-weight: bold;
            text-align: center;
            border: 0px solid #fff;
        }
        tr{
            height: 40px;
            color: white;
            background-color: #4D79FF;
        }         
        .highlighted{
            background-color: #2DD6C1;
        }   
    </style>
</head>
<body>
    <div class="navbar">
        <span class="web">Emergency</span>
        <div class="inner_navbar" style="margin-left: 47.5%;">
            <a class="list" href="Patient-Home.php">Home</a>
            <a class="list" href="">About Us</a>
            <a class="list" href="">Doctors</a>
            <a class="list" href="">Contacts</a>
        </div>
        
    </div>
    <header>PATIENT REPORTS RECORD</header>
    <?php
        include('../DatabaseConnection.php');
        session_start();
        $sql = "SELECT p.patient_name, p.patient_id, p.patient_age,p.patient_SSN, p.patient_gender,
        r.medical_condition_before,r.medical_condition_after,r.medicines_to_give,r.patient_active_status
        FROM patient p JOIN filereport fr ON(p.patient_id = fr.patient_id) JOIN report r ON(fr.report_id = r.report_id) 
        WHERE p.patient_care_id = $_SESSION[User]";
        $_result = $conn->query($sql);

        if ($_result->num_rows > 0) {
            echo("<table>
                <tr>
                    <th>Patient Name</th>
                    <th>Patient ID</th>
                    <th>Patient Age</th>
                    <th>Patient Gender</th>
                    <th>Patient SSN</th>
                    <th>Medical Condition Before</th>
                    <th>Medical Condition After</th>
                    <th>Medicines To Give</th>
                    <th>Patient Active Status</th>
                </tr>
            ");
            while($_row = $_result->fetch_assoc()){
                echo("
                <tr>
                    <td>".$_row['patient_name']."</td>
                    <td>".$_row['patient_id']."</td>
                    <td>".$_row['patient_age']."</td>
                    <td>".$_row['patient_gender']."</td>
                    <td>".$_row['patient_SSN']."</td>
                    <td>".$_row['medical_condition_before']."</td>
                    <td>".$_row['medical_condition_after']."</td>
                    <td>".$_row['medicines_to_give']."</td>
                    <td>".$_row['patient_active_status']."</td>
                </tr>
            ");
            }
            echo("</table>");
        }
    ?>

    <script>
        const cells = document.querySelectorAll('table td');
        
        for (let i = 0; i < cells.length; i++) {
            const cell = cells[i];
            
            cell.addEventListener('mouseover', ()=> {
                cell.classList.add('highlighted');
            });

            cell.addEventListener('mouseout', ()=> {
                cell.classList.remove('highlighted');
            });

        }
    </script>

</body>
</html>
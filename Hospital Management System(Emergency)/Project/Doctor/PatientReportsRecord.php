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
            <a class="list" href="Doctor-Home.php">Home</a>
            <a class="list" href="">About Us</a>
            <a class="list" href="">Doctors</a>
            <a class="list" href="">Contacts</a>
        </div>
        
    </div>
    <header>UNCHECKED PATIENTS</header>
    <?php
        include('../DatabaseConnection.php');
        session_start();
        $sql = "SELECT p.patient_name, p.patient_id, p.patient_age, p.patient_gender, p.medical_condition,
        p.seriousness_level, ds.time_stamp FROM patient p JOIN doctorassigned ds ON(p.patient_id = ds.patient_id AND p.doctor_id = ds.doctor_id) 
        WHERE p.doctor_id = $_SESSION[User] AND p.patient_checked = 'Unchecked'";
        $_result = $conn->query($sql);
        
        if ($_result->num_rows > 0) {
            echo("<table>
                <tr>
                    <th>Patient Name</th>
                    <th>Patient ID</th>
                    <th>Patient Age</th>
                    <th>Patient Gender</th>
                    <th>Medical Condition</th>
                    <th>Seriousness Level</th>
                    <th>Time Stamp</th>
                </tr>
            ");
            while($_row = $_result->fetch_assoc()){
                echo("
                <tr>
                    <td>".$_row['patient_name']."</td>
                    <td>".$_row['patient_id']."</td>
                    <td>".$_row['patient_age']."</td>
                    <td>".$_row['patient_gender']."</td>
                    <td>".$_row['medical_condition']."</td>
                    <td>".$_row['seriousness_level']."</td>
                    <td>".$_row['time_stamp']."</td>
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
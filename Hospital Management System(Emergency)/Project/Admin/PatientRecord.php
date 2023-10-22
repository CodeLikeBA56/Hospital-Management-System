<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Record</title>
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
            <a class="list" href="Admin-Home.php">Home</a>
            <a class="list" href="">About Us</a>
            <a class="list" href="">Doctors</a>
            <a class="list" href="">Contacts</a>
        </div>
        
    </div>
    <header>PATIENT RECORD</header>
    <?php
        include('../DatabaseConnection.php');
        $sql = "SELECT * FROM Patient;";
        $_result = $conn->query($sql);

        if ($_result->num_rows > 0) {
            echo("<table>
                <tr>
                    <th>Patient Name</th>
                    <th>Patient ID</th>
                    <th>Patient Age</th>
                    <th>Patient Gender</th>
                    <th>Patient SSN</th>
                    <th></th>
                </tr>
            ");
            while($_row = $_result->fetch_assoc()){
                $_id = $_row['patient_id'];
                echo("
                <tr>
                    <td>".$_row['patient_name']."</td>
                    <td>".$_row['patient_id']."</td>
                    <td>".$_row['patient_age']."</td>
                    <td>".$_row['patient_gender']."</td>
                    <td>".$_row['patient_SSN']."</td>
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
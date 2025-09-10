<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient HSF</title>
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
    <header>Hospital Services Fee</header>
    <?php
        include('../DatabaseConnection.php');
        session_start();
        $sql = "SELECT p.patient_name, p.patient_id,
        b.number_of_days,b.room_charges,
        b.icu_cost,b.theatre_fee,b.surgeon_fee,b.other_expenses
        FROM patient p JOIN generatebill gb ON(p.patient_id = gb.patient_id) 
        JOIN bill b ON(gb.bill_id = b.bill_id) 
        WHERE p.patient_care_id = $_SESSION[User]";
        $_result = $conn->query($sql);

        if ($_result->num_rows > 0) {
            echo("<table>
                <tr>
                    <th>Patient Name</th>
                    <th>Patient ID</th>
                    <th>Number Of Days</th>
                    <th>Room Charges</th>
                    <th>Icu Cost</th>
                    <th>Theatre Fee</th>
                    <th>Surgeon Fee</th>
                    <th>Other Expenses</th>
                </tr>
            ");
            while($_row = $_result->fetch_assoc()){
                echo("
                <tr>
                    <td>".$_row['patient_name']."</td>
                    <td>".$_row['patient_id']."</td>
                    <td>".$_row['number_of_days']."</td>
                    <td>".$_row['room_charges']."</td>
                    <td>".$_row['icu_cost']."</td>
                    <td>".$_row['theatre_fee']."</td>
                    <td>".$_row['surgeon_fee']."</td>
                    <td>".$_row['other_expenses']."</td>
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
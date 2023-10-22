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
        label{
            font-weight: bold;
            font-family: Helvetica;
            margin: 50px;
        }
        input{
            height: 35px;
            width: 25%;
            text-align: center;
            font-size: medium;
            margin: 20px 30px 10px 0;
            outline: none;
            border: none;
            border-bottom: 2px solid #496BF1;
            background-color: aliceblue;  
        }
        button{
            background-color : blue;
            color : white;
            width : 100px;
            height : 40px;
            border : 2px solid;
            border-radius : 10px;
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
    <header>PATIENT HISTORY</header>
    <form method="POST">
        <label>Patient Number</label>
        <input type="number" name="id" placeholder="Enter Patient number">
        <button type="submit">Search</button>
    </form>
    <?php
        include('../DatabaseConnection.php');
        session_start();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_ID=$_REQUEST['id'];
            if($_ID != null){
                $sql = "SELECT p.patient_name, r.medical_condition_before
                FROM patient p JOIN filereport fr ON(p.patient_id = fr.patient_id) 
                JOIN report r ON (r.report_id=fr.report_id) 
                WHERE fr.patient_id = $_ID AND p.doctor_id=$_SESSION[User]";
                $_result = $conn->query($sql);
                if ($_result->num_rows > 0) {
                    echo("<table>
                        <tr>
                            <th>Patient Name</th>
                            <th>Medical Condition</th>
                        </tr>
                    ");
                    while($_row = $_result->fetch_assoc()){
                        echo("
                        <tr>
                            <td>".$_row['patient_name']."</td>
                            <td>".$_row['medical_condition_before']."</td>
                        </tr>
                    ");
                    }
                    echo("</table>");
                }
            }
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient DS</title>
    <link rel="stylesheet" href="../Navigation-bar-Styling.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header{
            width: 100%;
            font-size: 40px;
            text-align: center;
            padding: 17px 0;
            cursor: default;
            font-weight: 700;
            font-family: Helvetica;
            color: #496BF1;
            border-bottom: 4px solid #03e9f4;
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
        .Container{
            width: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 20px;
            background-color:white;
            border: 6px solid #03e9f4;
            visibility: hidden;
        }
        form{
            padding: 40px 60px 35px 60px;
        }
        label{
            font-weight: bold;
            font-family: Helvetica;
            font-size: large;
        }
        input{
            height: 42px;
            width: 100%;
            text-align: center;
            background-color: aliceblue;
            outline: none;
            border: none;
            border-bottom: 2px solid #496BF1;
            font-size: large;
            margin: 3px 0 5px 0;
        }
        textarea{
            font-size: large;
            margin-top: 5px;
            height: 100px;
            width: 100%;
            resize: none;
            padding: 7px;
            color: #202020;
            border: 1.5px solid #496BF1;
            border-radius: 5px;
            outline: none;
        }
        .Grid-Container-2{
            display: grid;
            width: 100%;
            gap: 10px 90px;
            grid-template-columns: 1fr;
        }
        #Remarks-Div-Button{
            width: 200px;
            height : 50px;
            color : white;
            font-weight: bold;
            font-size: large;
            margin-top: 5%;
            margin-left: 40%;
            background-color: #4D79FF;
            border : 2px solid #fff;
            border-radius : 8px;
            box-shadow: 0 0 6px 1px #222;
            cursor : pointer;
        }  
        #submit-button{
            height: 50px;
            width: 100%;
            cursor: pointer;
            color: white;
            background-color: #496BF1;
            border: 2px solid #fff;
            border-radius: 5px;
            font-size: large;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 0 0 4px 2px #222;
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
    <header style="border: none; margin-top: 10px; color: #fff; background-color: #4D79FF;">PATIENT DISCHARGE SHEETS</header>
    <?php
        include('../DatabaseConnection.php');
        session_start();

        $sql = "SELECT MAX(discharge_sheet_id) AS'discharge_sheet_id' FROM generatedischargesheet GROUP by patient_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo("<table>
                <tr>
                    <th>Patient Name</th>
                    <th>Patient ID</th>
                    <th>Patient Age</th>
                    <th>Patient Gender</th>
                    <th>Revisit Date</th>
                    <th>Remarks</th>
                </tr>
            ");
            while($_row = $result->fetch_assoc()){
                $dsid=$_row['discharge_sheet_id'];
                $sql = "SELECT p.patient_name, p.patient_id, p.patient_age, p.patient_gender, ds.revisit_date, ds.patient_care_remarks
                FROM patient p JOIN generatedischargesheet gds ON(p.patient_id = gds.patient_id) JOIN dischargesheet ds 
                ON(gds.discharge_sheet_id = ds.discharge_sheet_id) 
                WHERE p.patient_care_id = $_SESSION[User] AND ds.discharge_sheet_id=$dsid;";
                $result1 = $conn->query($sql);
                $_row1=$result1->fetch_assoc();
                if($_row1!=NULL){
                echo("
                <tr>
                    <td>".$_row1['patient_name']."</td>
                    <td>".$_row1['patient_id']."</td>
                    <td>".$_row1['patient_age']."</td>
                    <td>".$_row1['patient_gender']."</td>
                    <td>".$_row1['revisit_date']."</td>
                    <td>".$_row1['patient_care_remarks']."</td>
                </tr>
                ");
                }
            }
            echo("</table>");
        }    
    ?>

    <div>
        <button type='button' onclick="PopUp()" id="Remarks-Div-Button">Add Remarks</button>
    </div>

    <div class="Container" style="width: 40%;">
        <header>ADD REMARKS</header>
        <form action="remark.php" method="post">
            <div class="Grid-Container-2">
                <div class="Grid">
                    <label>Patient ID</label>
                    <input type="number" name="pat-no" placeholder="Enter Patient ID" required>
                </div>
                <div class="Grid">
                    <label>Remark</label>
                    <textarea name="remark" id="" cols="30" rows="10"></textarea>
                </div>
            </div>  

            <div class="Grid-Container-2" style="margin-top: 30px;">
                <div class="Grid">
                    <button id="submit-button" onclick="PopUp()">CANCEL</button>
                </div>
                <div class="Grid">
                    <button id="submit-button" type="submit" onclick="PopUp()">ADD REMARKS</button>
                </div>
            </div>
        </form>
    </div>

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

        function PopUp(){
            let pop = document.querySelector(".Container");
            
            if(pop.style.visibility === "visible"){
                pop.style.visibility = "hidden";
            }else{
                pop.style.visibility = "visible";
            }
        }
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../Navigation-bar-Styling.css">
    <link rel="stylesheet" href="../Admin-Home-Style.css">
    <script src="../Patient Care/PCScript.js"></script>
    <style>
       .Container{
            width: 70%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 20px;
            background-color:white;
            border: 6px solid #03e9f4;
            visibility: hidden;
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
        form{
            padding: 40px 60px 35px 60px;
        }
        .Grid-Container-1{
            display: grid;
            gap: 10px 90px;
            grid-template-columns: 1fr 1fr;
        }
        .Grid{
            display: flex;
            flex-direction: column;
        }
        label{
            font-weight: bold;
            font-family: Helvetica;
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
        <div class="inner_navbar" style="margin-left: 32%;">
            <a class="list" href="Admin-Home.php" style="background-color: #4D79FF; color: white;">Home</a>
            <a class="list" href="">About Us</a>
            <a class="list" href="">Doctors</a>
            <a class="list" href="">Contacts</a>
        </div>
        <input type="button" value="Logout" onclick="navigateToPage('../Login.php')">
    </div>
    
    <div class="container">
        <div class="item" onclick="navigateToPage('Register Patient.php')">Register Patient</div>
        <div class="item" onclick="navigateToPage('Register Docter.php')">Register Doctor</div>
        <div class="item" onclick="navigateToPage('Register PC.php')">Register Patient Care</div>
        <div class="item" onclick="navigateToPage('Bill.php')">Bill</div>
        <div class="item" onclick="navigateToPage('Discharge Sheet.php')">Discharge Sheet</div>
        <div class="item" onclick="navigateToPage('Readmit Patient.php')">Admit Patient</div>
        <div class="item" onclick="navigateToPage('Update Patient Record.php')">Update Patient Record</div>
        <div class="item" onclick="PopUp()">Delete Patient Record</div>
        <div class="item" onclick="navigateToPage('PatientRecord.php')">Patient Record</div>
    </div>

    <div class="Container">
        <header>DELETE PATIENT RECORD</header>
        <form action="deletePatientRecord.php" method="post">
            <div class="Grid-Container-1">
                <div class="Grid">
                    <label>Patient Name</label>
                    <input type="text" name="pat-name" placeholder="Enter Patient Name" required>
                </div>
                <div class="Grid">
                    <label>Patient Number</label>
                    <input type="number" name="pat-no" onkeyup="fillPatientDeleteForm(PatientData)" placeholder="Enter Patient Number" required>
                </div>
                <div class="Grid">
                    <label>Patient Age</label>
                    <input type="number" name="pat-age" placeholder="Patient Age" id="pat-age" required>
                </div>
                <div class="Grid">
                    <label>Social Security Number</label>
                    <input type="tel" name="SSN" placeholder="Social Security Number" autocomplete="off" required>
                </div>
            </div>

            <div class="Grid-Container-1" style="margin-top: 30px;">
                <div class="Grid">
                    <button id="submit-button" onclick="PopUp()">CANCEL</button>
                </div>
                <div class="Grid">
                    <button id="submit-button" type="submit">DELETE</button>
                </div>
            </div>        
        </form>
    </div>

    <script>
        const PatientData = [];
        window.addEventListener('load', function() {
            fetchData("FetchPatientData.php");
        });

        function navigateToPage(pageURL) {
            window.location.href = pageURL;
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
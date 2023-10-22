<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Home</title>
    <link rel="stylesheet" href="../Navigation-bar-Styling.css">
    <link rel="stylesheet" href="../Admin-Home-Style.css">
    <link rel="stylesheet" href="../Availability-Styling.css">
</head>
<body>
    <div class="navbar">
        <span class="web">Emergency</span>
        <div class="inner_navbar" style="margin-left: 32%;">
            <a class="list" href="Doctor-Home.php" style="background-color: #4D79FF; color: white;">Home</a>
            <a class="list" href="">About Us</a>
            <a class="list" href="">Doctors</a>
            <a class="list" href="">Contacts</a>
        </div>
        <input type="button" value="Logout" onclick="navigateToPage('../Login.php')">
    </div>

    <div class="container" style="height: 215px;">
        <div class="item" onclick="navigateToPage('FPR.php')">File Patient Report</div>
        <div class="item" onclick="navigateToPage('PatientReportsRecord.php')">Unchecked Patients</div>
        <div class="item" onclick="navigateToPage('PatientHistory.php')">Patient History</div>
        <div class="item" onclick="PopUp()">Available</div>
    </div>

    <div class="Container">
        <header>AVAILABILITY STATUS</header>
        <form action="availability.php" method="post">
            <div class="Grid-Container-2">
                <div class="Grid">
                    <label>Set Availability-Status</label>
                    <div class="Option">
                        <input type="radio" name="option" value="Yes" id="Yes-Available">
                        <label for="Yes-Available" class="Label-5">Available</label>
                        <input type="radio" name="option" value="No" id="No-Available">
                        <label for="No-Available" class="Label-5" style="width:165px;">Not Available</label>
                    </div>
                </div>
            </div>

            <div class="Grid-Container-1" style="margin-top: 40px;">
                <div class="Grid">
                    <button id="submit-button" onclick="PopUp()">CANCEL</button>
                </div>
                <div class="Grid">
                    <button id="submit-button" type="submit" onclick="PopUp()">UPDATE STATUS</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function navigateToPage(pageURL) {
            window.location.href = pageURL;
        }

        function PopUp(){
            let pop = document.querySelector(".Container");
            console.log("Bot");
            if(pop.style.visibility === "visible"){
                pop.style.visibility = "hidden";
            }else{
                pop.style.visibility = "visible";
            }
        }
    </script>

</body>
</html>
<?php
    include("../DatabaseConnection.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_PCName = $_REQUEST['PC-name'];
        $_PCID = $_REQUEST['PC-id'];

        $_PCMobile = $_REQUEST['mobile'];
        $_Password = $_REQUEST['password'];

        $sql = "INSERT INTO patientcare VALUES ('$_PCName', '$_PCID', '$_PCMobile', '$_Password', 'Yes');";

        if($conn->query($sql)){
            header("Location: Admin-Home.php");
            exit();
        }else{
            echo("Insertion Failed :(");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register PC</title>
    <link rel="stylesheet" href="../Navigation-bar-Styling.css">
    <link rel="stylesheet" href="../HSF-Style.css">
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
    <div class="container">
        <Header>Patient Care Registration</Header>
        <div class="Item">
            <form method="post">             
                <div class="personal-Information">
                    <label>Patient Care Name</label>
                    <label style="margin-left: 358px;">Patient Care ID</label><br>
                    <input type="text" name="PC-name" placeholder="Enter Care Name" autocomplete="off" required>
                    <input type="number" name="PC-id" placeholder="Enter Care ID" autocomplete="off" required>
                </div>
                <div class="personal-Information">
                    <label>Mobile Number</label>
                    <label id="Label-2">Password</label><br>
                    <input type="text" name="mobile" placeholder="Enter Mobile Number" autocomplete="off" required>
                    <input type="password" name="password" placeholder="Enter Password" required>
                </div>     
                <div class="Submit-Form-Div">
                    <input type="submit" name="send" value="Register Patient Care" id="submit-button">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
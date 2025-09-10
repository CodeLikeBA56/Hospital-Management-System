<?php
    include("../DatabaseConnection.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_DoctorName = $_REQUEST['Doctor-name'];
        $_DoctorID = $_REQUEST['Doctor-id'];

        $_DoctorMobile = $_REQUEST['mobile'];
        $_DoctorEmail = $_REQUEST['email'];

        $_Speciality = $_REQUEST['speciality'];
        $_Password = $_REQUEST['password'];

        $sql = "INSERT INTO doctor VALUES ('$_DoctorName', '$_DoctorID', '$_DoctorMobile', '$_DoctorEmail', '$_Speciality', '$_Password', 'Yes');";

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
    <title>Doctor Registration</title>
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
        <Header>Doctor Registration</Header>
        <form method="post">             
            <div class="personal-Information">
                <label>Docter Name</label>
                <label id="Label-1">Docter ID</label><br>
                <input type="text" name="Doctor-name" placeholder="Enter Docter Name" autocomplete="off" required>
                <input type="number" name="Doctor-id" placeholder="Enter Docter ID" autocomplete="off" required>
            </div>
            <div class="personal-Information">
                <label>Mobile Number</label>
                <label id="Label-2">Email</label><br>
                <input type="text" name="mobile" placeholder="Enter Mobile Number" autocomplete="off" required>
                <input type="email" name="email" placeholder="Enter Email" autocomplete="off" required>
            </div>
            <div class="personal-Information">
                <label>Speciality</label>
                <label id="Label-3">Password</label><br>
                <input type="text" name="speciality" placeholder="Enter Speciality" autocomplete="off" required>
                <input type="password" name="password" placeholder="Enter Password" required>
            </div>      
            <div class="Submit-Form-Div">
                <input type="submit" name="send" value="Register Doctor" id="submit-button">
            </div>
        </form>
    </div>
</body>
</html>
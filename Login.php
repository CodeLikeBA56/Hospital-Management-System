<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Navigation-bar-Styling.css">
    <link rel="stylesheet" href="LoginStyle.css">
</head>
<body>
    <div class="navbar">
        <span class="web">Emergency</span>
        <div class="inner_navbar" style="margin-left: 44%;">
            <a class="list" href="Home.html">Home</a>
            <a class="list" href="">About Us</a>
            <a class="list" href="">Doctors</a>
            <a class="list" href="">Contacts</a>
            <a class="list" style="background-color: #4D79FF; color: white;" href="Login Page.html">Sign In</a>
        </div>
    </div>
    
    <div id="container">
        <div class="sign-in-container" id="sign-in">
            <form action="" method="post">
                <div class="field">
                    <input type="text" name="name" placeholder="Username" required>
                </div>
                <div class="field">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="field">
                    <select required name="role">
                        <option selected disabled>Select Your Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Patient Care">Patient Care</option>
                    </select>
                </div>
                <div class="field">
                    <input type="submit" value="SIGN IN" name="sign-in">
                </div>
            </form>
        </div>
    </div>

    <?php
        include('DatabaseConnection.php');
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_Username = $_REQUEST['name'];
            $_Password = $_REQUEST['password'];
            $_Role = $_REQUEST['role'];

            if ($_Role == 'Admin') {
                $sql = "SELECT admin_id, admin_password FROM admin WHERE admin_id = $_Username;";
                $_result = $conn->query($sql);
                $_row = $_result->fetch_assoc();
                if($_row['admin_id']  == $_Username &&  $_row['admin_password'] == $_Password){
                    $_SESSION['User'] = $_Username;
                    header("Location: Admin/Admin-Home.php");
                    exit();
                }
            } elseif ($_Role == 'Doctor') {
                $sql = "SELECT doctor_id, doctor_password FROM doctor WHERE doctor_id = $_Username;";
                $_result = $conn->query($sql);
                $_row = $_result->fetch_assoc();
                if($_row['doctor_id']  == $_Username &&  $_row['doctor_password'] == $_Password){
                    $_SESSION['User'] = $_Username;
                    header("Location: Doctor/Doctor-Home.php");
                    exit();
                }
            } elseif ($_Role == 'Patient Care') {
                $sql = "SELECT patient_care_id, patient_care_password FROM patientcare WHERE patient_care_id = $_Username;";
                $_result = $conn->query($sql);
                $_row = $_result->fetch_assoc();
                if($_row['patient_care_id']  == $_Username &&  $_row['patient_care_password'] == $_Password){
                    $_SESSION['User']=$_Username;
                    header("Location: Patient Care/Patient-Home.php");
                    exit();
                }
            } else {
                echo "Please enter a valid username and password.";
            }
        }

    ?>
</body>
</html>

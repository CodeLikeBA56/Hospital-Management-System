<?php

    $_Hostname = "localhost";
    $_Username = "root";
    $_Password = "";
    $_Database = "hms";

    $conn = mysqli_connect($_Hostname, $_Username, $_Password, $_Database) or die("Database Connection Failed.");
?>
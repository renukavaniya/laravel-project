<?php

$con = mysqli_connect("localhost", "root", "")
or
die("Couldn't connect to database");

$select = mysqli_select_db($con,"realestate")
or 
die("Database not found");

?>
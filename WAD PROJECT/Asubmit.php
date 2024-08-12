<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wadproject";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}

// Escape user input to prevent SQL injection
$studentName = mysqli_real_escape_string($conn, $_POST['studentName']);
$rollNo = mysqli_real_escape_string($conn, $_POST['rollNo']);
$branch = mysqli_real_escape_string($conn, $_POST['branch']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$tenthMarks = mysqli_real_escape_string($conn, $_POST['tenthMarks']);
$interMarks = mysqli_real_escape_string($conn, $_POST['interMarks']);
$backlogs = mysqli_real_escape_string($conn, $_POST['backlogs']);
$cgpa = mysqli_real_escape_string($conn, $_POST['cgpa']);
$percentage = mysqli_real_escape_string($conn, $_POST['percentage']);
$training = mysqli_real_escape_string($conn, $_POST['specialtraining']);
$internship = mysqli_real_escape_string($conn, $_POST['internship']);
$jobs = mysqli_real_escape_string($conn, $_POST['jobs']);
$task = mysqli_real_escape_string($conn, $_POST['task']);
$pega = mysqli_real_escape_string($conn, $_POST['pega']);
$apt = mysqli_real_escape_string($conn, $_POST['apt']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

// Fix the SQL query: add missing commas and quotes around column names
$sql = "INSERT INTO studentdata (rollnumber, internship, jobs, branch, task, specialtraining, pega, apt, name, gender, `10th%`, `Inter`, backlogs, btechcgpa, btech, email)
VALUES ( '$rollNo','$internship','$jobs','$branch','$task','$training','$pega', '$apt','$studentName', '$gender', '$tenthMarks', '$interMarks', '$cgpa', '$percentage', '$backlogs', '$email')";

if (mysqli_query($conn, $sql)) {
 echo "New record created successfully!";
} else {
 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
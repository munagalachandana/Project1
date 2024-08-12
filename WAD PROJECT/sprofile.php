<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wadproject";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
 $rollNumber = $_SESSION['roll'];
$sql = "SELECT * FROM studentdata WHERE rollnumber='$rollNumber'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
// $rollNumber = $row["rollumber"];
$internship = $row["internship"];
$jobs = $row["jobs"];
$branch = $row["branch"];
$task = $row["task"];
$specialTraining = $row["specialtraining"];
$pegs = $row["pega"];
$apt = $row["apt"];
$fullName = $row["name"];
$gender = $row["gender"];
$tenthMarks = $row["10th%"];
$interMarks = $row["Inter"];
$btechCgpa = $row["btechcgpa"];
$btechPercentage = $row["btech"];
$backlogs = $row["backlogs"];
$email = $row["email"];
//         $mobileNumber = $row["mobilenumber"];
}
} else {
echo "No records found.";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>
    <link rel="stylesheet" link="sprofile.css">
</head>
<body>
    <h1>Student Profile</h1>
    <table>
        <tr>
            <td>Roll Number:</td>
            <td><?php echo $rollNumber; ?></td>
        </tr>
        <tr>
            <td>Internship:</td>
            <td><?php echo $internship; ?></td>
        </tr>
        <tr>
            <td>Jobs:</td>
            <td><?php echo $jobs; ?></td>
        </tr>
        <tr>
            <td>Branch:</td>
            <td><?php echo $branch; ?></td>
        </tr>
        <tr>
            <td>Task:</td>
            <td><?php echo $task; ?></td>
        </tr>
        <tr>
            <td>Special Training:</td>
            <td><?php echo $specialTraining; ?></td>
        </tr>
        <tr>
            <td>PEGA:</td>
            <td><?php echo $pegs; ?></td>
        </tr>
        <tr>
            <td>APT:</td>
            <td><?php echo $apt; ?></td>
        </tr>
        <tr>
            <td>Full Name:</td>
            <td><?php echo $fullName; ?></td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td><?php echo $gender; ?></td>
        </tr>
        <tr>
            <td>10th Percentage:</td>
            <td><?php echo $tenthMarks; ?></td>
        </tr>
        <tr>
            <td>Intermediate Percentage:</td>
            <td><?php echo $interMarks; ?></td>
        </tr>
        <tr>
            <td>B.Tech CGPA:</td>
            <td><?php echo $btechCgpa; ?></td>
        </tr>
        <tr>
            <td>B.Tech Percentage:</td>
            <td><?php echo $btechPercentage; ?></td>
        </tr>
        <tr>
            <td>Backlogs:</td>
            <td><?php echo $backlogs; ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $email; ?></td>
        </tr>
    </table>
</body>
</html>
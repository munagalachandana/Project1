<?php

// Database connection details (replace with yours)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wadproject";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Get test results sorted by marks (descending)
$sql = "SELECT rollNumber, marks FROM result ORDER BY marks DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     echo "<h2>Test Results </h2>";
 echo "<table>";
echo "<tr><th>Roll Number</th><th>Marks</th></tr>";
while ($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo "<td>" . $row["rollNumber"] . "</td>";
 echo "<td>" . $row["marks"] . "</td>";
 echo "</tr>";
 }
 echo "</table>";
} else {
 echo "No test results found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Test Results</title>
 <link rel="stylesheet" href="Aresult.css">
</head>
<body>
 <!-- <div class="container">
 <h1>Test Results</h1>
 
 </div> -->
</body>
</html>
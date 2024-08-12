<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wadproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

// Query to fetch total students and placed students by branch
$sql = "
SELECT branch, 
       COUNT(*) AS total_students, 
       SUM(CASE WHEN CHAR_LENGTH(jobs) > 0 THEN 1 ELSE 0 END) AS placed_students
FROM studentdata 
GROUP BY branch";
$result = $conn->query($sql);

// Prepare data for chart
$data = array();
if ($result !== false) {
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $data[] = array(
        'branch' => $row['branch'],
        'total_students' => $row['total_students'],
        'placed_students' => $row['placed_students']
      );
    }
  }
}

// Close the database connection
$conn->close();

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT); 
?>

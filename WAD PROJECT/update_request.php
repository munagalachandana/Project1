<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $conn->real_escape_string($_POST['student_id']);
    $field = $conn->real_escape_string($_POST['field']);
    $new_value = $conn->real_escape_string($_POST['new_value']);
    $status = $conn->real_escape_string($_POST['status']);

    // Update the status in the database
    $sql = "UPDATE change_requests SET status='$status' WHERE student_id='$student_id' AND field='$field' AND new_value='$new_value'";

    if ($conn->query($sql) === TRUE) {
        echo "Request updated successfully.";
    } else {
        echo "Error updating request: " . $conn->error;
    }
}

$conn->close();

// Redirect back to the admin page
header("Location: Arequest.php");
exit();
?>

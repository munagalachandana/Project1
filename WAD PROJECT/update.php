<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wadproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$rollNo = $_POST['rollNo'];

// Check if roll number exists
$sql = "SELECT * FROM studentdata WHERE rollnumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $rollNo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing record
    $update_fields = [];
    $params = [];
    $param_types = '';

    if (!empty($_POST['studentName'])) {
        $update_fields[] = "name=?";
        $params[] = $_POST['studentName'];
        $param_types .= 's';
    }
    if (!empty($_POST['email'])) {
        $update_fields[] = "email=?";
        $params[] = $_POST['email'];
        $param_types .= 's';
    }
    if (!empty($_POST['branch'])) {
        $update_fields[] = "branch=?";
        $params[] = $_POST['branch'];
        $param_types .= 's';
    }
    if (!empty($_POST['gender'])) {
        $update_fields[] = "gender=?";
        $params[] = $_POST['gender'];
        $param_types .= 's';
    }
    if (!empty($_POST['tenthMarks'])) {
        $update_fields[] = "10th%=?";
        $params[] = $_POST['tenthMarks'];
        $param_types .= 'i';
    }
    if (!empty($_POST['interMarks'])) {
        $update_fields[] = "Inter=?";
        $params[] = $_POST['interMarks'];
        $param_types .= 'i';
    }
    if (!empty($_POST['backlogs'])) {
        $update_fields[] = "backlogs=?";
        $params[] = $_POST['backlogs'];
        $param_types .= 'i';
    }
    if (!empty($_POST['cgpa'])) {
        $update_fields[] = "btechcgpa=?";
        $params[] = $_POST['cgpa'];
        $param_types .= 'd';
    }
    if (!empty($_POST['percentage'])) {
        $update_fields[] = "btech=?";
        $params[] = $_POST['percentage'];
        $param_types .= 'd';
    }
    if (!empty($_POST['jobs'])) {
        $update_fields[] = "jobs=?";
        $params[] = $_POST['jobs'];
        $param_types .= 's';
    }
    if (!empty($_POST['internship'])) {
        $update_fields[] = "internship=?";
        $params[] = $_POST['internship'];
        $param_types .= 's';
    }
    if (!empty($_POST['specialtraining'])) {
        $update_fields[] = "specialtraining=?";
        $params[] = $_POST['specialtraining'];
        $param_types .= 's';
    }
    if (!empty($_POST['pega'])) {
        $update_fields[] = "pega=?";
        $params[] = $_POST['pega'];
        $param_types .= 's';
    }
    if (!empty($_POST['task'])) {
        $update_fields[] = "task=?";
        $params[] = $_POST['task'];
        $param_types .= 's';
    }
    if (!empty($_POST['apt'])) {
        $update_fields[] = "apt=?";
        $params[] = $_POST['apt'];
        $param_types .= 's';
    }

    if (!empty($update_fields)) {
        $update_sql = "UPDATE studentdata SET " . implode(", ", $update_fields) . " WHERE rollnumber=?";
        $stmt = $conn->prepare($update_sql);
        $params[] = $rollNo;
        $param_types .= 's';

        $stmt->bind_param($param_types, ...$params);
        if ($stmt->execute()) {
            echo "Profile successfully updated!";
        } else {
            echo "Error: " . $update_sql . "<br>" . $conn->error;
        }
    } else {
        echo "No fields to update.";
    }
} else {
    echo "Roll number not found.";
}

$stmt->close();
$conn->close();
?>

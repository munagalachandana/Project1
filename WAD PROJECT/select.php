<?php
// Database connection details
$servername = "localhost";
$username = "root";  // replace with your database username
$password = "";  // replace with your database password
$dbname = "wadproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to retrieve student roll numbers based on criteria
function getSelectedStudents($conn, $criteria) {
    $query = "SELECT rollnumber FROM studentdata WHERE ";
    $conditions = [];
    $params = [];

    foreach ($criteria as $key => $value) {
        $conditions[] = "$key = ?";
        $params[] = $value;
    }

    $query .= implode(' AND ', $conditions);

    $stmt = $conn->prepare($query);

    $param_types = str_repeat("s", count($params));
    $stmt->bind_param($param_types, ...$params);

    $stmt->execute();
    $result = $stmt->get_result();

    $selectedStudents = [];
    while ($row = $result->fetch_assoc()) {
        $selectedStudents[] = $row['roll_no'];
    }

    $stmt->close();

    return $selectedStudents;
}

$criteria = [];
$selectedStudents = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['major'])) {
        $criteria['major'] = $_POST['major'];
    }
    if (!empty($_POST['graduation_year'])) {
        $criteria['graduation_year'] = $_POST['graduation_year'];
    }

    $selectedStudents = getSelectedStudents($conn, $criteria);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Selection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            cursor: pointer;
            border: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .results {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Student Selection</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="major">Major</label>
            <select name="major" id="major">
                <option value="">Select Major</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Electrical Engineering">Electrical Engineering</option>
                <option value="Mechanical Engineering">Mechanical Engineering</option>
                <!-- Add more options as needed -->
            </select>
        </div>
        <div class="form-group">
            <label for="graduation_year">Graduation Year</label>
            <input type="number" name="graduation_year" id="graduation_year">
        </div>
        <button type="submit" class="btn">Submit</button>
    </form>

    <?php if (!empty($selectedStudents)): ?>
        <div class="results">
            <h2>Selected Students</h2>
            <ul>
                <?php foreach ($selectedStudents as $roll_no): ?>
                    <li><?php echo htmlspecialchars($roll_no); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <div class="results">
            <h2>No students found matching the criteria.</h2>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

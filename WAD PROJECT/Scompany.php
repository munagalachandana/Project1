<?php
// Database connection settings
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

// Fetch all companies from the companies table
$sql = "SELECT name, requirements, criteria FROM companies";
$result = $conn->query($sql);

// Array to hold companies
$companies = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $companies[] = array(
            'name' => $row['name'],
            'requirements' => $row['requirements'],
            'criteria' => $row['criteria']
        );
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
        }
        td {
            background-color: #fff;
        }
        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Companies List</h1>

    <?php
    if (!empty($companies)) {
        echo "<table>";
        echo "<tr><th>Company Name</th><th>Rounds</th><th>Required Skills</th></tr>";
        
        // Output data of each row
        foreach ($companies as $company) {
            echo "<tr><td>" . htmlspecialchars($company['name']) . "</td><td>" . nl2br(htmlspecialchars($company['requirements'])) . "</td><td>" . nl2br(htmlspecialchars($company['criteria'])) . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No companies available.</p>";
    }
    ?>
</div>

</body>
</html>

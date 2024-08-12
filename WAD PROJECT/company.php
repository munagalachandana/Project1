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

// Handle insertion of a new company
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_company'])) {
    $company_name = $conn->real_escape_string($_POST['company_name']);
    $requirements = $conn->real_escape_string($_POST['requirements']);
    $criteria = $conn->real_escape_string($_POST['criteria']);

    $insert_sql = "INSERT INTO companies (name, requirements,criteria) VALUES ('$company_name', '$requirements','$criteria')";
    if ($conn->query($insert_sql) === TRUE) {
        echo "New company added successfully";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }
}

// Handle removal of a company
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_company'])) {
    $company_name_to_remove = $conn->real_escape_string($_POST['company_name_to_remove']);

    $delete_sql = "DELETE FROM companies WHERE name='$company_name_to_remove'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $delete_sql . "<br>" . $conn->error;
    }
}



$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Management</title>
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
        h1, h2 {
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
        form {
            margin: 20px 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], textarea {
            width: 30%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            /* justify-content:center; */
            padding: 10px;
            border: none;
            width:10rem;
            border-radius: 4px;
            background-color: #5cb85c;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .alert {
            padding: 15px;
            margin: 10px 0;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert.success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .alert.error {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
</head>
<body>

<h1>Company Management</h1>

 
<h2>Add New Company</h2>
<form method="POST" action="">
    <label for="company_name">Company Name:</label>
    <input type="text" id="company_name" name="company_name" required>
    <br>
    <label for="requirements">Requirements:</label>
    <textarea id="requirements" name="requirements" required></textarea>
    <br>
    <label for="criteria">Criteria:</label>
    <textarea id="criteria" name="criteria" required></textarea>
    <br>
    <button type="submit" name="add_company">Add Company</button>
</form>

<h2>Remove Company</h2>
<form method="POST" action="">
    <label for="company_name_to_remove">Company Name:</label>
    <input type="text" id="company_name_to_remove" name="company_name_to_remove" required>
    <br>
    <button type="submit" name="remove_company">Remove Company</button>
</form>

</body>
</html>
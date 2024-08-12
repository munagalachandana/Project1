<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Change Request</title>
    <style>
        /* Reset some basic elements */
        body, h1, form, label, input, button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #3498db;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Request Profile Change</h1>
    <form action="submit_request.php" method="post" enctype="multipart/form-data">
        <!-- <label for="studentId">Student ID:</label>
        <input type="text" id="studentId" name="studentId" required><br><br> -->
        <label for="student_id">Roll Number:</label>
        <input type="text" id="student_id" name="student_id" required><br><br>
        <label for="field">Field to Change:</label>
        <input type="text" id="field" name="field" required><br><br>

        <label for="newValue">New Value:</label>
        <input type="text" id="newValue" name="newValue" required><br><br>
        <label for="image">Upload image:</label>
        <input type="file" name="pic" id="pic"/>
        <button type="submit">Submit Request</button>
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Requests</title>
    <style>
        /* Reset some basic elements */
        body, h1, p, div, form {
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

        #requests {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        #requests div {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        #requests div:last-child {
            border-bottom: none;
        }

        p {
            margin-bottom: 10px;
            line-height: 1.6;
        }

        form {
            display: flex;
            gap: 10px;
        }

        button {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s ease;
        }

        button[name="status"][value="approved"] {
            background-color: #27ae60;
            color: #fff;
        }

        button[name="status"][value="approved"]:hover {
            background-color: #218c53;
        }

        button[name="status"][value="denied"] {
            background-color: #e74c3c;
            color: #fff;
        }

        button[name="status"][value="denied"]:hover {
            background-color: #c0392b;
        }

        hr {
            margin: 20px 0;
            border: 0;
            border-top: 1px solid #e0e0e0;
        }
    </style>
</head>
<body>
    <h1>Manage Profile Change Requests</h1>
    <div id="requests">
        <?php
        // admin_requests.php

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

        $sql = "SELECT * FROM change_requests";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<p>Student ID: " . $row["student_id"] . "</p>";
                echo "<p>Field: " . $row["field"] . "</p>";
                echo "<p>New Value: " . $row["new_value"] . "</p>";
                echo "<p>Status: " . $row["status"] . "</p>";
                echo "<form action='update_request.php' method='post'>";
                echo "<input type='hidden' name='student_id' value='" . $row["student_id"] . "'>";
                echo "<input type='hidden' name='field' value='" . $row["field"] . "'>";
                echo "<input type='hidden' name='new_value' value='" . $row["new_value"] . "'>";
                echo "<button type='submit' name='status' value='approved'>Approve</button>";
                echo "<button type='submit' name='status' value='denied'>Deny</button>";
                echo "</form>";
                if ($row["image_path"]) {
                    echo "<button onclick=\"window.open('" . $row["image_path"] . "', '_blank')\">View Image</button>";
                }
                echo "<hr>";
                echo "</div>";
            }
        } else {
            echo "No requests found.";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
